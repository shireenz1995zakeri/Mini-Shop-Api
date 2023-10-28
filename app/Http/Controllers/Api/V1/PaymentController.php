<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Product;
use App\Services\Order\StoreOrderService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');

    }
    public function send(OrderRequest $request,storeOrderService $service)
    {
        $totalAmount=0;

        foreach ($request->order_items as $orderItem){
            $product=Product::findOrFail($orderItem['product_id']);

            if($product->inventory<$orderItem['qyt']){
                return $this->errorResponse(    __('ApiMassage.the product quantity is incorrect')//'the product quantity is incorrect',
               , 422);

            }
            $totalAmount +=$product->price * $orderItem['qyt'];

        }

        $amounts=[
          'totalAmount'=>$totalAmount
        ];

        $api = env('PAY_IR_API_KEY');
        $amount = $totalAmount.'0';
        $mobile = "شماره موبایل";
        $factorNumber = "شماره فاکتور";
        $description = "توضیحات";
        $redirect = env('PAY_IR_CALLBACK_URL');
        $result = $this->sendRequest($api, $amount, $redirect, $mobile, $factorNumber, $description);
        $result = json_decode($result);
//        dd($result->status);
        if ($result->status) {
            OrderController::create($request,$amounts,$result->token);
//            $service->handle([
//                'user_id'=>$request['user_id'],
//                'total_amount'=>$amounts['totalAmount'],
//
//
//            ],  $amounts,$result->token);
            $go = "https://pay.ir/pg/$result->token";
            return $this->successResponse([
                'url' => $go,

            ],     __('ApiMassage.The order has been updated successfully'));
        } else {

            return $this->errorResponse($result->errorMessage);
        }

    }

    public function verify(Request $request)
    {
        $valodator=Validator::make($request->all(),[
            'token'=>'required',
        ]);

        $api = env('PAY_IR_API_KEY');
        $token = $request->token;
        $result = json_decode($this->verifyRequest($api, $token));
       // return response()->json($result);

        if (isset($result->status)) {

            if ($result->status == 1) {
                OrderController::update($token,$result->transId);
                echo "<h1>__('ApiMassage.The transaction was completed successfully')</h1>";
            } else {
                echo "<h1>تراکنش با خطا مواجه شد</h1>";
            }
        } else {
            if ($_GET['status'] == 0) {
                echo "<h1>تراکنش با خطا مواجه شد</h1>";
            }
        }
    }

    public function sendRequest($api, $amount, $redirect, $mobile = null,
                                $factorNumber = null, $description = null)
    {
        return $this->curl_post('https://pay.ir/pg/send', [
            'api' => $api,
            'amount' => $amount,
            'redirect' => $redirect,
            'mobile' => $mobile,
            'factorNumber' => $factorNumber,
            'description' => $description,
        ]);
    }

    public function verifyRequest($api, $token)
    {
        return $this->curl_post('https://pay.ir/pg/verify', [
            'api' => $api,
            'token' => $token,
        ]);
    }


    public function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }


}
