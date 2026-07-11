<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'bukus';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'cover',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tahun' => 'integer',
        'stok'  => 'integer',
    ];

    /**
     * Relasi: Buku memiliki banyak Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    /**
     * Scope: Buku yang masih tersedia (stok > 0).
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Accessor: URL cover buku.
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover) {
            return asset('storage/covers/' . $this->cover);
        }
        return asset('images/no-cover.png');
    }
}
