<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authrequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|min:8'
        ];
    }
    public function messages()
    {
        return [
            "username.required" => "Username tidak boleh kosong",
            "passowrd.required" => "Password tidak boleh kosong",
            "passowrd.min" => "Password minimal 8 character",
        ];
    }
}
