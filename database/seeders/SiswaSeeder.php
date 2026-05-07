<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('siswas')->insert([
            [
                'nama' => 'Ahmad Raihan',
                'nis' => '001001',
                'kelas' => 'XI PPLG 1',
                'jurusan' => 'PPLG 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'nis' => '001002',
                'kelas' => 'XI PPLG 1',
                'jurusan' => 'PPLG 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ahmad Santoso',
                'nis' => '001003',
                'kelas' => 'XI PPLG 2',
                'jurusan' => 'PPLG 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Putri',
                'nis' => '001004',
                'kelas' => 'XI PPLG 2',
                'jurusan' => 'PPLG 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Doni Hermawan',
                'nis' => '001005',
                'kelas' => 'XI PPLG 1',
                'jurusan' => 'PPLG 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
