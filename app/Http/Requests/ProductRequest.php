<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'translation' =>'array',
            'translation.fa.title'=>'string|required',
            'translation.en.title'=>'string|required',
            'translation.fa.body'=>'string|required',
            'translation.en.body'=>'string|required',
            'price'       => 'required|numeric|between:0.00,9999.99',
            'inventory'   => 'integer',
            'published'   => 'boolean',
            'category_id' => ['required',  'exists:categories,id'],
            "brand_id"    => ['integer', 'exists:brands,id'],
            "image"=>['image','mimes:png,jpg,jpeg,svg']

        ];
    }
}
