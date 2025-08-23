@extends('layouts.main')
@section('dashboard')
<div class="container-fluid" style="margin-top: -70px;">
    <!-- Stats Cards Section -->
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kaprodi')
    <div class="row g-3 mb-4 mt-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-horizontal bg-primary-light">
                <div class="stat-icon-horizontal">🏢</div>
                <div class="stat-content-horizontal">
                    <h3>{{ $stats['total_ruangan'] }}</h3>
                    <p>Total Ruangan</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-horizontal bg-success-light">
                <div class="stat-icon-horizontal">📦</div>
                <div class="stat-content-horizontal">
                    <h3>{{ $stats['total_barang'] }}</h3>
                    <p>Total Barang</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-horizontal bg-warning-light">
                <div class="stat-icon-horizontal">🔔</div>
                <div class="stat-content-horizontal">
                    <h3>{{ $stats['permintaan_menunggu'] }}</h3>
                    <p>Permintaan Menunggu</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card-horizontal bg-info-light">
                <div class="stat-icon-horizontal">📚</div>
                <div class="stat-content-horizontal">
                    <h3>{{ $stats['sedang_dipinjam'] }}</h3>
                    <p>Sedang Dipinjam</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->


    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="card-title fw-bold mb-1 text-dark">
                        {{ $jurusan->nama_prodi }}
                    </h4>
                    <p class="text-muted mb-0">Daftar Ruangan dan Inventaris</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Total Ruangan: {{ count($ruangs) }}</small>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="row g-4">
                @forelse($ruangs as $ruang)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <a href="{{ route('ruang.show', $ruang->slug) }}" class="text-decoration-none">
                        <div class="card room-card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <!-- Room Icon -->
                                <div class="room-icon mb-3">
                                    <i class="fas fa-door-open fa-2x text-primary"></i>
                                </div>

                                <!-- Room Name -->
                                <h5 class="card-title text-dark fw-bold mb-3">
                                    {{ $ruang->nama_ruang }}
                                </h5>

                                <!-- Stats Section - Enhanced -->
                                <div class="stats-section">
                                    <div class="stat-item mb-2">
                                        <small class="text-muted d-block mb-1">Jumlah Barang</small>
                                        <span class="stat-number">{{ $ruang->total_stok_masuk ?? '0' }}</span>
                                    </div>
                                    @if(isset($ruang->sedang_dipinjam) && $ruang->sedang_dipinjam > 0)
                                    <div class="stat-item-small">
                                        <small class="text-muted d-block mb-1">Sedang Dipinjam</small>
                                        <span
                                            class="stat-number-small text-warning">{{ $ruang->sedang_dipinjam }}</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Status Indicator -->
                                <div class="mt-3">
                                    @if(($ruang->total_stok_masuk ?? 0) > 0)
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-secondary">Kosong</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada ruangan tersedia</h5>
                        <p class="text-muted">Silakan tambahkan ruangan baru untuk memulai.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="card-title fw-bold mb-1 text-dark">Trend Peminjaman & Permintaan</h5>
                    <p class="text-muted mb-0">Statistik 6 Bulan Terakhir</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="trendChart" width="400" height="120"></canvas>
            </div>
        </div>
    </div>

    @endif
    <!-- Recent Activity Section -->
    <div class="row g-4 mt-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="card-title fw-bold mb-0 text-dark">📋 Permintaan Terbaru</h5>
                    </div>
                    <div class="activity-list">
                        @forelse($recentActivities['permintaan_terbaru'] as $permintaan)
                        <div class="activity-item d-flex justify-content-between align-items-center py-2">
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">{{ $permintaan->nama_barang }} : {{ $permintaan->jumlah }}</h6>
                                <p class="mb-1 text-muted small">{{ $permintaan->user_name }} {{ $permintaan->kelas }}</p>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($permintaan->created_at)->locale('id')->diffForHumans() }}</small>
                            </div>
                            <div class="activity-status">
                                <span class="badge
                                    @if($permintaan->status == 'pending')
                                     bg-warning text-white
                                    @elseif($permintaan->status == 'disetujui') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($permintaan->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted text-center py-3">Belum ada permintaan</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="card-title fw-bold mb-0 text-dark">📚 Peminjaman Aktif</h5>
                    </div>
                    <div class="activity-list">
                        @forelse($recentActivities['peminjaman_aktif'] as $peminjaman)
                        <div class="activity-item d-flex justify-content-between align-items-center py-2">
                            <div class="activity-content">
                                <h6 class="mb-1 fw-semibold">{{ $peminjaman->nama_barang }} : {{ $peminjaman->jumlah }}</h6>
                                <p class="mb-1 text-muted small">{{ $peminjaman->user_name }} {{ $peminjaman->kelas }}</p>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($peminjaman->created_at)->locale('id')->diffForHumans() }}</small>
                            </div>
                            <div class="activity-status">
                                @if($peminjaman->status == 'dipinjam')
                                <span class="badge bg-info">Dipinjam</span>
                                @elseif($peminjaman->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @else
                                <span class="badge bg-warning text-white">Pending</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-muted text-center py-3">Tidak ada peminjaman aktif</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Chart Configuration
    @if(isset($chartData))
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan element canvas ada
        const canvas = document.getElementById('trendChart');
        if (!canvas) {
            console.error('Element dengan ID "trendChart" tidak ditemukan');
            return;
        }

        // Ambil data dari backend
        const chartData = @json($chartData);

        // Validasi data sebelum membuat chart
        if (!chartData || !chartData.months || !chartData.permintaan || !chartData.peminjaman) {
            console.error('Data chart tidak valid atau tidak lengkap:', chartData);
            return;
        }

        const ctx = canvas.getContext('2d');
        const trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.months,
                datasets: [{
                    label: 'Permintaan',
                    data: chartData.permintaan,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#007bff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }, {
                    label: 'Peminjaman',
                    data: chartData.peminjaman,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#28a745',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
    @endif
</script>
@endpush
@endsection