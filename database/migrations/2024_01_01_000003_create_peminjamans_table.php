<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('restrict');
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('restrict');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('status', 20)->default('Dipinjam'); // Dipinjam | Dikembalikan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
