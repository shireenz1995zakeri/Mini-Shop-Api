<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class showBrandWithProductResource extends JsonResource
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
            'user_id'   => $this->user_id,
           // 'user'      => $this->whenLoaded('user',UserResource::make($this->user)),
          //  'category'  => $this->whenLoaded('category',CategoryResource::make($this->category)),
            'user_id'=>$this->user_id,
            'category_id'=>$this->category_id,
            'brand_id'     => $this->brand_id,
            'title'     => $this->title,
            'body'      => $this->body,
            'inventory' => $this->inventory,
            'published' => $this->published,
            'price'     => $this->price,
        ];
    }
}
