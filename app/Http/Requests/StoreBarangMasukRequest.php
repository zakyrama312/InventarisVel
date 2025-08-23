<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangMasukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'namabarang' => 'required',
            'kodebarang' => 'required',
            'merkbarang' => 'required',
            'stokmasuk' => 'required|numeric',
            'kategori' => 'required',
            'kondisi' => 'required',
            'jurusan' => 'required',
            'ruang' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Data :attribute harus diisi',
            'unique' => 'Data sudah ada',
            'min' => 'Jumlah karakter kurang',
            'max' => 'Jumlah karakter terlalu panjang',
            'email' => 'Harus berupa Email',
            'numeric' => 'Harus berupa Nomor'
        ];
    }
    public function attributes(): array
    {
        return [
            'namabarang' => 'Nama Barang',
            'kodebarang' => 'Kode Barang',
            'merkbarang' => 'Merk Barang',
            'stokmasuk' => 'Stok Masuk',
            'ukuran' => 'Ukuran',
            'bahan' => 'Bahan',
            'tahunbeli' => 'Tahun Beli',
            'hargabeli' => 'Harga Beli',
            'spesifikasi' => 'Spesifikasi',
            'keterangan' => 'Keterangan',
            'kategori' => 'Kategori',
            'kondisi' => 'Kondisi',
            'jurusan' => 'Jurusan',
            'ruang' => 'Ruang',
        ];
    }
}
