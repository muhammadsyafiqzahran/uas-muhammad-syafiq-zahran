<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'peminjamans';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tgl_pinjam'   => 'date',
        'tgl_kembali'  => 'date',
    ];

    /**
     * Status constants.
     */
    const STATUS_DIPINJAM     = 'Dipinjam';
    const STATUS_DIKEMBALIKAN = 'Dikembalikan';

    /**
     * Relasi: Peminjaman belongs to Anggota.
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    /**
     * Relasi: Peminjaman belongs to Buku.
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    /**
     * Scope: Filter peminjaman yang masih aktif (Dipinjam).
     */
    public function scopeAktif($query)
    {
        return $query->where('status', self::STATUS_DIPINJAM);
    }

    /**
     * Scope: Filter peminjaman yang sudah dikembalikan.
     */
    public function scopeDikembalikan($query)
    {
        return $query->where('status', self::STATUS_DIKEMBALIKAN);
    }

    /**
     * Accessor: Cek apakah peminjaman terlambat.
     */
    public function getTerlambatAttribute(): bool
    {
        if ($this->status === self::STATUS_DIPINJAM) {
            return now()->gt($this->tgl_kembali);
        }
        return false;
    }
}
