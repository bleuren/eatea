<?php
namespace App\Services;

use App\Contracts\IOrderService;
use App\Repositories\CartRepository;
use App\Repositories\MapRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderItemSubRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Phattarachai\LineNotify\Facade\Line;

class OrderService implements IOrderService
{
    private $orderRepo;
    private $orderItemRepo;
    private $orderItemSubRepo;
    private $productRepo;
    private $cartRepo;

    protected $rate = 0.05;

    public function __construct(
        UserRepository $userRepo,
        OrderRepository $orderRepo,
        OrderItemRepository $orderItemRepo,
        OrderItemSubRepository $orderItemSubRepo,
        ProductRepository $productRepo,
        CartRepository $cartRepo,
        MapRepository $mapRepo
    ) {
        $this->userRepo         = $userRepo;
        $this->orderRepo        = $orderRepo;
        $this->orderItemRepo    = $orderItemRepo;
        $this->orderItemSubRepo = $orderItemSubRepo;
        $this->productRepo      = $productRepo;
        $this->cartRepo         = $cartRepo;
        $this->mapRepo          = $mapRepo;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $orders = $this->orderRepo->index();
        } else {
            $orders = $user->orders;
        }
        return $orders;
    }

    public function find($id)
    {
        try {
            $order             = $this->orderRepo->find($id);
            $order->orderItems = $this->getOrderItems($order->id);
            $order->total      = $order->orderItems->sum('subtotal') + $order->fee;
            return $order;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function create($request)
    {

        try {
            $request['user_id'] = Auth::id();
            $cart               = $this->cartRepo->index();
            $requireAddress     = $cart->search(function ($cartItem, $rowId) {
                return $cartItem->options['mode'] !== 'PICKUP';
            });
            if ($requireAddress) {
                $distance = $this->getDistance($request['map_id']);
                if (!$distance) {
                    abort(403, __('距離計算錯誤！可能在服務區外'));
                }
                $request['fee'] = $this->calcFee($cart, $distance);
            }
            $order = $this->orderRepo->create($request);
            foreach ($cart as $item) {
                $orderItem = $this->orderItemRepo->create($order, $item);
                if ($orderItem->mode === 'SUBSCRIBE') {
                    foreach ($item->options->date_qty as $received_at => $qty) {
                        $request      = ['received_at' => $received_at, 'qty' => $qty];
                        $orderItemSub = $this->orderItemSubRepo->create($orderItem, $request);
                    }
                }
            }
            if ($order) {
                $message = '有新訂單: ' . url('/') . '/orders/' . $order->id;
                Line::send($message);
                $this->cartRepo->truncate();
            }
            return $order;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function update($request, $id)
    {
        try {
            $order = $this->find($id);

            if (preg_match('/^[0-9]{5}$/', $request['payment']['id'])) {
                $request['payment']['method'] = 'DEFAULT';
            }

            if (Str::isUuid($request['payment']['id'])) {
                $request['payment']['method'] = 'WALLET';
            }

            if ($order->status !== 'ARRIVED' && $request['status'] === 'ARRIVED') {
                $user = $this->userRepo->findReferrer($order->user_id);
                if ($user) {
                    $isDeposited = $user->wallet
                        ->transactions()
                        ->where([
                            'type'        => 'commission',
                            'meta->order' => $order->id,
                        ])
                        ->first();
                    if (!$isDeposited) {
                        $user->balance;
                        $user->deposit(round(($order->total - $order->fee) * $this->rate), [
                            'type'       => 'commission',
                            'order'      => $order->id,
                            'created_by' => Auth::id(),
                        ]);
                    }
                }
            }
            return $this->orderRepo->update($request, $id);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function delete($id)
    {
        return $this->orderRepo->delete($id);
    }

    public function patchPayment($request, $id)
    {
        $method = $request['payment']['method'];
        $order  = $this->find($id);
        switch ($method) {
            case 'WALLET':
                $user     = Auth::user();
                $target   = $this->userRepo->findByRole(1); //錢包收款
                $transfer = $user->transfer($target, $order->total, [
                    'type'       => 'shopping',
                    'order'      => $order->id,
                    'created_by' => Auth::id(),
                ]);
                $request['payment']['id'] = $transfer->uuid;
                $message                  = '訂單已付款: ' . url('/') . '/orders/' . $id;
                $message .= "\n";
                $message .= "金額:{$order->total}, 交易編號: #{$transfer->uuid}";
                break;

            default:
                $message = '訂單已付款: ' . url('/') . '/orders/' . $id;
                $message .= "\n";
                $message .= "金額:{$order->total}, 付款帳號末5碼: {$order->payment['id']}";
        }
        $this->update($request, $id);
        if ($order) {
            Line::send($message);
        }
        return $order;
    }

    public function getOrderItems($order_id)
    {
        $result = $this->orderItemRepo->getByOrder($order_id)->map(function ($orderItem) {
            $orderItem->subtotal = $orderItem->price * $orderItem->qty;
            $orderItem->product  = $this->productRepo->find($orderItem->product_id);
            if ($orderItem->mode === 'SUBSCRIBE') {
                $orderItem->orderItemSubs = $this->orderItemSubRepo->getByOrderItem($orderItem->id);
                $orderItem->completion    = $orderItem->orderItemSubs->groupBy('status')->map->count();
            }
            return $orderItem;
        });
        return $result;
    }

    public function getUsersOrder($users)
    {
        $total = 0;
        foreach ($users as $i => $user) {
            $subtotal = 0;
            foreach ($user->orders as $j => $order) {
                $user->orders[$j] = $this->find($order->id);
                $subtotal += $user->orders[$j]->total;
            }
            $users[$i]->total = $subtotal;
            $total += $subtotal;
        }
        $users->total = $total;
        return $users;
    }

    public function getDistance($id)
    {
        // $map = $this->mapRepo->findByAddress($city, $district, $road);
        $map = $this->mapRepo->find($id);
        return $map->distance;
    }

    public function getTasks($received_at)
    {
        try {
            if ($received_at === 'today') {
                $received_at = date('Y-m-d');
            }
            $orderItemSubs = $this->orderItemSubRepo->getByReceivedAt($received_at)->map(function ($orderItemSub) {
                $orderItemSub->orderItem          = $this->orderItemRepo->find($orderItemSub->order_item_id);
                $orderItemSub->orderItem->order   = $this->orderRepo->find($orderItemSub->orderItem->order_id);
                $orderItemSub->orderItem->product = $this->productRepo->find($orderItemSub->orderItem->product_id);

                return $orderItemSub;
            });

            $orderItemSubs->products = array();
            foreach ($orderItemSubs as $item) {
                $orderItemSubs->products[$item->orderItem->product->name]
                = isset($orderItemSubs->products[$item->orderItem->product->name])
                ? $orderItemSubs->products[$item->orderItem->product->name] += $item->qty
                : $item->qty;
            }

            return $orderItemSubs;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function calcFee($cart, $distance)
    {
        $fee            = 0;
        $qty_delivery   = 0;
        $total_delivery = 0;
        $delivery       = ['qty' => 0, 'total' => 0];
        $pickup         = ['qty' => 0, 'total' => 0];
        $subscribe      = ['qty' => 0, 'total' => 0, 'date' => []];
        $hasDelivery    = false;
        $hasSubscribe   = false;
        foreach ($cart as $cartItem) {
            if ($cartItem->options->mode === 'DELIVERY') {
                $delivery['qty'] += $cartItem->qty;
                $delivery['total'] += $cartItem->total;
            } elseif ($cartItem->options->mode === 'SUBSCRIBE') {
                $subscribe['date'][] = $cartItem->options->date_qty;
                $subscribe['qty'] += $cartItem->qty;
                $subscribe['total'] += $cartItem->total;
            } else {
                $pickup['qty'] += $cartItem->qty;
                $pickup['total'] += $cartItem->total;
            }
        }
        $subscribe['date'] = array_keys(array_merge(...array_values($subscribe['date'])));
        sort($subscribe['date']);
        if ($delivery['qty'] != 0) {
            if ($distance > 6000) {
                $fee += ceil($delivery['qty'] / 13) * 260;
            } elseif ((4000 <= $distance) && ($distance <= 5999)) {
                if ($delivery['total'] + $pickup['total'] < 500) {
                    $fee += 60;
                }
                if ($delivery['total'] + $pickup['total'] < 1000) {
                    $fee += 60;
                }
            } elseif ((1000 <= $distance) && ($distance <= 3999)) {
                if ($delivery['total'] + $pickup['total'] < 500) {
                    $fee += 60;
                }
            }
        }

        if ($subscribe['qty'] != 0) {
            if (count($subscribe['date']) < 10 && $distance > 6000) {
                $fee = 260 * count($subscribe['date']);
            } elseif ((4000 <= $distance) && ($distance <= 5999)) {
                $fee += 120;
            } elseif ((1000 <= $distance) && ($distance <= 3999)) {
                $fee += 60;
            }
        }

        return $fee;
    }

}
