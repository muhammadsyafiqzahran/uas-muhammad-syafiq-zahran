@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('styles')
<style>
    .chart-wrapper { position: relative; height: 260px; }
</style>
@endsection

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fade-up">
    <div class="page-header-left">
        <h1 class="page-title">Selamat Datang, Admin! 👋</h1>
        <p class="page-subtitle">Berikut ringkasan data perpustakaan hari ini, {{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
</div>

{{-- ========================
     STAT CARDS
======================== --}}
<div class="row g-4 mb-4">

    {{-- Total Buku --}}
    <div class="col-12 col-sm-6 col-xl-3 animate-fade-up delay-1">
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-icon-bg:#eff6ff;">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Buku</span>
                <div class="stat-card-icon"><i class="bi bi-book-fill"></i></div>
            </div>
            <div class="stat-card-value">{{ $totalBuku ?? 0 }}</div>
            <div class="stat-card-meta">
                <i class="bi bi-database"></i>
                Judul buku terdaftar
            </div>
        </div>
    </div>

    {{-- Total Anggota --}}
    <div class="col-12 col-sm-6 col-xl-3 animate-fade-up delay-2">
        <div class="stat-card" style="--stat-color:#8b5cf6;--stat-icon-bg:#f5f3ff;">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Anggota</span>
                <div class="stat-card-icon"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="stat-card-value">{{ $totalAnggota ?? 0 }}</div>
            <div class="stat-card-meta">
                <i class="bi bi-person-check"></i>
                Anggota aktif terdaftar
            </div>
        </div>
    </div>

    {{-- Buku Dipinjam --}}
    <div class="col-12 col-sm-6 col-xl-3 animate-fade-up delay-3">
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-icon-bg:#fffbeb;">
            <div class="stat-card-header">
                <span class="stat-card-label">Dipinjam</span>
                <div class="stat-card-icon"><i class="bi bi-arrow-up-right-square-fill"></i></div>
            </div>
            <div class="stat-card-value">{{ $totalDipinjam ?? 0 }}</div>
            <div class="stat-card-meta">
                <i class="bi bi-clock"></i>
                Buku sedang dipinjam
            </div>
        </div>
    </div>

    {{-- Buku Tersedia --}}
    <div class="col-12 col-sm-6 col-xl-3 animate-fade-up delay-4">
        <div class="stat-card" style="--stat-color:#10b981;--stat-icon-bg:#f0fdf4;">
            <div class="stat-card-header">
                <span class="stat-card-label">Tersedia</span>
                <div class="stat-card-icon"><i class="bi bi-check-circle-fill"></i></div>
            </div>
            <div class="stat-card-value">{{ $totalTersedia ?? 0 }}</div>
            <div class="stat-card-meta">
                <i class="bi bi-box-seam"></i>
                Total stok tersedia
            </div>
        </div>
    </div>

</div>

{{-- ========================
     CHARTS ROW
======================== --}}
<div class="row g-4 mb-4">

    {{-- Peminjaman per Bulan --}}
    <div class="col-12 col-lg-8 animate-fade-up">
        <div class="content-card h-100">
            <div class="content-card-header">
                <h6 class="content-card-title">
                    <i class="bi bi-bar-chart-fill"></i>
                    Grafik Peminjaman Bulanan
                </h6>
                <span style="font-size:12px;color:var(--text-muted);">{{ now()->format('Y') }}</span>
            </div>
            <div class="content-card-body">
                <div class="chart-wrapper">
                    <canvas id="chartPeminjaman"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Buku Pie --}}
    <div class="col-12 col-lg-4 animate-fade-up">
        <div class="content-card h-100">
            <div class="content-card-header">
                <h6 class="content-card-title">
                    <i class="bi bi-pie-chart-fill"></i>
                    Status Buku
                </h6>
            </div>
            <div class="content-card-body">
                <div class="chart-wrapper" style="height:200px;">
                    <canvas id="chartStatus"></canvas>
                </div>
                <div class="mt-3 d-flex flex-column gap-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:10px;height:10px;background:#3b82f6;border-radius:50%;display:inline-block;"></span>
                            <span style="font-size:13px;color:var(--text-secondary);">Tersedia</span>
                        </div>
                        <span style="font-size:13px;font-weight:600;">{{ $totalTersedia ?? 0 }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:10px;height:10px;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
                            <span style="font-size:13px;color:var(--text-secondary);">Dipinjam</span>
                        </div>
                        <span style="font-size:13px;font-weight:600;">{{ $totalDipinjam ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ========================
     RECENT TRANSACTIONS
======================== --}}
<div class="row g-4">
    <div class="col-12 animate-fade-up">
        <div class="content-card">
            <div class="content-card-header">
                <h6 class="content-card-title">
                    <i class="bi bi-clock-history"></i>
                    Peminjaman Terbaru
                </h6>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-arrow-right"></i> Lihat Semua
                </a>
            </div>
            <div class="content-card-body p-0">
                @if(isset($recentPeminjaman) && $recentPeminjaman->count() > 0)
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPeminjaman as $i => $p)
                            <tr>
                                <td><span class="row-number">{{ $i+1 }}</span></td>
                                <td>
                                    <div style="font-weight:600;">{{ $p->anggota->nama }}</div>
                                    <div style="font-size:12px;color:var(--text-muted);">{{ $p->anggota->no_hp }}</div>
                                </td>
                                <td>
                                    <div style="font-weight:600;">{{ Str::limit($p->buku->judul, 35) }}</div>
                                    <div style="font-size:12px;color:var(--text-muted);">{{ $p->buku->kode_buku }}</div>
                                </td>
                                <td>{{ $p->tgl_pinjam->format('d M Y') }}</td>
                                <td>
                                    {{ $p->tgl_kembali->format('d M Y') }}
                                    @if($p->terlambat)
                                        <span class="badge bg-danger ms-1" style="font-size:10px;">Terlambat</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status === 'Dipinjam')
                                        <span class="badge-status badge-dipinjam">Dipinjam</span>
                                    @else
                                        <span class="badge-status badge-kembali">Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                    <div class="empty-state-title">Belum ada transaksi</div>
                    <div class="empty-state-text">Belum ada data peminjaman buku. Mulai tambah transaksi peminjaman.</div>
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Peminjaman
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // ========== CHART PEMINJAMAN BULANAN ==========
    const monthLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const peminjamanData = @json($chartData ?? array_fill(0, 12, 0));

    const ctx1 = document.getElementById('chartPeminjaman').getContext('2d');
    const gradientBar = ctx1.createLinearGradient(0, 0, 0, 260);
    gradientBar.addColorStop(0,   'rgba(59,130,246,0.85)');
    gradientBar.addColorStop(1,   'rgba(59,130,246,0.1)');

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: peminjamanData,
                backgroundColor: gradientBar,
                borderRadius: 8,
                borderSkipped: false,
                borderColor: '#3b82f6',
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#e2e8f0',
                    bodyColor: '#94a3b8',
                    cornerRadius: 8,
                    padding: 10,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 }, color: '#94a3b8' }
                },
                y: {
                    grid: { color: '#f1f5f9', lineWidth: 1 },
                    ticks: { font: { size: 12 }, color: '#94a3b8', stepSize: 1 },
                    beginAtZero: true
                }
            }
        }
    });

    // ========== CHART STATUS PIE ==========
    const ctx2 = document.getElementById('chartStatus').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Dipinjam'],
            datasets: [{
                data: [{{ $totalTersedia ?? 0 }}, {{ $totalDipinjam ?? 0 }}],
                backgroundColor: ['#3b82f6', '#f59e0b'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#e2e8f0',
                    bodyColor: '#94a3b8',
                    cornerRadius: 8,
                    padding: 10,
                }
            }
        }
    });
</script>
@endsection
