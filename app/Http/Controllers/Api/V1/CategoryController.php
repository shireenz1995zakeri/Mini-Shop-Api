<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShowBrandWithProductResource;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Blog\DeleteBlogService;
use App\Services\Category\StoreCategoryService;
use App\Services\Category\UpdateCategoryService;
use Illuminate\Http\Request;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Category::class);
    }
    public function index(Request $request,CategoryRepositoryInterface  $repository)
    {
        if($request->input('limit')==-1){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());
        }
        return $this->successResponse(['Categories'=>CategoryResource::collection($model),
            'links'=>CategoryResource::collection($model)->response()->getData()->links],
            __('ApiMassage.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request,StoreCategoryService $service)
    {
        $model=StoreCategoryService::run($request->validated());
        return $this->successResponse(CategoryResource::make($model->load('translation')),
            __('ApiMassage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category,CategoryRepositoryInterface  $repository)
    {
          $model=$repository->find($category->id);
        return $this->successResponse(CategoryResource::make($model->load('translation')),
            __('ApiMassage'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, UpdateCategoryService $service,Category $category)
    {

        $model=UpdateCategoryService::run($category,$request->validated());
        return $this->successResponse(CategoryResource::make($model->load('translation')),
            __('ApiMassage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,DeleteBlogService $service)
    {
        DeleteBlogService::run($category);
        return $this->successResponse(CategoryResource::make($category),
            __('ApiMassage'));
    }

    public function parent(Category $category)
    {
        return $this->successResponse(CategoryResource::make($category->load('parent')),
            __('ApiMassage'));
    }
    public function children(Category $category)
    {
        return $this->successResponse(CategoryResource::make($category->load('children')),
            __('ApiMassage'));
    }
    public function getProducts(Category $category)
    {

        return $this->successResponse(ShowBrandWithProductResource::collection($category->load('products')),
            //'get products in category'
            __('ApiMassage'));
    }
}
