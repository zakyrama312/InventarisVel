<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idJurusan = Auth::user()->prodi_id;
        $categories =  Kategori::select('kategori.*')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('barang_stoks', 'barang.id', '=', 'barang_stoks.barang_id')
                    ->select(DB::raw('SUM(barang_stoks.stok_masuk)'))
                    ->whereColumn('barang.kategori_id', 'kategori.id');
            }, 'total_stok_masuk')
            ->get();

        return view('kategori.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        $idjurusan = Auth::user()->prodi_id;
        $request->validated();
        Kategori::create([
            'nama_kategori' => $request->namakategori,
            'slug' => Str::slug($request->namakategori),
            'prodi_id' => $idjurusan
        ]);

        return redirect('kategori');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, $id)
    {
        // Validasi request
        $data = $request->validate([
            'namakategori' => 'required|string|max:255',
            // tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Temukan model berdasarkan $id
        $kategori = Kategori::findOrFail($id);

        // Update nilai-nilai model
        $kategori->nama_kategori = $data['namakategori'];
        $kategori->slug = Str::slug($data['namakategori']);
        // tambahkan update nilai lainnya sesuai kebutuhan Anda

        // Simpan perubahan
        $kategori->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('kategori');
    }
}
