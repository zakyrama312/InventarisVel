<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\BarangMasuk;
use App\Models\BarangStoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;

class PeminjamanController extends Controller
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
        $peminjaman = Peminjaman::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
            ->where('prodi_id', $idJurusan)->get();

        if ($request->ajax()) {
            $query = Peminjaman::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
                ->where('prodi_id', $idJurusan);

            // Terapkan filter tanggal
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
                $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $data = $query->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)

                ->addColumn(
                    'action',
                    function ($row) {
                        $btn = '';

                        // tombol disetujui (hanya muncul kalau status pending)
                        if ($row->status == 'pending') {
                            $btn .= '<a href="" class="me-2" data-bs-toggle="modal" title="disetujui" data-bs-target="#modalApprove'  . $row->id . '">
                                        <i class="ti ti-check text-warning"></i>
                                    </a>';
                            $btn .= '<a href="" class="me-2" data-bs-toggle="modal" title="ditolak" data-bs-target="#modalReject' . $row->id . '">
                                        <i class="ti ti-x text-danger"></i>
                                    </a>';
                        }

                        // tombol dikembalikan (hanya muncul kalau status dipinjam)
                        if ($row->status == 'dipinjam') {
                            $btn .= '<a href="" class="me-2" data-bs-toggle="modal" title="dikembalikan" data-bs-target="#modalUpdate' . $row->id . '">
                                <i class="ti ti-rotate-dot text-primary"></i>
                            </a>';
                        }

                        // tombol reject (muncul kalau status pending atau disetujui)
                        if ($row->status == 'ditolak') {
                            $btn .= '<i class="ti ti-x text-danger"></i>';
                        }

                        // tombol dikembalikan
                        if ($row->status == 'dikembalikan') {
                            $btn .= '<i class="ti ti-checks text-success"></i>';
                        }

                        return $btn;
                    }
                )
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

        return view('peminjaman.index', compact('barang', 'peminjaman'));
    }
    public function laporanPeminjaman(Request $request)
    {
        $idJurusan = Auth::user()->prodi_id;
        $barang = BarangMasuk::where('prodi_id', $idJurusan)
            ->with(['ruang', 'kategori'])
            ->get();
        $peminjaman = Peminjaman::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
            ->where('prodi_id', $idJurusan)->get();

        if ($request->ajax()) {
            $query = Peminjaman::with(['barangMasuk.ruang', 'barangMasuk.kategori'])
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

        return view('peminjaman.report', compact('barang', 'peminjaman'));
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan_reject' => 'required|string|max:255',
        ]);

        $permintaan = Peminjaman::findOrFail($id);

        $permintaan->status = 'ditolak'; // pastikan di tabel ada kolom 'status'
        $permintaan->keterangan = $permintaan->keterangan . ' (Ditolak : ' . $request->keterangan_reject . ')'; // tambahkan keterangan penolakan
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan berhasil di-reject.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeminjamanRequest $request)
    {
        $idjurusan = Auth::user()->prodi_id;
        $idbarang = $request->namabarang;
        $request->validated();

        // Ambil stok terakhir dari tabel barang_stoks
        $barangStok = BarangStoks::where('barang_id', $idbarang)->latest()->first();

        if (!$barangStok) {
            return redirect('peminjaman')->with('pesan', 'Barang belum memiliki stok');
        }

        $stok = $barangStok->stok_masuk; // atau stok_akhir kalau kamu pakai field ini
        $jumlah = $request->jumlah;

        if ($jumlah > $stok) {
            return redirect('peminjaman')->with('pesan', 'Stok Tidak Cukup / Sedang Dipinjam');
        } elseif ($stok == 0) {
            return redirect('peminjaman')->with('pesan', 'Stok Habis / Masih Dipinjam');
        }

        $tanggalPinjam = now()->locale('id')->translatedFormat('d F Y');
        // Simpan data peminjaman
        Peminjaman::create([
            'barang_id'      => $request->namabarang,
            'nama_peminjam'  => $request->namapeminjam,
            'kelas'          => $request->kelas,
            'jumlah'         => $jumlah,
            'keterangan'     => $request->keperluan,
            'status'         => "pending",
            'tanggal_peminjaman' => $tanggalPinjam,
            'prodi_id'       => $idjurusan
        ]);

        // Kurangi stok barang
        // $barangStok->update([
        //     'stok_masuk' => $stok - $jumlah
        // ]);

        return redirect('peminjaman');
    }


    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $idbarang = $peminjaman->barang_id;

        // ambil stok terakhir
        $barangStok = BarangStoks::where('barang_id', $idbarang)->first();
        $stok = $barangStok->stok_masuk;

        $jumlah = $peminjaman->jumlah;

        // cek stok cukup atau tidak
        if ($stok < $jumlah) {
            return redirect()->back()->with('pesan', 'Stok barang tidak cukup / sedang ada yang dipinjam');
        }

        // kurangi stok
        $barangStok->update([
            'stok_masuk' => $stok - $jumlah
        ]);

        // update status peminjaman
        $peminjaman->status = "dipinjam";
        $peminjaman->tanggal_peminjaman = now()->locale('id')->translatedFormat('d F Y');
        $peminjaman->save();

        return redirect('peminjaman')->with('success', 'Peminjaman disetujui');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $idbarang = $peminjaman->barang_id;

        // ambil stok terakhir dari tabel barang_stoks
        $barangStok = BarangStoks::where('barang_id', $idbarang)->first();
        $stok = $barangStok->stok_masuk;

        $jumlah = $peminjaman->jumlah;
        $hasil = $stok + $jumlah;

        // update stok di tabel barang_stoks
        $barangStok->update([
            'stok_masuk' => $hasil
        ]);

        // update status peminjaman
        $peminjaman->status = "dikembalikan";
        $peminjaman->tanggal_pengembalian = now()->locale('id')->translatedFormat('d F Y');
        $peminjaman->save();

        return redirect('peminjaman');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
