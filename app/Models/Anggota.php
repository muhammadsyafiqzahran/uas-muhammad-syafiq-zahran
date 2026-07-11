<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'anggotas';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'email',
    ];

    /**
     * Relasi: Anggota memiliki banyak Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }

    /**
     * Cek apakah anggota masih memiliki pinjaman aktif.
     */
    public function hasPinjamanAktif(): bool
    {
        return $this->peminjamans()->where('status', 'Dipinjam')->exists();
    }
}
