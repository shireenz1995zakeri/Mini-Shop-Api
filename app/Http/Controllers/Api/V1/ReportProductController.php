<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportProductController extends ApiBaseController
{
    //پربازدید ترین محصولات
    public function theMostVisitedProducts(ProductRepositoryInterface $repository, Request $request)
    {
        return $repository->theMostVisitedProducts();

    }
    //10محصول گران قیمت
    //Expensive
    public function expensive(ProductRepositoryInterface $repository)
    {
        return $repository->expensive();
    }

    //پر بحث ترین کامنت ها
    public function theMostCommentProducts(ProductRepositoryInterface $repository)
    {
        return $repository->theMostCommentProducts();
    }

    ////////////////////////////////////////////////////////////////////////////////
    public function index(ProductRepositoryInterface $repository, Request $request)
    {
        if ($request->input('best')) {
            $model = $repository->theMostVisitedProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
                'پربازدیدترین ها');

        } elseif ($request->input('controversial')) {
            $model = $repository->theMostCommentProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
                'پربحث  ترین ها');

        } elseif ($request->input('expensive')) {
            $model = $repository->expensive();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
                'گران ترین ها');

        } elseif ($request->input('add')) {


            $groupingColumn = '2023-10-20'; // Set the grouping date dynamically

            $orders = Order::select(DB::raw("DATE(created_at) as date"),
                DB::raw('SUM(totalAmount) as total_amount'))
                ->whereDate('created_at', $groupingColumn)
                ->groupBy(DB::raw("DATE(created_at)"))
                ->get();
            dd($orders->toArray());
            return OrderResource::make($orders);
        } elseif ($request->input('popularProducts')) {
            $model = $repository->popularProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
                'محبوب ترین ها');
        } elseif ($request->input('getOldProductsByDate')) {
            $model = $repository->getOldProductsByDate();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );

        } elseif ($request->input('getNewProductsByDate')) {
            $model = $repository->popularProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );
        } elseif ($request->input('getProductsByDate')) {
            $model = $repository->popularProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );
        } elseif ($request->input('NumberOfAproductPurchasedByAUser')) {
            $model = $repository->NumberOfAproductPurchasedByAUser();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );
        } elseif ($request->input('BestSellingProducts')) {
            $model = $repository->BestSellingProducts();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );
        } elseif ($request->input('ProductBuyUser')) {
            $model = $repository->ProductBuyUser();
            return $this->successResponse(
                ProductResource::collection($model->load(['views', 'category'])),
            );
        }


    }


}
