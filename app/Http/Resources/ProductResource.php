<?php

namespace App\Http\Resources;

use App\Services\Translation\TranslationService;
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
           'id'=>$this->id,
            'inventory'=>$this->inventory,
            'published'=>$this->published,
            'title'=>$this->whenLoaded('translation',function (){
                return TranslationService::get($this->resource,'title');
            }),
            'body'=>$this->whenLoaded('translation',function (){
                return TranslationService::get($this->resource,'body');
            }),
            //'title'=>$this->title,
            //'body'=>$this->body,
            'price'=>$this->price,
            'category_id'=>CategoryResource::make($this->category),
            'brand_id'=>$this->whenLoaded('brand',function (){
                return BrandResource::make($this->resource->brand->load('translation'));
            })
        ];
    }
}
