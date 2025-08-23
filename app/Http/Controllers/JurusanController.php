<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jrsn = Jurusan::select('prodi.*')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('barang_stoks', 'barang.id', '=', 'barang_stoks.barang_id')
                    ->select(DB::raw('SUM(barang_stoks.stok_masuk)'))
                    ->whereColumn('barang.prodi_id', 'prodi.id');
            }, 'total_stok_masuk')
            ->get();
        return view('jurusan.index', compact('jrsn'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJurusanRequest $request)
    {
        $request->validated();
        Jurusan::create([
            'nama_jurusan' => $request->namajurusan,
            'slug' => Str::slug($request->namajurusan)
        ]);

        return redirect('jurusan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJurusanRequest $request, $id)
    {
        // Validasi request
        $data = $request->validate([
            'namajurusan' => 'required|string|max:255',
            // tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Temukan model berdasarkan $id
        $jurusan = Jurusan::findOrFail($id);

        // Update nilai-nilai model
        $jurusan->nama_jurusan = $data['namajurusan'];
        $jurusan->slug = Str::slug($data['namajurusan']);
        // tambahkan update nilai lainnya sesuai kebutuhan Anda

        // Simpan perubahan
        $jurusan->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect('jurusan');
    }
}
