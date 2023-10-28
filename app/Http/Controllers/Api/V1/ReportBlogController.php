<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Resources\BlogResource;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;


class ReportBlogController extends ApiBaseController
{


    //پربازدید ترین مقالات

    public function theMostVisitedBlogs(BlogRepositoryInterface $repository)
    {
        return $repository->theMostVisitedBlogs();

    }

    //پربحث ترین مقالات

    public function theMostCommentBlogs(BlogRepositoryInterface $repository)
    {
        return $repository->theMostCommentBlogs();

    }

    //////////////////////////////////////////////////////////////////////

    public function index(BlogRepositoryInterface $repository, Request $request)
    {

        if ($request->input('bestBlog')) {
            $model=$repository->theMostVisitedBlogs();
            return $this->successResponse(
                BlogResource::collection($model->load(['views','category'])),
                'پربازدیدترین ها');


        } elseif ($request->input('controversialBlog')) {
            $model=$repository->theMostCommentBlogs();
            return $this->successResponse(
                BlogResource::collection($model->load(['views','category'])),
                'پر بحث ترین  ها');


        }


    }


}
