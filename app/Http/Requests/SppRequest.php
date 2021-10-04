<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SppRequest extends FormRequest
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
        $id = empty($this->spp->id) ? ' ' : $this->spp->id;
        return [
            'tahun' => "required|numeric|unique:spp,tahun,$id",
            'nominal' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'tahun.required' => 'Data tahun tidak boleh kosong',
            'nominal.required' => 'Nominal tidak boleh kosong',
        ];
    }
}
