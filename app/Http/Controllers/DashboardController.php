<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan statistik.
     */
    public function index()
    {
        // ── Statistik utama (sesuai soal UAS) ──────────────────────────
        $totalBuku     = Buku::count();
        $totalAnggota  = Anggota::count();
        $totalDipinjam = Peminjaman::where('status', Peminjaman::STATUS_DIPINJAM)->count();
        $totalTersedia = Buku::sum('stok');

        // ── Level 3: Buku stok habis ────────────────────────────────────
        $stokHabis = Buku::where('stok', 0)->count();

        // ── Level 2: Data grafik peminjaman per bulan (tahun ini) ───────
        $chartData = array_fill(0, 12, 0); // default 0 semua bulan

        $peminjamanPerBulan = Peminjaman::selectRaw('MONTH(tgl_pinjam) as bulan, COUNT(*) as total')
            ->whereYear('tgl_pinjam', now()->year)
            ->groupBy('bulan')
            ->get();

        foreach ($peminjamanPerBulan as $item) {
            $chartData[$item->bulan - 1] = $item->total;
        }

        // ── 5 Peminjaman terbaru ────────────────────────────────────────
        $recentPeminjaman = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'totalDipinjam',
            'totalTersedia',
            'stokHabis',
            'chartData',
            'recentPeminjaman'
        ));
    }
}
