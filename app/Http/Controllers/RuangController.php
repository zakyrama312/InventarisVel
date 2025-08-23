<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\BarangMasuk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRuangRequest;
use App\Http\Requests\UpdateRuangRequest;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idJurusan = Auth::user()->prodi_id;
        $rooms =  Ruang::select('ruang.*')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('barang_stoks', 'barang.id', '=', 'barang_stoks.barang_id')
                    ->select(DB::raw('SUM(barang_stoks.stok_masuk)'))
                    ->whereColumn('barang.ruang_id', 'ruang.id');
            }, 'total_stok_masuk')
            ->get();
        return view('ruang.index', compact('rooms'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRuangRequest $request)
    {
        $idjurusan = Auth::user()->prodi_id;
        $request->validated();
        Ruang::create([
            'nama_ruang' => $request->namaruang,
            'slug' => Str::slug($request->namaruang),
            'prodi_id' => $idjurusan
        ]);

        return redirect('ruang');
    }

    public function show($slug)
    {
        $idjurusan = Auth::user()->prodi_id;
        $ruang = Ruang::where('slug', $slug)
            ->where('prodi_id', $idjurusan)
            ->first();
        // Jika ruang ditemukan, ambil data barangmasuk berdasarkan id ruang
        if ($ruang) {
            $barangmasuk = BarangMasuk::with(['barangstoks', 'kondisi', 'ruang'])
                ->where('ruang_id', $ruang->id)->get();
        } else {
            $barangmasuk = collect(); // Jika ruang tidak ditemukan, return collection kosong
        }
        return view('ruang.show', compact('ruang', 'barangmasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuangRequest $request, $id)
    {
        $data = $request->validate([
            'namaruang' => 'required|string|max:255',
        ]);

        $ruang = Ruang::findOrFail($id);

        $ruang->nama_ruang = $data['namaruang'];
        $ruang->slug = Str::slug($data['namaruang']);

        $ruang->save();

        return redirect('ruang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Ruang::findOrFail($id);
        $ruang->delete();

        return redirect('ruang');
    }

    public function print($slug)
    {
        $idjurusan = Auth::user()->prodi_id;
        $ruang = Ruang::where('slug', $slug)
            ->where('prodi_id', $idjurusan)
            ->first();

        $tanggal = \Carbon\Carbon::parse(now())->locale('id')->translatedFormat('d F Y ');
        // Jika ruang ditemukan, ambil data barangmasuk berdasarkan id ruang
        if ($ruang) {
            $barangmasuk = BarangMasuk::with(['barangstoks', 'kondisi', 'ruang'])
                ->where('ruang_id', $ruang->id)->get();
        } else {
            $barangmasuk = collect(); // Jika ruang tidak ditemukan, return collection kosong
        }
        return view('ruang.print.index', compact('ruang', 'barangmasuk', 'tanggal'));
    }
}
