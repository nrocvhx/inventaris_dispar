<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data = [
            'kode_barang' => 'required',
            'nup' => 'required',
            'jenis_barang' => 'required',
            'merk' => 'required',
            'id_kategori' => 'required',
            'nopol' => 'required',
            'norang' => 'required',
            'nomes' => 'required',
            'tahun_pembuatan' => 'required',
            'bpkb' => 'required',
            'pajak' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
        ];

        if ($this->isMethod('POST') || $this->isMethod('PUT')) {
            $data['gambar.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $data;
    }
}
