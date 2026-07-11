@extends('layouts.app')
@section('title','Peminjaman')
@section('page-title','Data Peminjaman')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left">
        <h1 class="page-title">Data Peminjaman</h1>
        <p class="page-subtitle">Kelola transaksi peminjaman dan pengembalian buku</p>
    </div>
    <div class="page-header-actions d-flex gap-2">
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-download"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('peminjaman.export.pdf') }}" target="_blank"><i class="bi bi-file-earmark-pdf text-danger"></i> Export PDF</a></li>
                <li><a class="dropdown-item" href="{{ route('peminjaman.export.excel') }}"><i class="bi bi-file-earmark-excel text-success"></i> Export Excel</a></li>
            </ul>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Peminjaman</a>
    </div>
</div>

<div class="content-card animate-fade-up">
    <div class="content-card-header">
        <h6 class="content-card-title"><i class="bi bi-arrow-left-right"></i> Daftar Peminjaman</h6>
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <div class="search-bar">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari anggota/buku..." value="{{ $search }}" style="width:200px;">
            </div>
            <select name="status" class="form-select form-select-sm" style="width:140px;">
                <option value="">Semua Status</option>
                <option value="Dipinjam" {{ $status=='Dipinjam'?'selected':'' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ $status=='Dikembalikan'?'selected':'' }}>Dikembalikan</option>
            </select>
            <button class="btn btn-sm btn-primary" type="submit"><i class="bi bi-search"></i></button>
            @if($search || $status)<a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="content-card-body p-0">
        @if($peminjamans->count())
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr><th>#</th><th>Anggota</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $i => $p)
                    <tr>
                        <td><span class="row-number">{{ $peminjamans->firstItem() + $i }}</span></td>
                        <td>
                            <div style="font-weight:600;">{{ $p->anggota->nama }}</div>
                            <div style="font-size:12px;color:var(--text-muted);">{{ $p->anggota->no_hp }}</div>
                        </td>
                        <td>
                            <div style="font-weight:600;">{{ Str::limit($p->buku->judul, 40) }}</div>
                            <div style="font-size:12px;color:var(--text-muted);">{{ $p->buku->kode_buku }}</div>
                        </td>
                        <td>{{ $p->tgl_pinjam->format('d M Y') }}</td>
                        <td>
                            {{ $p->tgl_kembali->format('d M Y') }}
                            @if($p->terlambat)<span class="badge bg-danger ms-1" style="font-size:10px;">Terlambat</span>@endif
                        </td>
                        <td>
                            @if($p->status==='Dipinjam')
                                <span class="badge-status badge-dipinjam">Dipinjam</span>
                            @else
                                <span class="badge-status badge-kembali">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                @if($p->status==='Dipinjam')
                                <form method="POST" action="{{ route('peminjaman.kembali', $p) }}" onsubmit="return confirm('Konfirmasi pengembalian buku?')">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-icon btn-icon-view" title="Kembalikan"><i class="bi bi-arrow-return-left"></i></button>
                                </form>
                                @endif
                                <a href="{{ route('peminjaman.edit', $p) }}" class="btn btn-icon btn-icon-edit" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('peminjaman.destroy', $p) }}" onsubmit="return confirm('Hapus data peminjaman ini?')">
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
            <span style="font-size:13px;color:var(--text-muted);">Total: {{ $peminjamans->total() }} transaksi</span>
            {{ $peminjamans->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-arrow-left-right"></i></div>
            <div class="empty-state-title">Belum ada transaksi peminjaman</div>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm mt-2"><i class="bi bi-plus-lg"></i> Tambah Peminjaman</a>
        </div>
        @endif
    </div>
</div>
@endsection
