<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BrandResource;
use App\Models\Blog;
use App\Models\Translation;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\Blog\DeleteBlogService;
use App\Services\Blog\StoreBlogService;
use App\Services\Blog\UpdateBlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\v1\ApiBaseController;




class BlogController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,BlogRepositoryInterface $repository)
    {
//
//
//        $blog =Blog::find(15);
//        $blog->published=0;
//        $blog->title="2222";
//        $blog->save();
//        return [
//            $blog->id,
//            $blog->published,
////            $blog->title,
//        ];
         //$blog->translation;
        //$blogs=Blog::with('translations')->get();

        //
        //$blogs=Blog::with('category')->get();
        //with('translations')-

        if($request->input('limit')==-1){
            $model=$repository->get($request->all());
        }else{
            $model = $repository->paginate($request->input('limit',5),$request->all());
        }


        return $this->successResponse(["blogs"=>BlogResource::collection($model),
            "links"=>BlogResource::collection($model)->response()->getData()->links],
            'بلاگ باموفقیت آپدیت شد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request,StoreBlogService $service)
    {
        $model=$service->handle($request->validated());
        return $this->successResponse(BlogResource::make($model),'کاربر باموفقیت ایجاد شد');

//       $blog= Blog::create([
//            'published'=>1,
//            'user_id'=>1,
//            'category_id'=>4,
//        ]);
//       $blog->translations()->create([
//           "key"=>"title",
//
//           'value'=> 'تست33',
//           'locale'=>'fa'
//       ]);
//        $blog->translations()->create([
//            "key"=>"title",
//
//            'value'=> 'test33',
//            'locale'=>'en'
//        ]);
//
////       $blog->translations()->create([
////           'key'=>'title',
////           'value'=>'blog1',
////           'locale'=>'fa',
////       ]);
//
////        $blog->translations()->create([
////            'key'=>'title',
////            'value'=>'blog1',
////            'locale'=>'en',
////        ]);
//        return $blog->load('translations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog,BLogRepositoryInterface $repository)
    {

        $model=$repository->find($blog->id);
        return $this->successResponse(BlogResource::make($blog),'بلاگ باموفقیت نمایش داده شد');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request,UpdateBlogService $service, Blog $blog)
    {
        $model=$service->handle($blog,$request->validated());

        return $this->successResponse(BlogResource::make($model),'بلاگ باموفقیت آپدیت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog,DeleteBlogService $service)
    {
//
        $service->handle($blog);

        return $this->successResponse(BlogResource::make($blog),'بلاگ حدف شد');
    }
}
