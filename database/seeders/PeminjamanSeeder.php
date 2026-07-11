<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();

        if ($anggotas->count() === 0 || $bukus->count() === 0) {
            return;
        }

        // Buat 5 transaksi peminjaman dummy
        for ($i = 0; $i < 5; $i++) {
            $buku = $bukus->random();
            
            // Skip jika stok habis
            if ($buku->stok <= 0) continue;

            $status = rand(0, 1) ? Peminjaman::STATUS_DIPINJAM : Peminjaman::STATUS_DIKEMBALIKAN;
            $tglPinjam = now()->subDays(rand(1, 30));
            $tglKembali = (clone $tglPinjam)->addDays(7);

            Peminjaman::create([
                'anggota_id'  => $anggotas->random()->id,
                'buku_id'     => $buku->id,
                'tgl_pinjam'  => $tglPinjam,
                'tgl_kembali' => $tglKembali,
                'status'      => $status,
            ]);

            // Jika masih dipinjam, kurangi stok
            if ($status === Peminjaman::STATUS_DIPINJAM) {
                $buku->decrement('stok');
            }
        }
    }
}
