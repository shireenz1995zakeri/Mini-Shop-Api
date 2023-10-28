<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Order\StoreOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Order::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,OrderRepositoryInterface $repository)
    {
        if($request->input('limit')==-1){
            $model=$repository->query($request->all());
        }else{
            $model=$repository->paginate($request->input('limit',5).$request->all());
        }

        return $this->successResponse(['orders'=>OrderItemResource::collection($model),
    'links'=>OrderItemResource::collection($model)->response()->getData()->links],
            __('ApiMassage.Orders were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function create(OrderRequest $request ,$amounts,$token)
    {


        $order=Order::create([
            'user_id'=>$request->user_id,
            'totalAmount'=>$amounts['totalAmount'],
            'status'=>1,

        ]);
        foreach ($request['order_items'] as $order_item)
        {
           $product= Product::findOrFail($order_item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id'=>$product->id,
                'price'=>$product->price,
                'qyt'=>$order_item['qyt'],
            ]);
        }
        Transaction::create([
            'user_id'=>$request->user_id,
            'order_id' => $order->id,
            'amount'=>$amounts['totalAmount'],
            'token'=>$token,
            'request_from'=>$request->request_from,
        ]);

    }
    public static function update($token,$transId)
    {

            DB::beginTransaction();

            $transaction=Transaction::where('token',$token)->firstOrFail();

            $transaction->update([
                'status'=>1,
                'trans_id'=>$transId
            ]);

            $order=Order::findOrFail($transaction->order_id);
//            dd($order);
            $order->update([
                'payment_status'=>1,
                'status'=>2,

            ]);

            $OrderItem=OrderItem::where('order_id',$order->id)->get();
            foreach ($OrderItem as $item){
                $product=Product::find($item->product->id);
                $product->update([
                        'inventory'=>($product->inventory - $item->qyt),
                ]);
            }
           DB::commit();

    }
//    public function  store(Request $request,$amounts)
//    {
//
//      $model=  $this->service->handle([
//            'user_id'=>$request['user_id'],
//            'total_amount'=>$amounts['totalAmount'],
//        ]);
//        return $this->successResponse(OrderResource::make($model),'سفارش باموفقیت ایجاد شد');
//    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order,OrderRepositoryInterface $repository)
    {
        $model=$repository->find($order->id);
        return $this->successResponse(OrderResource::make($order),
            __('ApiMassage.The order has been updated successfully'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DeleteOrderService::run($order);
        return $this->successResponse(OrderResource::make($order),    __('ApiMassage.Order deleted'));

    }
}
