<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BrandResource;
class ProductResource extends JsonResource
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
            'category_id'=>CategoryResource::make($this->category),
            'brand_id'=>BrandResource::make($this->brand),
            'inventory'=>$this->inventory,
            'published'=>$this->published,
            'title'=>$this->title,
            'body'=>$this->body,
            'price'=>$this->price,
        ];
    }
}
