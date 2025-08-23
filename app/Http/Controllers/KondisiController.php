<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKondisiRequest;
use App\Http\Requests\UpdateKondisiRequest;


class KondisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idJurusan = Auth::user()->prodi_id;

        $condition =  Kondisi::select('kondisi.*')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('barang_stoks', 'barang.id', '=', 'barang_stoks.barang_id')
                    ->select(DB::raw('SUM(barang_stoks.stok_masuk)'))
                    ->whereColumn('barang.kondisi_id', 'kondisi.id');
            }, 'total_stok_masuk')
            ->get();

        return view('kondisi.index', compact('condition'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKondisiRequest $request)
    {
        $idjurusan = Auth::user()->prodi_id;
        $request->validated();
        Kondisi::create([
            'nama_kondisi' => $request->namakondisi,
            'slug' => Str::slug($request->namakondisi),
            'prodi_id' => $idjurusan
        ]);

        return redirect('kondisi');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKondisiRequest $request, $id)
    {
        $data = $request->validate([
            'namakondisi' => 'required|string|max:255',
        ]);

        $kondisi = Kondisi::findOrFail($id);

        $kondisi->nama_kondisi = $data['namakondisi'];
        $kondisi->slug = Str::slug($data['namakondisi']);

        $kondisi->save();
        return redirect('kondisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kondisi = Kondisi::findOrFail($id);
        $kondisi->delete();

        return redirect('kondisi');
    }
}
