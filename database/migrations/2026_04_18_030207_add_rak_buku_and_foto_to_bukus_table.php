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
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('rak_buku')->nullable()->after('stok');
            $table->string('foto')->nullable()->after('rak_buku');
        });
    }

    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn(['rak_buku', 'foto']);
        });
    }
};
