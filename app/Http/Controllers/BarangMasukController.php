<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Jurusan;
use App\Models\Kondisi;
use App\Models\Kategori;
use App\Models\BarangMasuk; // ini mapping ke tabel barang
use App\Models\BarangStoks; // ini mapping ke tabel barang_stoks
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $idJurusan = Auth::user()->prodi_id;

        if ($request->ajax()) {
            $query = BarangMasuk::with(['kondisi', 'ruang', 'barangstoks'])
                ->where('prodi_id', $idJurusan);

            if (!empty($request->start_date) && !empty($request->end_date)) {
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::parse($request->start_date)->startOfDay(),
                    \Carbon\Carbon::parse($request->end_date)->endOfDay()
                ]);
            }

            $data = $query->orderBy('created_at', 'desc')->get();

            return DataTables::of($data)
                ->addColumn('stok_masuk', function ($row) {
                    // Kalau mau ambil stok pertama
                    // return optional($row->barangstoks->first())->stok_masuk ?? 0;

                    // Kalau mau jumlah total stok_masuk
                    return $row->barangstoks->sum('stok_masuk');
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . url('barang-masuk/' . $row->id . '/edit') . '" class="me-2">
                            <i class="ti ti-edit text-warning"></i>
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete' . $row->id . '">
                            <i class="ti ti-trash text-danger"></i>
                        </a>
                    ';
                })

                ->editColumn('created_at', fn($row) => \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y'))
                ->editColumn('kondisi_id', fn($row) => $row->kondisi->nama_kondisi ?? '-')
                ->editColumn('ruang_id', fn($row) => $row->ruang->nama_ruang ?? '-')
                ->rawColumns(['action'])
                ->make(true);
        }

        $dataBarang = BarangMasuk::where('prodi_id', $idJurusan)->get();
        return view('barangMasuk.index', compact('dataBarang'));
    }

    public function laporanBarangMasuk(Request $request)
    {
        $idJurusan = Auth::user()->prodi_id;

        if ($request->ajax()) {
            $query = BarangMasuk::with(['kondisi', 'ruang', 'barangstoks'])
                ->where('prodi_id', $idJurusan);

            if (!empty($request->start_date) && !empty($request->end_date)) {
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::parse($request->start_date)->startOfDay(),
                    \Carbon\Carbon::parse($request->end_date)->endOfDay()
                ]);
            }

            $data = $query->orderBy('created_at', 'desc')->get();

            return DataTables::of($data)
                ->addColumn('stok_masuk', function ($row) {
                    // Kalau mau ambil stok pertama
                    // return optional($row->barangstoks->first())->stok_masuk ?? 0;

                    // Kalau mau jumlah total stok_masuk
                    return $row->barangstoks->sum('stok_masuk');
                })
                // ->addColumn('action', function ($row) {
                //     return '
                //         <a href="' . url('barang-masuk/' . $row->id . '/edit') . '" class="me-2">
                //             <i class="ti ti-edit text-warning"></i>
                //         </a>
                //         <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete' . $row->id . '">
                //             <i class="ti ti-trash text-danger"></i>
                //         </a>
                //     ';
                // })

                ->editColumn('created_at', fn($row) => \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y'))
                ->editColumn('kondisi_id', fn($row) => $row->kondisi->nama_kondisi ?? '-')
                ->editColumn('ruang_id', fn($row) => $row->ruang->nama_ruang ?? '-')
                // ->rawColumns(['action'])
                ->make(true);
        }

        $dataBarang = BarangMasuk::where('prodi_id', $idJurusan)->get();
        return view('barangMasuk.report', compact('dataBarang'));
    }
    public function create()
    {
        $idJurusan = Auth::user()->prodi_id;
        $kondisi = Kondisi::where('prodi_id', $idJurusan)->get();
        $kategori = Kategori::where('prodi_id', $idJurusan)->get();
        $ruang = Ruang::where('prodi_id', $idJurusan)->get();
        return view('barangMasuk.add', compact('kondisi', 'kategori', 'ruang'));
    }

    public function store(Request $request)
    {
        $idjurusan = Auth::user()->prodi_id;

        $validator = Validator::make($request->all(), [
            'namabarang' => 'required|string|max:255',
            'kodebarang' => 'nullable|string|max:255',
            'merkbarang' => 'nullable|string|max:255',
            'stokmasuk' => 'required|numeric|min:1',
            'ukuran' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'tahunbeli' => 'nullable|date',
            'spesifikasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|exists:kategori,id',
            'kondisi' => 'required|exists:kondisi,id',
            'ruang' => 'required|exists:ruang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan ke tabel barang (BarangMasuk)
        $barang = BarangMasuk::create([
            'prodi_id' => $idjurusan,
            'kategori_id' => $request->kategori,
            'kondisi_id' => $request->kondisi,
            'ruang_id' => $request->ruang,
            'nama_barang' => $request->namabarang,
            'slug' => Str::slug($request->namabarang),
            'kode_barang' => $request->kodebarang,
            'merk' => $request->merkbarang,
            'ukuran' => $request->ukuran,
            'bahan' => $request->bahan,
            'spesifikasi' => $request->spesifikasi,
            'tahun_pengadaan' => $request->tahunbeli,
            'keterangan' => $request->keterangan,
        ]);

        // Simpan riwayat stok ke tabel barang_stoks
        BarangStoks::create([
            'barang_id' => $barang->id,
            'prodi_id' => $idjurusan,
            'stok_masuk' => $request->stokmasuk,
            'total_stok' => $request->stokmasuk,
            'stok_keluar' => 0,
        ]);

        return redirect('barang-masuk/create')->with('success', 'Barang masuk berhasil disimpan.');
    }

    public function edit($id)
    {
        $idJurusan = Auth::user()->prodi_id;
        $barangMasuk = BarangMasuk::with(['kondisi', 'kategori', 'ruang'])->findOrFail($id);
        $kondisi = Kondisi::where('prodi_id', $idJurusan)->get();
        $kategori = Kategori::where('prodi_id', $idJurusan)->get();
        $ruang = Ruang::where('prodi_id', $idJurusan)->get();
        return view('barangMasuk.edit', compact('barangMasuk', 'kondisi', 'kategori', 'ruang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namabarang' => 'required',
            'kodebarang' => 'required',
            'merkbarang' => 'required',
            'stokmasuk' => 'required|numeric|min:1',
            'ukuran' => 'nullable',
            'bahan' => 'nullable',
            'tahunbeli' => 'nullable|date',
            'spesifikasi' => 'nullable',
            'keterangan' => 'nullable',
            'kategori' => 'required',
            'kondisi' => 'required',
            'ruang' => 'required',
        ]);

        $barang = BarangMasuk::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->namabarang,
            'slug' => Str::slug($request->namabarang),
            'kode_barang' => $request->kodebarang,
            'merk' => $request->merkbarang,
            'ukuran' => $request->ukuran,
            'bahan' => $request->bahan,
            'tahun_pengadaan' => $request->tahunbeli,
            'spesifikasi' => $request->spesifikasi,
            'keterangan' => $request->keterangan,
            'kategori_id' => $request->kategori,
            'kondisi_id' => $request->kondisi,
            'ruang_id' => $request->ruang,
        ]);

        // Update stok terakhir di tabel barang_stoks
        BarangStoks::where('barang_id', $id)->update([
            'stok_masuk' => $request->stokmasuk,
            'total_stok' => $request->stokmasuk, // bisa disesuaikan kalau mau + stok lama
        ]);

        return redirect('barang-masuk')->with('success', 'Data barang berhasil diupdate');
    }

    public function destroy($id)
    {
        BarangMasuk::findOrFail($id)->delete();
        BarangStoks::where('barang_id', $id)->delete();

        return redirect('barang-masuk')->with('success', 'Barang berhasil dihapus');
    }
}
