<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\ProductRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ProductResource;
use App\Models\Blog;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Like\LikeService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\StoreProductService;
use App\Services\Product\UpdateProductService;
use App\Services\View\ViewServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\ApiBaseController;


class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->middleware('auth:sanctum');
//        $this->authorizeResource(Blog::class);
//    }
    public function index(Request $request,ProductRepositoryInterface $repository)
    {
        if($request->input('limit'==-1)){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());

        }
        return $this->successResponse(["products"=>ProductResource::collection($model),
            "links"=>ProductResource::collection($model)->response()->getData()->links],
            __('ApiMassage.Products were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

       $model=StoreProductService::run($request->validated());
        return $this->successResponse(ProductResource::make($model->load('translation','medias')),
            __('ApiMassage.Product created  successfully'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,ProductRepositoryInterface $repository, ViewServices $service)
    {
        $service->addview($product);
        $model=$repository->find($product->id);
        return $this->successResponse(ProductResource::make(
            $model->load(['comments','likes','views','category','medias','brand','translation'])),
            __('ApiMassage.The product was shown'));
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
        $model=UpdateProductService::run($product,$request->validated());
        return $this->successResponse(ProductResource::make($model->load(['translation','medias'])),
            __('ApiMassage.The product has been updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,DeleteProductService $service)
    {
        DeleteProductService::run($product);
        return $this->successResponse(ProductResource::make($product),    __('ApiMassage.Product deleted'));

    }

    public function toggle(Product $product,ProductRepositoryInterface $repository)
    {

        $model = $repository->toggle($product);
        return $this->successResponse(
            ProductResource::make($product->load(['category'])),
            //"Message status updated successfully"
            __('ApiMassage.Message status updated successfully')
        );


    }

    public function addLikeProduct(Product $product, LikeService $service)
    {
        $service->addLike($product);
    }


}
