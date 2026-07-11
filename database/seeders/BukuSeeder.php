<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = [
            [
                'kode_buku' => 'BK001',
                'judul'     => 'Pemrograman Web dengan PHP & MySQL',
                'penulis'   => 'Agus Saputra',
                'penerbit'  => 'Lokomedia',
                'tahun'     => 2022,
                'stok'      => 5,
            ],
            [
                'kode_buku' => 'BK002',
                'judul'     => 'Belajar Laravel dari Dasar',
                'penulis'   => 'Ridwan Kamil',
                'penerbit'  => 'Elex Media',
                'tahun'     => 2023,
                'stok'      => 3,
            ],
            [
                'kode_buku' => 'BK003',
                'judul'     => 'Algoritma dan Pemrograman',
                'penulis'   => 'Thomas H. Cormen',
                'penerbit'  => 'MIT Press',
                'tahun'     => 2020,
                'stok'      => 4,
            ],
            [
                'kode_buku' => 'BK004',
                'judul'     => 'Dasar-Dasar Basis Data',
                'penulis'   => 'Fathansyah',
                'penerbit'  => 'Informatika',
                'tahun'     => 2021,
                'stok'      => 6,
            ],
            [
                'kode_buku' => 'BK005',
                'judul'     => 'Sistem Informasi Manajemen',
                'penulis'   => 'Kenneth C. Laudon',
                'penerbit'  => 'Salemba Empat',
                'tahun'     => 2019,
                'stok'      => 2,
            ],
            [
                'kode_buku' => 'BK006',
                'judul'     => 'Jaringan Komputer dan Internet',
                'penulis'   => 'Andrew S. Tanenbaum',
                'penerbit'  => 'Pearson',
                'tahun'     => 2022,
                'stok'      => 3,
            ],
            [
                'kode_buku' => 'BK007',
                'judul'     => 'Kecerdasan Buatan',
                'penulis'   => 'Stuart J. Russell',
                'penerbit'  => 'Prentice Hall',
                'tahun'     => 2021,
                'stok'      => 4,
            ],
            [
                'kode_buku' => 'BK008',
                'judul'     => 'Bootstrap 5 untuk Pemula',
                'penulis'   => 'Wahyu Setia Bintara',
                'penerbit'  => 'Jasakom',
                'tahun'     => 2023,
                'stok'      => 0, // Habis - untuk test notifikasi
            ],
            [
                'kode_buku' => 'BK009',
                'judul'     => 'Rekayasa Perangkat Lunak',
                'penulis'   => 'Roger S. Pressman',
                'penerbit'  => 'Andi',
                'tahun'     => 2020,
                'stok'      => 5,
            ],
            [
                'kode_buku' => 'BK010',
                'judul'     => 'Manajemen Proyek Teknologi Informasi',
                'penulis'   => 'Kathy Schwalbe',
                'penerbit'  => 'Cengage Learning',
                'tahun'     => 2018,
                'stok'      => 2,
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }
    }
}
