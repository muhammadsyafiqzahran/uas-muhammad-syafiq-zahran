@extends('layouts.app')
@section('title','Data Buku')
@section('page-title','Data Buku')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left">
        <h1 class="page-title">Data Buku</h1>
        <p class="page-subtitle">Kelola koleksi buku perpustakaan</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Buku
        </a>
    </div>
</div>

<div class="content-card animate-fade-up">
    <div class="content-card-header">
        <h6 class="content-card-title"><i class="bi bi-book-fill"></i> Daftar Buku</h6>
        <form method="GET" class="d-flex gap-2">
            <div class="search-bar">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis..." value="{{ $search }}" style="width:220px;">
            </div>
            <button class="btn btn-sm btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if($search)<a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="content-card-body p-0">
        @if($bukus->count())
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cover</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bukus as $i => $buku)
                    <tr>
                        <td><span class="row-number">{{ $bukus->firstItem() + $i }}</span></td>
                        <td>
                            @if($buku->cover)
                                <img src="{{ Storage::url($buku->cover) }}" class="book-cover" alt="Cover">
                            @else
                                <div class="book-cover-placeholder"><i class="bi bi-book"></i></div>
                            @endif
                        </td>
                        <td><code style="font-size:12px;background:#f1f5f9;padding:3px 7px;border-radius:5px;">{{ $buku->kode_buku }}</code></td>
                        <td style="font-weight:600;max-width:200px;">{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun }}</td>
                        <td>
                            @if($buku->stok > 0)
                                <span class="badge-status badge-stok-ok">{{ $buku->stok }} tersedia</span>
                            @else
                                <span class="badge-status badge-stok-habis">Habis</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('buku.edit', $buku) }}" class="btn btn-icon btn-icon-edit" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('buku.destroy', $buku) }}" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-icon-delete" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 d-flex justify-content-between align-items-center" style="border-top:1px solid var(--card-border);">
            <span style="font-size:13px;color:var(--text-muted);">Menampilkan {{ $bukus->firstItem() }}–{{ $bukus->lastItem() }} dari {{ $bukus->total() }} buku</span>
            {{ $bukus->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-book"></i></div>
            <div class="empty-state-title">Belum ada data buku</div>
            <div class="empty-state-text">Mulai tambahkan koleksi buku perpustakaan Anda.</div>
            <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Buku</a>
        </div>
        @endif
    </div>
</div>
@endsection
