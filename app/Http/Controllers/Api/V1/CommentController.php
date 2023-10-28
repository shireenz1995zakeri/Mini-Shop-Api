<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Comment::class);
    }
    public function index(Request $request)
    {
        if (isset($request->published)) {
            $comments = Comment::where('published', $request->published)
                ->with(['user', 'commentable', 'replies'])->withCount('replies')
                ->paginate(5);
        } else {
            $comments = Comment::with(['user', 'commentable'])->paginate(5);

        }
        return $this->successResponse(["comments" => CommentResource::collection($comments),
            "links" => CommentResource::collection($comments)->response()->getData()->links],
            __('ApiMassage.Comments were successfully displayed'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (\Auth::user()) {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $model = StoreCommentService::run($data);
            return $this->successResponse(CommentResource::make($model),
                __('ApiMassage.Comment created  successfully'));
        } else {
            echo     __('ApiMassage.like');
            //'برای  کامنت باید وارد سایت شوید';
        }
    }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Comment $comment
         * @return \Illuminate\Http\Response
         */
        public
        function show(Comment $comment)
        {
            $comment->load('replies');
            return $this->successResponse(
                CommentResource::make($comment),
                //"Message status updated successfully"
                __('ApiMassage.The comment was shown')
            );
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Comment $comment
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request, Comment $comment,CommentRepositoryInterface $repository)
        {
            $this->authorize('manage', Comment::class);
             $repository->toggle($comment);

            return $this->successResponse(
                CommentResource::make($comment),
                //"Message status updated successfully"
                __('ApiMassage.The comment has been updated successfully')
            );
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Comment $comment
         * @return \Illuminate\Http\Response
         */
        public
        function destroy(Comment $comment)
        {
            return $this->successResponse($comment->delete(),
                //'The book has been successfully deleted'
                __('ApiMassage.Comment deleted'));

        }
    }
