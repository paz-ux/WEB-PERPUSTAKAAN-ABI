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
        Schema::table('siswas', function (Blueprint $table) {
            $table->enum('jurusan', ['PPLG 1', 'PPLG 2', 'TJKT', 'DKV 1', 'DKV 2', 'BD 1', 'BD 2'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->change();
        });
    }
};
