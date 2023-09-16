<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Services\Brand\DeleteBrandService;
use App\Services\Brand\StoreBrandService;
use App\Services\Brand\UpdateBrandService;
use Illuminate\Http\Request;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Http\Controllers\Api\v1\ApiBaseController;


class BrandController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,BrandRepositoryInterface $repository)
    {

        if($request->input('limit')==-1){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());
        }
        return $this->successResponse(["brands"=>BrandResource::collection($model),
            "links"=>BrandResource::collection($model)->response()->getData()->links],'برند ها با موفقیت نمایش داده شد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request,StoreBrandService $service)
    {
        $model=$service->handle($request->validated());
        return $this->successResponse(BrandResource::make($model),'برند باموفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand,BrandRepositoryInterface $repository)
    {
       // dd($brand->id);
        $model=$repository->find($brand->id);
        return $this->successResponse(BrandResource::make($model),'برند باموفقیت نمایش داده شد');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand,UpdateBrandService $service)
    {
        $model=$service->handle($brand,$request->validated());
        return $this->successResponse(BrandResource::make($model),'برند باموفقیت آپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand,DeleteBlogService $service)
    {
        $service->handle($brand);
        return $this->successResponse(BrandResource::make($brand),'برند  حدف شد');
    }

    public function getProducts(Brand $brand)
    {
        //return $this->successResponse(new BrandResource($brand->load('products')),'getProducts');
        return $this->successResponse(ProductResource::collection($brand->products),'getProducts');


    }
}
