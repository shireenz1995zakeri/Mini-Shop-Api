<?php

namespace App\Http\Resources;

use App\Services\Translation\TranslationService;
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
                'title'=>$this->whenLoaded('translation',function (){
                    return TranslationService::get($this->resource,'title');
                }),
               // "title"=>$this->title,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
                'children' => $this->whenLoaded('children',fn()=>CategoryResource
                    ::collection($this->children)),
                'parent' => $this->whenLoaded('parent',fn()=>CategoryResource
                    ::make($this->parent)),
                'products'=>new ProductResource($this->whenLoaded('products')),

            ];



    }
}
