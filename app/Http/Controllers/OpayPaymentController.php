<?php

namespace App\Http\Controllers;

use App\Contracts\IUserService;
use Bavix\Wallet\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpayAllInOne;
use OpayEncryptType;
use OpayPaymentMethod;

class OpayPaymentController extends Controller
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function pay(Request $request)
    {
        try {

            $obj = new OpayAllInOne();

            $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5"; //服務位置
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;
            $obj->HashKey     = config('allpay.hash_key');
            $obj->HashIV      = config('allpay.hash_iv');
            $obj->MerchantID  = config('allpay.merchant_id');
            $transaction      = Auth::user()->deposit($request->amount, [
                'type'       => 'deposit',
                'created_by' => Auth::id(),
            ], false);
            $MerchantTradeNo = str_pad($transaction->id, 15, "0", STR_PAD_LEFT);

            $obj->Send['ReturnURL']         = config('allpay.return_url'); //付款完成通知回傳的網址
            $obj->Send['ClientBackURL']     = $request->ClintBackURL; //付款完成後，於第三方頁面顯示回到我們服務的網址
            $obj->Send['MerchantTradeNo']   = $MerchantTradeNo; //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s'); //交易時間
            $obj->Send['TotalAmount']       = $request->amount; //交易金額
            $obj->Send['TradeDesc']         = Auth::id(); //交易描述
            $obj->Send['ChoosePayment']     = OpayPaymentMethod::ALL; //付款方式:全功能

            //訂單的商品資料
            array_push($obj->Send['Items'],
                array(
                    'Name'     => "錢包儲值",
                    'Price'    => (int) $request->amount,
                    'Currency' => "元",
                    'Quantity' => 1,
                    'URL'      => config('app.url'),
                ));

            //產生訂單(auto submit至OPay)
            $obj->CheckOut();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function receive(Request $request)
    {
        try {
            $obj              = new OpayAllInOne();
            $obj->HashKey     = config('allpay.hash_key');
            $obj->HashIV      = config('allpay.hash_iv');
            $obj->MerchantID  = config('allpay.merchant_id');
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;

            $arFeedback = $obj->CheckOutFeedback();
            if (sizeof($arFeedback) > 0) {
                $transaction = Transaction::find((int) $arFeedback['MerchantTradeNo']);
                $user        = $this->userService->find($transaction->payable_id);
                $user->confirm($transaction);
                echo '1|OK';
            } else {
                echo '0|Fail';
            }

        } catch (Exception $e) {
            echo '0|' . $e->getMessage();
        }
    }
}
