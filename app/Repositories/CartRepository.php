<?php

namespace App\Repositories;

use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;

class CartRepository
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart        = $this->cart->content();
        $cart->qty   = $this->cart->count();
        $cart->total = $this->cart->total(0, '.', '');
        return $cart;
    }

    public function create($request)
    {
        $product = Product::where('id', $request['id'])->first();

        $item = current(current($this->cart->search(function ($cartItem) use ($request) {
            return $cartItem->id == $request['id'];
        })));

        if ($request['mode'] === 'SUBSCRIBE') {
            $received_at = explode(', ', $request['received_at']);
            $date_qty    = $item->options['date_qty'] ?? array();
            foreach ($received_at as $request_date) {
                $date_qty[$request_date] = isset($date_qty[$request_date]) ? ++$date_qty[$request_date] : 1;
            }
            ksort($date_qty);
            if ($item && $item->options['mode'] === $request['mode']) {
                $options = $item->options->merge(['date_qty' => $date_qty]);
                $result  = $this->update(['qty' => array_sum($date_qty), 'options' => $options], $item->rowId);
            } else {
                $result = $this->cart->add($product, array_sum($date_qty), ['date_qty' => $date_qty, 'mode' => $request['mode']]);
            }
        } else {
            $result = $this->cart->add($product, $request['qty'], ['mode' => $request['mode']]);
        }

        return $result;
    }

    public function get($id)
    {
        return $this->cart->get($id);
    }

    public function update($request, $id)
    {
        return $this->cart->update($id, $request);
    }

    public function delete($id)
    {
        return $this->cart->remove($id);
    }

    public function truncate()
    {
        return $this->cart->destroy();
    }
}
