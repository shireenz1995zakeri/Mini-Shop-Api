<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name'=>'required',

            'email' => $this->method()===self::METHOD_PATCH ? 'string|email|unique:users,email,'.
                $this->user->id :'string|email|unique:users,email',
            'mobile_number'=>'required',
            'password'=>'required|min:6',
            //'role'=>['required','max:255',Rule::in(['admin','user','author'])],
        ];
    }
}
