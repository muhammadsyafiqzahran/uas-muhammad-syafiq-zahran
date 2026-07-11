@extends('layouts.app')
@section('title','Data Anggota')
@section('page-title','Data Anggota')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left">
        <h1 class="page-title">Data Anggota</h1>
        <p class="page-subtitle">Kelola data anggota perpustakaan</p>
    </div>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Anggota</a>
</div>
<div class="content-card animate-fade-up">
    <div class="content-card-header">
        <h6 class="content-card-title"><i class="bi bi-people-fill"></i> Daftar Anggota</h6>
        <form method="GET" class="d-flex gap-2">
            <div class="search-bar">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email..." value="{{ $search }}" style="width:220px;">
            </div>
            <button class="btn btn-sm btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if($search)<a href="{{ route('anggota.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="content-card-body p-0">
        @if($anggotas->count())
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr><th>#</th><th>Nama</th><th>Email</th><th>No HP</th><th>Alamat</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($anggotas as $i => $anggota)
                    <tr>
                        <td><span class="row-number">{{ $anggotas->firstItem() + $i }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;flex-shrink:0;">
                                    {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                                </div>
                                <span style="font-weight:600;">{{ $anggota->nama }}</span>
                            </div>
                        </td>
                        <td><a href="mailto:{{ $anggota->email }}" style="color:var(--primary-600);">{{ $anggota->email }}</a></td>
                        <td>{{ $anggota->no_hp }}</td>
                        <td style="max-width:200px;"><span style="font-size:12px;color:var(--text-muted);">{{ Str::limit($anggota->alamat, 50) }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('anggota.edit', $anggota) }}" class="btn btn-icon btn-icon-edit" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('anggota.destroy', $anggota) }}" onsubmit="return confirm('Hapus anggota ini?')">
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
            <span style="font-size:13px;color:var(--text-muted);">Menampilkan {{ $anggotas->firstItem() }}–{{ $anggotas->lastItem() }} dari {{ $anggotas->total() }} anggota</span>
            {{ $anggotas->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-people"></i></div>
            <div class="empty-state-title">Belum ada data anggota</div>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm mt-2"><i class="bi bi-plus-lg"></i> Tambah Anggota</a>
        </div>
        @endif
    </div>
</div>
@endsection
