<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $anggotas = Anggota::when($search, fn($q) => $q->where('nama', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%"))
                        ->latest()
                        ->paginate(10)
                        ->withQueryString();

        return view('anggota.index', compact('anggotas', 'search'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'required|email|unique:anggotas,email',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'required|email|unique:anggotas,email,' . $anggota->id,
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->hasPinjamanAktif()) {
            return back()->with('error', 'Anggota tidak dapat dihapus karena masih memiliki pinjaman aktif!');
        }

        $anggota->delete();

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil dihapus!');
    }
}
