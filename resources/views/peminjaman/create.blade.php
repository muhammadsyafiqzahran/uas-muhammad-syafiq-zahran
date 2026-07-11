@extends('layouts.app')
@section('title','Tambah Peminjaman')
@section('page-title','Tambah Peminjaman')
@section('content')
<div class="page-header animate-fade-up">
    <div class="page-header-left"><h1 class="page-title">Tambah Peminjaman</h1></div>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="content-card animate-fade-up">
            <div class="content-card-header"><h6 class="content-card-title"><i class="bi bi-plus-circle-fill"></i> Form Peminjaman</h6></div>
            <div class="content-card-body">
                <form method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Anggota <span class="text-danger">*</span></label>
                            <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggotas as $a)
                                <option value="{{ $a->id }}" {{ old('anggota_id')==$a->id?'selected':'' }}>{{ $a->nama }} — {{ $a->no_hp }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Buku <span class="text-danger">*</span></label>
                            <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku (tersedia) --</option>
                                @foreach($bukus as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id')==$b->id?'selected':'' }}>{{ $b->judul }} (Stok: {{ $b->stok }})</option>
                                @endforeach
                            </select>
                            @error('buku_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pinjam" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                                   value="{{ old('tgl_pinjam', date('Y-m-d')) }}" required>
                            @error('tgl_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_kembali" class="form-control @error('tgl_kembali') is-invalid @enderror"
                                   value="{{ old('tgl_kembali', date('Y-m-d', strtotime('+7 days'))) }}" required>
                            @error('tgl_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Simpan Peminjaman</button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
