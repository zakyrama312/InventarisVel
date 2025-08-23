<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\BarangMasuk;
use App\Models\BarangStoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePermintaanRequest;
use Yajra\DataTables\Facades\DataTables;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $idJurusan = Auth::user()->prodi_id;
        $barang = BarangMasuk::where('prodi_id', $idJurusan)
            ->with(['ruang', 'kategori'])
            ->get();
        $permintaan = Permintaan::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
            ->where('prodi_id', $idJurusan)->get();

        if ($request->ajax()) {
            $query = Permintaan::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
                ->where('prodi_id', $idJurusan);

            // Terapkan filter tanggal
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
                $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $data = $query->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if ($row->status == 'pending') {
                        $btn = '<a href="" class="me-2" data-bs-toggle="modal" data-bs-target="#modalUpdate' . $row->id . '"><i class="ti ti-check text-warning"></i></a>';
                        // tombol reject
                        $btn .= '<a href="" class="me-2" data-bs-toggle="modal" data-bs-target="#modalReject' . $row->id . '">
                            <i class="ti ti-x text-danger"></i>
                        </a>';
                        // tombol delete
                        $btn .= '<a href="" class="" data-bs-toggle="modal" data-bs-target="#modalDelete' . $row->id . '">
                            <i class="ti ti-trash text-danger"></i>
                        </a>';
                    } elseif ($row->status == 'rejected') {
                        $btn = '<i class="ti ti-x text-danger"></i>';
                    } else {
                        $btn = '<i class="ti ti-checks text-success"></i>';
                    }
                    // $btn .= '<a href="" class="" data-bs-toggle="modal" data-bs-target="#modalDelete'. $row->id .'"><i class="ti ti-trash text-danger"></i></a>';
                    // $btn .= '<a href="" class="me-2" data-bs-toggle="modal" data-bs-target="#modalDetail' . $row->id . '">
                    //         <i class="ti ti-eye text-primary"></i>
                    //     </a>';



                    return $btn;
                })
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y');
                })
                // ->editColumn('tanggal_kembali', function ($row) {
                //     return \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d F Y');
                // })
                ->editColumn('barang_id', function ($row) {
                    $kategori = $row->barangMasuk->kategori->nama_kategori ?? '';
                    $merk = $row->barangMasuk->merk ?? '';
                    $namaRuang = $row->barangMasuk->ruang->nama_ruang ?? 'Tidak Ada Ruang';

                    return  $kategori . '  ' . $merk . ' - ' . $namaRuang;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('permintaan.index', compact('barang', 'permintaan'));
    }
    public function laporanPermintaan(Request $request)
    {
        $idJurusan = Auth::user()->prodi_id;
        $barang = BarangMasuk::where('prodi_id', $idJurusan)
            ->with(['ruang', 'kategori'])
            ->get();
        $permintaan = Permintaan::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
            ->where('prodi_id', $idJurusan)->get();

        if ($request->ajax()) {
            $query = Permintaan::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
                ->where('prodi_id', $idJurusan);

            // Terapkan filter tanggal
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
                $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $data = $query->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)

                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y');
                })
                // ->editColumn('tanggal_kembali', function ($row) {
                //     return \Carbon\Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d F Y');
                // })
                ->editColumn('barang_id', function ($row) {
                    $kategori = $row->barangMasuk->kategori->nama_kategori ?? '';
                    $merk = $row->barangMasuk->merk ?? '';
                    $namaRuang = $row->barangMasuk->ruang->nama_ruang ?? 'Tidak Ada Ruang';

                    return  $kategori . '  ' . $merk . ' - ' . $namaRuang;
                })
                ->make(true);
        }

        return view('permintaan.report', compact('barang', 'permintaan'));
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan_reject' => 'required|string|max:255',
        ]);

        $permintaan = Permintaan::findOrFail($id);

        $permintaan->status = 'ditolak'; // pastikan di tabel ada kolom 'status'
        $permintaan->keterangan = $request->keterangan_reject;
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan berhasil di-reject.');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermintaanRequest $request)
    {
        $idjurusan = Auth::user()->prodi_id;
        $idbarang = $request->namabarang;
        $request->validated();

        // Ambil stok terakhir dari tabel barang_stoks
        $barangStok = BarangStoks::where('barang_id', $idbarang)->latest()->first();

        if (!$barangStok) {
            return redirect('permintaan')->with('pesan', 'Barang belum memiliki stok');
        }

        $stok = $barangStok->stok_masuk; // atau stok_akhir kalau kamu pakai field ini
        $jumlah = $request->jumlah;

        if ($jumlah > $stok) {
            return redirect('permintaan')->with('pesan', 'Stok Tidak Cukup / Sedang Dipinjam');
        } elseif ($stok == 0) {
            return redirect('permintaan')->with('pesan', 'Stok Habis / Masih Dipinjam');
        }

        $tanggalPinjam = now()->locale('id')->translatedFormat('d F Y');
        // Simpan data permintaan
        Permintaan::create([
            'barang_id'      => $request->namabarang,
            'nama_permintaan'  => $request->namapeminjam,
            'kelas'          => $request->kelas,
            'jumlah'         => $jumlah,
            'keterangan'     => $request->keperluan,
            'status'         => "pending",
            'tanggal_permintaan' => $tanggalPinjam,
            'prodi_id'       => $idjurusan
        ]);

        // Kurangi stok barang
        // $barangStok->update([
        //     'stok_masuk' => $stok - $jumlah
        // ]);

        return redirect('permintaan');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $idbarang = $permintaan->barang_id;

        // ambil stok terakhir dari tabel barang_stoks
        $barangStok = BarangStoks::where('barang_id', $idbarang)->first();
        $stok = $barangStok->stok_masuk;

        $jumlah = $permintaan->jumlah;
        $hasil = $stok - $jumlah;

        // update stok di tabel barang_stoks
        $barangStok->update([
            'stok_masuk' => $hasil
        ]);

        // update status permintaan
        $permintaan->status = "disetujui";
        $permintaan->save();

        return redirect('permintaan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // cari data permintaan
        $permintaan = Permintaan::findOrFail($id);

        // hapus data
        $permintaan->delete();

        // redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data permintaan berhasil dihapus');
    }
}
