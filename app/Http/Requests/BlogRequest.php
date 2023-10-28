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

                'translation' =>'array',
                'translation.fa.title'=>'string|required',
            'translation.en.title'=>'string|required',
                'translation.fa.body'=>'string|required',
               'translation.en.body'=>'string|required',


            'category_id' => ["int", 'nullable'],
            'user_id'     => ['int', 'nullable'],
            //'title'       => ['required', 'string'],
           // 'body'        => ['required', 'string'],
            'published'   => ['boolean'],

        ];
    }
}
