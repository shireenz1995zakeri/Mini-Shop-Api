<?php

namespace App\Http\Resources;


use App\Http\Resources\CategoryResource;

use App\Http\Resources\UserResource;
use App\Services\Translation\TranslationService;
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
           // 'title'=>TranslationService::get($this->resource,'title'),
            'title'=>$this->title,
            'body'=>$this->body,
            'published'=>$this->published,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'category'=>CategoryResource::make($this->category),
            'user_id'=>UserResource::make($this->user),

        ];
    }
}
