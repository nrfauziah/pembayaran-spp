<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class kelasReuqest extends FormRequest
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
        $id = empty($this->kelas->id) ? ' ' : $this->kelas->id;
        return [
            'nama'=> "required|unique:kelas,nama,$id",
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama kelas tidak boleh kosong',
            'nama.unique' => "Nama kelas sudah tersedia"
        ];
    }
}
