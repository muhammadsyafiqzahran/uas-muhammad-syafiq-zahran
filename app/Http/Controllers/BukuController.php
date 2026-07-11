<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $bukus = Buku::when($search, fn($q) => $q->where('judul', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%")
                        ->orWhere('kode_buku', 'like', "%$search%"))
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();

        return view('buku.index', compact('bukus', 'search'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:20|unique:bukus,kode_buku',
            'judul'     => 'required|string|max:255',
            'penulis'   => 'required|string|max:255',
            'penerbit'  => 'required|string|max:255',
            'tahun'     => 'required|integer|digits:4',
            'stok'      => 'required|integer|min:0',
            'cover'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:20|unique:bukus,kode_buku,' . $buku->id,
            'judul'     => 'required|string|max:255',
            'penulis'   => 'required|string|max:255',
            'penerbit'  => 'required|string|max:255',
            'tahun'     => 'required|integer|digits:4',
            'stok'      => 'required|integer|min:0',
            'cover'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($validated);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        // Cek apakah buku masih dipinjam
        if ($buku->peminjamans()->where('status', 'Dipinjam')->exists()) {
            return back()->with('error', 'Buku tidak dapat dihapus karena masih dipinjam!');
        }

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
}
