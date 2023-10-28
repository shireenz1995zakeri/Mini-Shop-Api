<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderService
{
    use AsAction;

    public function __construct(public OrderRepositoryInterface $repository)
    {

    }

    public function handle($payload,$amounts,$token)
    {
//
//        $order=Order::create([
//            'user_id'=>$request->user_id,
//            'totalAmount'=>$amounts['totalAmount'],
//            'status'=>1,
//
//        ]);
//        foreach ($request['order_items'] as $order_item)
//        {
//            $product= Product::findOrFail($order_item['product_id']);
//            OrderItem::create([
//                'order_id' => $order->id,
//                'product_id'=>$product->id,
//                'price'=>$product->price,
//                'qyt'=>$order_item['qyt'],
//            ]);
//        }
//        Transaction::create([
//            'user_id'=>$request->user_id,
//            'order_id' => $order->id,
//            'amount'=>$amounts['totalAmount'],
//            'token'=>$token,
//            'request_from'=>$request->request_from,
//        ]);

        return DB::transaction(function () use($payload){
          $model=$this->repository->store($payload);
            return $model;
        });

    }
}
