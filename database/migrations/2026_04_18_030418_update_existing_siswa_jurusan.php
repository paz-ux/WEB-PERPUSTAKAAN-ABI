<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('siswas')->where('jurusan', 'Teknik Informatika')->update(['jurusan' => 'PPLG 1']);
        DB::table('siswas')->where('jurusan', 'Teknik Komputer')->update(['jurusan' => 'PPLG 2']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('siswas')->where('jurusan', 'PPLG 1')->update(['jurusan' => 'Teknik Informatika']);
        DB::table('siswas')->where('jurusan', 'PPLG 2')->update(['jurusan' => 'Teknik Komputer']);
    }
};
