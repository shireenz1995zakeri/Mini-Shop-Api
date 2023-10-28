<?php

namespace App\Http\Resources;


use App\Http\Resources\CategoryResource;

use App\Http\Resources\UserResource;
use App\Models\View;

use Illuminate\Http\Resources\Json\JsonResource;
class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,

            'uuid'=>$this->uuid,
            'translation'=>$this->whenLoaded('translation',fn()=>TranslationResource::collection($this->translation)),

            // 'title'=>TranslationService::get($this->resource,'title'),

            'published'=>$this->published,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'category'=>$this->whenLoaded('category',fn()=>CategoryResource::make($this->category)),

            'user_id'=>$this->whenLoaded('user',fn()=>UserResource::make($this->user)),
            'like'=>$this->whenLoaded('likes',fn()=>LikeResource::collection($this->likes)),
            'comment'=>$this->whenLoaded('comments',fn()=>CommentResource::collection($this->comments)),
            'views_count'=>$this->whenLoaded('views',fn()=> $this->views->count()),
            'medias'=>$this->whenLoaded('medias',fn()=>MediaResource::collection($this->medias)),
            'translation'=>$this->whenLoaded('translation',fn()=>TranslationResource::collection($this->translation)),


        ];
    }
}
