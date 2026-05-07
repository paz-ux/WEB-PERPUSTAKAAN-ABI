<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->date('batas_kembali')->nullable()->after('tanggal_kembali');
        });

        // Migrate existing data: copy tanggal_kembali to batas_kembali
        // For 'dipinjam' records, tanggal_kembali IS the deadline
        // For 'dikembalikan' records, tanggal_kembali was overwritten to actual return date
        DB::table('peminjamans')->whereNotNull('tanggal_kembali')->update([
            'batas_kembali' => DB::raw('tanggal_kembali'),
        ]);

        // For 'dipinjam' records, set tanggal_kembali to null (not returned yet)
        DB::table('peminjamans')->where('status', 'dipinjam')->update([
            'tanggal_kembali' => null,
        ]);
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('batas_kembali');
        });
    }
};
