<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with(['anggota', 'buku'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Anggota',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status'
        ];
    }

    public function map($peminjaman): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $peminjaman->anggota->nama,
            $peminjaman->buku->judul,
            $peminjaman->tgl_pinjam->format('d/m/Y'),
            $peminjaman->tgl_kembali->format('d/m/Y'),
            $peminjaman->status
        ];
    }
}
