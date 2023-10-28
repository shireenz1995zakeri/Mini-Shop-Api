<?php

namespace App\Http\Resources;

use App\Services\Translation\TranslationService;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'uuid'     => $this->uuid,
//            dd(TranslationService::get($this->resource,'title')),
            'title'=>$this->whenLoaded('translation',function (){
               return TranslationService::get($this->resource,'title');
            }),

            // 'title'=>$this->title,
            'products' => $this->whenLoaded('products',
                fn()=>ProductResource::collection($this->products)),
        ];
    }
}
