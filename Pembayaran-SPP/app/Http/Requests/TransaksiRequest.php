<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
            'siswa_id' => 'required',
            'tgl_bayar' => 'required',
            'bulan_bayar' => 'required',
            'spp_id' => 'required',
            'jumlah_bayar' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'siswa_id.required' => 'Data siswa tidak boleh kosong',
            'tgl_bayar.required' => 'Tanggal bayar tidak boleh kosong',
            'bulan_bayar.required' => 'Bulan bayar tidak boleh kosong',
            'spp_id.required' => 'Spp tidak boleh kosong',
            'jumlah_bayar.required' => 'Jumlah bayar tidak boleh kosong',
        ];
    }
}
