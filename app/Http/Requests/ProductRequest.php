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
            'title'       => ['required', 'string'],
            'body'        => ['string'],
            'price'       => 'required|numeric|between:0.00,9999.99',
            'inventory'   => 'integer',
            'published'   => 'boolean',
            'category_id' => ['required', 'string', 'unique:categories,title'],
            "brand_id"    => ['integer', 'exists:brands,id'],
            "image"=>['required','image','mimes:png,jpg,jpeg,svg']

        ];
    }
}
