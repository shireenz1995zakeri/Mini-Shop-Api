<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id'   => $this->id,
            'type' => $this->whenLoaded('type', fn() =>$this->commentable_type),
            //'comment_id' => $this->commentable_id,
            'data' => $this->whenLoaded('commentable', fn() =>$this->commentable),
            'comment'=>$this->comment,
            'replies'=>$this->replies,
            'parent'=>$this->whenLoaded('parent', fn() => $this->parent),
        ];
    }
}
