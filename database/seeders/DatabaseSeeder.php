<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan penting: Buku dan Anggota dulu sebelum Peminjaman (FK constraint)
        $this->call([
            BukuSeeder::class,
            AnggotaSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
