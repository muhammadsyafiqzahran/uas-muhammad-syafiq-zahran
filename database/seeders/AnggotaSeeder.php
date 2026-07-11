<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotas = [
            [
                'nama'   => 'Ahmad Fauzi',
                'alamat' => 'Jl. Mawar No. 12, Sleman, Yogyakarta',
                'no_hp'  => '081234567890',
                'email'  => 'ahmad.fauzi@email.com',
            ],
            [
                'nama'   => 'Siti Rahayu',
                'alamat' => 'Jl. Melati No. 5, Bantul, Yogyakarta',
                'no_hp'  => '082345678901',
                'email'  => 'siti.rahayu@email.com',
            ],
            [
                'nama'   => 'Budi Santoso',
                'alamat' => 'Jl. Kenanga No. 8, Gunung Kidul, Yogyakarta',
                'no_hp'  => '083456789012',
                'email'  => 'budi.santoso@email.com',
            ],
            [
                'nama'   => 'Dewi Lestari',
                'alamat' => 'Jl. Anggrek No. 3, Kulonprogo, Yogyakarta',
                'no_hp'  => '085678901234',
                'email'  => 'dewi.lestari@email.com',
            ],
            [
                'nama'   => 'Rizki Ramadhan',
                'alamat' => 'Jl. Cempaka No. 17, Kota Yogyakarta',
                'no_hp'  => '086789012345',
                'email'  => 'rizki.ramadhan@email.com',
            ],
            [
                'nama'   => 'Nur Aisyah',
                'alamat' => 'Jl. Dahlia No. 22, Sleman, Yogyakarta',
                'no_hp'  => '087890123456',
                'email'  => 'nur.aisyah@email.com',
            ],
            [
                'nama'   => 'Hendra Wijaya',
                'alamat' => 'Jl. Flamboyan No. 9, Bantul, Yogyakarta',
                'no_hp'  => '088901234567',
                'email'  => 'hendra.wijaya@email.com',
            ],
            [
                'nama'   => 'Fatimah Zahra',
                'alamat' => 'Jl. Seruni No. 14, Kota Yogyakarta',
                'no_hp'  => '089012345678',
                'email'  => 'fatimah.zahra@email.com',
            ],
        ];

        foreach ($anggotas as $anggota) {
            Anggota::create($anggota);
        }
    }
}
