<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,OrderRepositoryInterface $repository)
    {
        if($request->input('limit')==-1){
            $model=$repository->get($request->all());
        }else{
            $model=$repository->paginate($request->input('limit',5).$request->all());
        }

        return $this->successResponse(['orders'=>OrderItemResource::collection($model),
    'links'=>OrderItemResource::collection($model)->response()->getData()->links],"لیست سفارشات با موفقیت نمایش داده شد");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,StoreOrderService $service)
    {
        $model=$service->handle($request->validated());
        return $this->successResponse(OrderResource::make($model),'سفارش باموفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order,OrderRepositoryInterface $repository)
    {
        $model=$repository->find($order->id);
        return $this->successResponse(BlogResource::make($order),'بلاگ باموفقیت نمایش داده شد');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order,StoreOrderService $service)
    {
        $model=$service->handle($request->validated());
        return $this->successResponse(OrderResource::make($model),'سفارش آپدیت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order,DeleteOrderService $service)
    {
        $service->handle($order);
        return $this->successResponse(OrderResource::make($order),"حدف شد");

    }
}
