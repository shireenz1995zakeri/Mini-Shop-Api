<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\Blog\DeleteBlogService;
use App\Services\Blog\NewBlogsService;
use App\Services\Blog\RemoveOldestBlogService;
use App\Services\Blog\StoreBlogService;
use App\Services\Blog\UpdateBlogService;
use App\Services\Like\LikeService;
use App\Services\View\ViewServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class BlogController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Blog::class);
    }
    public function index(Request                 $request,
                          BlogRepositoryInterface $repository)
    {

        if ($request->input('limit') == -1) {
            $model = $repository->get($request->all());
        } else {
            $model = $repository->paginate($request->input('limit', 5), $request->all());
        }


        return $this->successResponse([
            "blogs" => BlogResource::collection($model),
            "links" => BlogResource::collection($model)->response()->getData()->links],
            __('ApiMassage.Blogs were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request):JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $model = StoreBlogService::run($data);
        return $this->successResponse(BlogResource::make($model->load(['category','translation'])),
            __('ApiMassage.Blog created  successfully'));


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(BlogRepositoryInterface $repository,Blog $blog, ViewServices $service)
    {
        $service->addview($blog);
        $data=$repository->find($blog->id);

        return $this->successResponse(BlogResource::make(
            $data->load(['category', 'user', 'medias', 'comments', 'views', 'likes','translation'])),
            __('ApiMassage.The blog was shown'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, UpdateBlogService $service, Blog $blog)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $model = UpdateBlogService::run($blog, $data);

        return $this->successResponse(BlogResource::make($model->load(['category','translation'])),
            __('ApiMassage.The blog has been updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, DeleteBlogService $service)
    {
//
        DeleteBlogService::run($blog);

        return $this->successResponse(BlogResource::make($blog),     __('ApiMassage.Blog deleted'));
    }


    public function toggle(Blog $blog, BlogRepositoryInterface $repository)
    {
         $repository->toggle($blog);
        return $this->successResponse(
            BlogResource::make($blog),
            __('ApiMassage.Message status updated successfully')
        );


    }

    //    لایک کردن مقالات
    public function addLikeBlog(Blog $blog, LikeService $service)
    {
        $service->addLike($blog);
    }


}
