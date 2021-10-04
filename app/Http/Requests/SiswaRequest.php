<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
        $id = empty($this->siswa->id) ? '' : $this->siswa->id;
        return [
            'nisn' => 'required|unique:siswa,nisn,'.$id.'|numeric',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' =>'required|min:8'
        ];
    }
    public function messages()
    {
        return [
            'nisn.required' => 'Nisn tidak boleh kosong',
            'nisn.unique' => 'Nisn Sudah tersedia',
            'nis.required' => 'Nis tidak boleh kosong',
            'nama.required' => 'Nama siswa tidak boleh kosong',
            'kelas_id.required' => 'Kelas tidak boleh kosong',
            'alamat.required' => "Alamat tidak boleh kosong",
            "no_telp.required" => "Nomor telepon tidak boleh kosong",
            'no_telp.min' => "Minimal 8 Character"
        ];
    }
}
