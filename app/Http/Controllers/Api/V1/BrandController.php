<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;

use App\Models\Brand;
use App\Services\Brand\DeleteBrandService;
use App\Services\Brand\StoreBrandService;
use App\Services\Brand\UpdateBrandService;
use Illuminate\Http\Request;
use App\Repositories\Brand\BrandRepositoryInterface;



class BrandController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Brand::class);
    }
    public function index(Request $request,BrandRepositoryInterface $repository)
    {

        if($request->input('limit')==-1){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());
        }
        return $this->successResponse(["brands"=>BrandResource::collection($model),
            "links"=>BrandResource::collection($model)->response()->getData()->links],
            __('ApiMassage.Brands were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $model=StoreBrandService::run($request->validated());
        return $this->successResponse(BrandResource::make($model->load('translation')),
            __('ApiMassage.Brand created  successfully'));
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
        return $this->successResponse(BrandResource::make($model->load('translation')),
            __('ApiMassage.The brand was shown'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $model=UpdateBrandService::run($brand,$request->validated());
        return $this->successResponse(BrandResource::make($model->load('translation')),
            __('ApiMassage.The brand has been updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        DeleteBrandService::run($brand);
        return $this->successResponse(BrandResource::make($brand),    __('ApiMassage.Brand deleted'));
    }

    public function getProducts(Brand $brand)
    {
//        $data=$brand->brand('products');
        //return $this->successResponse(BrandResource::collection($data),'getProducts');
        return $this->successResponse(BrandResource::make($brand->
        load('products')),//'getProducts'
            __('ApiMassage.get Products'));


    }
}
