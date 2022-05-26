<?php

namespace App\Http\Controllers;

use App\Contracts\IOrderService;
use App\Contracts\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(IUserService $userService, IOrderService $orderService)
    {
        $this->userService  = $userService;
        $this->orderService = $orderService;
    }

    public function wallet()
    {
        $user         = Auth::user();
        $transactions = $user->wallet->transactions()->where('confirmed', true)->orderBy('created_at')->get();
        
        $wallet = [
            'balance'      => $user->balance,
            'transactions' => $transactions,
        ];
        return view('user.wallet', compact('wallet'));
    }

    public function refs(Request $request)
    {
        $referrals = $this->userService->getReferrals(Auth::id());
        $refs      = $this->orderService->getUsersOrder($referrals);
        return view('user.refs', compact('refs'));
    }

    public function deposit($id, $type, $amount)
    {
        $user = $this->userService->find($id);
        $user->balance;
        $user->deposit($amount, [
            'type'       => $type,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('user.wallet');
    }

    public function withdraw($id, $type, $amount)
    {
        $user = $this->userService->find($id);
        $user->balance;
        $user->withdraw($amount, [
            'type'       => $type,
            'created_by' => Auth::id(),
        ]);
        return redirect()->route('user.wallet');
    }
}
