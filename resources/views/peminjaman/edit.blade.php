@extends('layouts.app')
@section('title','Edit Peminjaman')
@section('page-title','Edit Peminjaman')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left"><h1 class="page-title">Edit Peminjaman</h1></div>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="content-card animate-fade-up">
            <div class="content-card-header"><h6 class="content-card-title"><i class="bi bi-pencil-fill"></i> Edit Peminjaman</h6></div>
            <div class="content-card-body">
                <div class="alert alert-info mb-3">
                    <i class="bi bi-info-circle-fill"></i>
                    <strong>{{ $peminjaman->anggota->nama }}</strong> meminjam <strong>{{ $peminjaman->buku->judul }}</strong>
                </div>
                <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" class="form-control" value="{{ $peminjaman->tgl_pinjam->format('Y-m-d') }}" readonly disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kembali" class="form-control @error('tgl_kembali') is-invalid @enderror"
                                   value="{{ old('tgl_kembali', $peminjaman->tgl_kembali->format('Y-m-d')) }}" required>
                            @error('tgl_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Perbarui</button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
