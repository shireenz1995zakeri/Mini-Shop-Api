<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'category_id' => ["int", 'nullable'],
            'user_id'     => ['int', 'nullable'],
            'title'       => ['required', 'string'],
            'body'        => ['required', 'string'],
            'published'   => ['boolean'],

        ];
    }
}
