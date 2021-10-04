<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
        $id = empty($this->petugas->id) ? ' ' : $this->petugas->id;
        return [
            'username' => "required|unique:petugas,username,{$id}",
            'password' => 'required',
            'level' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username petugas tidak boleh kosong',
            'username.unique' => "Username petugas sudah tersedia",
            'password.required' => 'Password petugas tidak boleh kosong',
            'level.required' => 'Level petugas tidak boleh kosong',
        ];
    }
}
