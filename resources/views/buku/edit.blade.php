@extends('layouts.app')
@section('title','Edit Buku')
@section('page-title','Edit Buku')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left">
        <h1 class="page-title">Edit Data Buku</h1>
        <p class="page-subtitle">Perbarui informasi buku: <strong>{{ $buku->judul }}</strong></p>
    </div>
    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="content-card animate-fade-up">
            <div class="content-card-header">
                <h6 class="content-card-title"><i class="bi bi-pencil-fill"></i> Edit Buku</h6>
            </div>
            <div class="content-card-body">
                <form method="POST" action="{{ route('buku.update', $buku) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Buku <span class="text-danger">*</span></label>
                            <input type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror"
                                   value="{{ old('kode_buku', $buku->kode_buku) }}" required>
                            @error('kode_buku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                   value="{{ old('tahun', $buku->tahun) }}" required>
                            @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul', $buku->judul) }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                                   value="{{ old('penulis', $buku->penulis) }}" required>
                            @error('penulis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror"
                                   value="{{ old('penerbit', $buku->penerbit) }}" required>
                            @error('penerbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', $buku->stok) }}" min="0" required>
                            @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Cover Buku <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                            @if($buku->cover)
                            <div class="mb-2">
                                <img src="{{ Storage::url($buku->cover) }}" style="height:70px;border-radius:6px;border:1px solid var(--card-border);" alt="Cover saat ini">
                                <small class="text-muted d-block mt-1">Cover saat ini</small>
                            </div>
                            @endif
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                            @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Perbarui</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
