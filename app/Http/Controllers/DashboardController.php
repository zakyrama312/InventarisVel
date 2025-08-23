<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ruang;
use App\Models\Jurusan;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $prodi_id = Auth::user()->prodi_id;

        // Data Ruangan (existing)
        $ruangs = Ruang::select('ruang.*')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('barang_stoks', 'barang.id', '=', 'barang_stoks.barang_id')
                    ->select(DB::raw('SUM(barang_stoks.stok_masuk)'))
                    ->whereColumn('barang.ruang_id', 'ruang.id');
            }, 'total_stok_masuk')
            ->selectSub(function ($query) {
                $query->from('barang')
                    ->join('peminjaman', 'barang.id', '=', 'peminjaman.barang_id')
                    ->select(DB::raw('COUNT(*)'))
                    ->where('peminjaman.status', 'dipinjam')
                    ->whereColumn('barang.ruang_id', 'ruang.id');
            }, 'sedang_dipinjam')
            ->get();

        $jurusan = Jurusan::find($prodi_id);

        // Stats Cards Data
        $stats = [
            'total_ruangan' => $ruangs->count(),
            'total_barang' => DB::table('barang')->count(),
            'permintaan_menunggu' =>
            DB::table('permintaan')->where('status', 'pending')->count() +
                DB::table('peminjaman')->where('status', 'pending')->count(),
            'sedang_dipinjam' => DB::table('peminjaman')->where('status', 'dipinjam')->count()
        ];

        // Chart Data - 6 bulan terakhir
        $chartData = [];
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            // Data Permintaan per bulan
            $permintaanCount = DB::table('permintaan')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereNot('status', 'ditolak')
                ->count();

            // Data Peminjaman per bulan
            $peminjamanCount = DB::table('peminjaman')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereNot('status', 'ditolak')
                ->count();

            $chartData['permintaan'][] = $permintaanCount;
            $chartData['peminjaman'][] = $peminjamanCount;
        }

        $chartData['months'] = $months;

        // Recent Activity Data
        $recentActivities = [
            'permintaan_terbaru' => DB::table('permintaan')
                ->join('barang', 'permintaan.barang_id', '=', 'barang.id')
                ->select('permintaan.*', 'permintaan.nama_permintaan as user_name', 'barang.nama_barang')
                ->orderBy('permintaan.created_at', 'desc')
                ->limit(5)
                ->get(),

            'peminjaman_aktif' => DB::table('peminjaman')
                ->join('barang', 'peminjaman.barang_id', '=', 'barang.id')
                ->select('peminjaman.*', 'peminjaman.nama_peminjam as user_name', 'barang.nama_barang')
                ->whereIn('peminjaman.status', ['pending', 'dipinjam', 'ditolak'])
                ->orderBy('peminjaman.created_at', 'desc')
                ->limit(5)
                ->get()
        ];

        return view('dashboard.index', compact(
            'ruangs',
            'jurusan',
            'stats',
            'chartData',
            'recentActivities'
        ));
    }
}
