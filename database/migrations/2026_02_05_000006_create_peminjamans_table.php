<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('buku_id')->constrained('bukus');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan']);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
