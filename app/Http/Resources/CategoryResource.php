<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                "id"=>$this->id,
                "title"=>$this->title,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
                //در صورتی که route:parentفراخوانی شده بود
                //آنگاه parent ها را به ما نشان بده
               // 'parent_id'=>new CategoryResource($this->whenLoaded('parent')),
               // 'parent_id'=>new CategoryResource($this->whenLoaded('children')),
                'products'=>new ProductResource($this->whenLoaded('products')),

            ];



    }
}
