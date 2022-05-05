<?php

namespace App\Contracts;

interface IOrderService extends IBaseService
{
    public function patchPayment($request, $id);

    public function getOrderItems($order_id);

    public function getDistance($id);

    public function getTasks($received_at);

    public function calcFee($cart, $distance);
}
