<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Fiksi', 'keterangan' => 'Buku-buku bercerita fiksi, novel, dan dongeng'],
            ['nama_kategori' => 'Non-Fiksi', 'keterangan' => 'Buku-buku ilmu pengetahuan, biografi, dan sejarah'],
            ['nama_kategori' => 'Referensi', 'keterangan' => 'Buku-buku referensi, kamus, dan ensiklopedia'],
            ['nama_kategori' => 'Sains', 'keterangan' => 'Buku-buku sains, fisika, kimia, dan biologi'],
            ['nama_kategori' => 'Teknologi', 'keterangan' => 'Buku-buku teknologi informasi, pemrograman, dan komputer'],
            ['nama_kategori' => 'Sejarah', 'keterangan' => 'Buku-buku sejarah dunia dan Indonesia'],
            ['nama_kategori' => 'Sastra', 'keterangan' => 'Buku-buku sastra Indonesia dan sastra dunia'],
            ['nama_kategori' => 'Agama', 'keterangan' => 'Buku-buku keagamaan dan spiritualitas'],
            ['nama_kategori' => 'Matematika', 'keterangan' => 'Buku-buku matematika dan logika'],
            ['nama_kategori' => 'Bahasa', 'keterangan' => 'Buku-buku pembelajaran bahasa'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                ['keterangan' => $kategori['keterangan']]
            );
        }
    }
}
