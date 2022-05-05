<?php

namespace App\Http\Livewire\Order;

use App\Contracts\ICartService;
use App\Contracts\IOrderService;
use App\Models\Map;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $cart;

    public $fee = 0;

    public $distance;

    public $cities = [];

    public $city;

    public $districts = [];

    public $district;

    public $roads = [];

    public $map_id;

    public $name;

    public $mobile;

    public $address;

    public $info = '';

    public $useLastInfo = true;

    protected $listeners = [
        'updateFee',
    ];

    public function mount(ICartService $cartService, IOrderService $orderService, $total, $cart)
    {
        $this->cart = $cartService->index();
        $this->useLastInfo($cartService, $orderService);
    }

    public function useLastInfo(ICartService $cartService, IOrderService $orderService)
    {
        if ($this->useLastInfo && Auth::check()) {
            $order = Order::where(['user_id' => Auth::user()->id])->latest()->first();
            if ($order) {
                $this->name      = $order->name;
                $this->mobile    = $order->mobile;
                $this->address   = $order->address;
                $map             = Map::find($order->map_id);
                $this->city      = $map->city;
                $this->district  = $map->district;
                $this->map_id    = $order->map_id;
                $this->districts = Map::where([
                    'city' => $this->city,
                ])->distinct()->get('district')->flatten();
                $this->roads = Map::where([
                    'city'     => $this->city,
                    'district' => $this->district,
                ])->get(['id', 'road'])->unique();
                $this->distance = $map->distance;
                $this->updateFee($cartService, $orderService);
            }
        } else {
            $this->reset([
                'name',
                'mobile',
                'address',
                'city',
                'district',
                'map_id',
                'districts',
                'roads',
                'distance',
                'info',
                'fee',
            ]);
        }
    }

    public function getDistricts()
    {
        $this->roads = [];
        $this->reset('distance', 'info', 'address');
        $this->districts = Map::where([
            'city' => $this->city,
        ])->distinct()->get('district')->flatten();
    }

    public function getRoads()
    {
        $this->reset('distance', 'info', 'address');
        $this->roads = Map::where([
            'city'     => $this->city,
            'district' => $this->district,
        ])->get(['id', 'road'])->unique();
    }

    public function getDistance(IOrderService $orderService)
    {
        $this->reset('distance', 'info', 'address');
        $this->distance = $orderService->getDistance($this->map_id);
        $this->emit('updateFee');
    }

    public function updateFee(ICartService $cartService, IOrderService $orderService)
    {
        $this->cart = $cartService->index();
        if ($this->distance) {
            $this->fee  = $orderService->calcFee($this->cart, $this->distance);
            $this->info = '訂單金額: ' . $this->cart->total . ', 距離: ' . $this->distance . ' 公尺, 運費: ' . $this->fee;
        } else {
            $this->info = '距離計算錯誤！可能在服務區外';
        }
    }

    public function render(ICartService $cartService)
    {
        $this->cart   = $cartService->index();
        $maxId        = DB::raw('MAX(id)');
        $this->cities = Map::groupBy('city')->orderBy($maxId)->get('city');
        return view('livewire.order.create');
    }
}
