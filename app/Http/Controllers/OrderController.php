<?php

namespace App\Http\Controllers;

use App\Contracts\IOrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->index($request->user());
        return view('order.index', compact('orders'));
    }

    public function store(StoreOrderRequest $request)
    {
        $request = $request->only(
            'name',
            'map_id',
            'address',
            'mobile',
        );
        $result = $this->orderService->create($request);
        if ($result) {
            return redirect()->route('order.show', ['order' => $result->id]);
        }
    }

    public function show($id)
    {
        $order = $this->orderService->find($id);
        $this->authorize('view', $order);
        return view('order.show', compact('order'));
    }

    public function edit($id)
    {
        $order = $this->orderService->find($id);
        $this->authorize('update', $order);
        return view('order.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $request = $request->only('name', 'map_id', 'address', 'mobile', 'payment', 'fee', 'message', 'status');
        $result  = $this->orderService->update($request, $id);
        return redirect()->route('order.edit', ['order' => $id]);
    }

    public function patchPayment(UpdateOrderRequest $request, $id)
    {
        $request           = $request->only('payment');
        $request['status'] = 'PAID';
        $result            = $this->orderService->patchPayment($request, $id);
        return redirect()->route('order.show', ['order' => $id]);
    }

    public function tasks(Request $request, $received_at)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403);
        }
        $orderItemSubs = $this->orderService->getTasks($received_at);
        return view('order.tasks', compact('orderItemSubs'));
    }

}
