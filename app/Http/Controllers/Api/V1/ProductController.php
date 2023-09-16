<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Product\DeleteProductService;
use App\Services\Product\StoreProductService;
use App\Services\Product\UpdateProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\ApiBaseController;


class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ProductRepositoryInterface $repository)
    {
        if($request->input('limit'==-1)){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());

        }
        return $this->successResponse(["products"=>ProductResource::collection($model),
            "links"=>ProductResource::collection($model)->response()->getData()->links],"محصولات نمایش داده شد");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,StoreProductService $service)
    {

       $model=$service->handle($request->validated());
        return $this->successResponse(ProductResource::make($model),'کاربر باموفقیت ایجاد شد');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,ProductRepositoryInterface $repository)
    {
        $model=$repository->find($product->id);
        return $this->successResponse(ProductResource::make($model),'محصول مورد نظر یافت شد ');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product,UpdateProductService $service)
    {
        $model=$service->handle($product,$request->validated());
        return $this->successResponse(ProductResource::make($model),'محصول مورد نظر آپدیت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,DeleteProductService $service)
    {
        $service->handle($product);
        return $this->successResponse(ProductResource::make($product),'محصول مورد نظر حدف  شد');

    }
}
