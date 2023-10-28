<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'family' => $this->family,
            'email' => $this->email,
            'mobile_number'=>$this->mobile_number,
            'medias' => $this->whenLoaded('medias', fn() => MediaResource::collection($this->medias)),
            'blog' => $this->whenLoaded('blogs', fn() => BlogResource::collection($this->blogs)),
            'product' => $this->whenLoaded('products', fn() => ProductResource::collection($this->products)),
            'like' => $this->whenLoaded('likes', fn() => LikeResource::collection($this->likes)),
            'views' => $this->whenLoaded('views', fn() => ViewResource::collection($this->views)),
            'comments' => $this->whenLoaded('comments', fn() => CommentResource::collection($this->comments)),

        ];
    }
}
