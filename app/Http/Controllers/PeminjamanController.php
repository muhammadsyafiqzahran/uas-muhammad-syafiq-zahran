<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->when($search, fn($q) => $q->whereHas('anggota', fn($a) => $a->where('nama', 'like', "%$search%"))
                            ->orWhereHas('buku', fn($b) => $b->where('judul', 'like', "%$search%")))
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjamans', 'search', 'status'));
    }

    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        $bukus    = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'  => 'required|exists:anggotas,id',
            'buku_id'     => 'required|exists:bukus,id',
            'tgl_pinjam'  => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        // Kurangi stok buku
        $buku = Buku::findOrFail($validated['buku_id']);
        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku sudah habis!')->withInput();
        }
        $buku->decrement('stok');

        $validated['status'] = Peminjaman::STATUS_DIPINJAM;
        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $anggotas = Anggota::orderBy('nama')->get();
        $bukus    = Buku::orderBy('judul')->get();

        return view('peminjaman.edit', compact('peminjaman', 'anggotas', 'bukus'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data peminjaman diperbarui!');
    }

    /**
     * Proses pengembalian buku.
     */
    public function kembali(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === Peminjaman::STATUS_DIKEMBALIKAN) {
            return back()->with('warning', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        // Tambah stok buku kembali
        $peminjaman->buku->increment('stok');

        $peminjaman->update(['status' => Peminjaman::STATUS_DIKEMBALIKAN]);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Buku berhasil dikembalikan! Stok buku bertambah.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Jika masih dipinjam, kembalikan stok
        if ($peminjaman->status === Peminjaman::STATUS_DIPINJAM) {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data peminjaman berhasil dihapus!');
    }

    /**
     * Export laporan peminjaman ke PDF
     */
    public function exportPdf()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('peminjaman.pdf', compact('peminjamans'));
        return $pdf->download('laporan-peminjaman-'.date('Ymd').'.pdf');
    }

    /**
     * Export laporan peminjaman ke Excel
     */
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PeminjamanExport, 'laporan-peminjaman-'.date('Ymd').'.xlsx');
    }
}
