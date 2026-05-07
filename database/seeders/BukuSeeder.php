<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $bukus = [
            // === RAK 1 - Fiksi ===
            ['judul' => 'Harry Potter and the Philosopher\'s Stone', 'penulis' => 'J.K. Rowling', 'tahun_terbit' => 1997, 'kategori' => 'Fiksi', 'stok' => 5, 'rak_buku' => 1, 'deskripsi' => 'Novel fantasi tentang seorang anak yatim piatu yang menemukan bahwa dirinya adalah seorang penyihir.'],
            ['judul' => 'The Lord of the Rings', 'penulis' => 'J.R.R. Tolkien', 'tahun_terbit' => 1954, 'kategori' => 'Fiksi', 'stok' => 4, 'rak_buku' => 1, 'deskripsi' => 'Epik fantasi tentang petualangan untuk menghancurkan cincin kekuatan.'],
            ['judul' => 'Narnia: The Lion, the Witch and the Wardrobe', 'penulis' => 'C.S. Lewis', 'tahun_terbit' => 1950, 'kategori' => 'Fiksi', 'stok' => 3, 'rak_buku' => 1, 'deskripsi' => 'Empat anak menemukan dunia ajaib bernama Narnia melalui sebuah lemari.'],
            ['judul' => 'Percy Jackson & the Olympians', 'penulis' => 'Rick Riordan', 'tahun_terbit' => 2005, 'kategori' => 'Fiksi', 'stok' => 4, 'rak_buku' => 1, 'deskripsi' => 'Seorang remaja menemukan bahwa dia adalah putra dewa Yunani Poseidon.'],
            ['judul' => 'The Hunger Games', 'penulis' => 'Suzanne Collins', 'tahun_terbit' => 2008, 'kategori' => 'Fiksi', 'stok' => 3, 'rak_buku' => 1, 'deskripsi' => 'Dystopia di mana anak-anak dipaksa bertarung sampai mati dalam acara televisi.'],

            // === RAK 2 - Non-Fiksi & Self-Help ===
            ['judul' => 'Sapiens: A Brief History of Humankind', 'penulis' => 'Yuval Noah Harari', 'tahun_terbit' => 2011, 'kategori' => 'Non-Fiksi', 'stok' => 3, 'rak_buku' => 2, 'deskripsi' => 'Sejarah singkat umat manusia dari zaman prasejarah hingga modern.'],
            ['judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'tahun_terbit' => 2018, 'kategori' => 'Non-Fiksi', 'stok' => 6, 'rak_buku' => 2, 'deskripsi' => 'Cara membangun kebiasaan baik dan menghancurkan kebiasaan buruk.'],
            ['judul' => 'Thinking, Fast and Slow', 'penulis' => 'Daniel Kahneman', 'tahun_terbit' => 2011, 'kategori' => 'Non-Fiksi', 'stok' => 2, 'rak_buku' => 2, 'deskripsi' => 'Dua sistem berpikir yang menggerakkan cara kita berpikir.'],
            ['judul' => 'The Power of Habit', 'penulis' => 'Charles Duhigg', 'tahun_terbit' => 2012, 'kategori' => 'Non-Fiksi', 'stok' => 3, 'rak_buku' => 2, 'deskripsi' => 'Mengapa kita melakukan apa yang kita lakukan dan bagaimana mengubahnya.'],
            ['judul' => 'Rich Dad Poor Dad', 'penulis' => 'Robert T. Kiyosaki', 'tahun_terbit' => 1997, 'kategori' => 'Non-Fiksi', 'stok' => 5, 'rak_buku' => 2, 'deskripsi' => 'Pelajaran tentang uang yang diajarkan oleh ayah kaya dan ayah miskin.'],

            // === RAK 3 - Referensi & Bahasa ===
            ['judul' => 'Kamus Besar Bahasa Indonesia', 'penulis' => 'Tim Pusat Bahasa', 'tahun_terbit' => 2008, 'kategori' => 'Referensi', 'stok' => 2, 'rak_buku' => 3, 'deskripsi' => 'Kamus resmi bahasa Indonesia yang disusun oleh Pusat Bahasa.'],
            ['judul' => 'Oxford English Dictionary', 'penulis' => 'Oxford University Press', 'tahun_terbit' => 2010, 'kategori' => 'Referensi', 'stok' => 2, 'rak_buku' => 3, 'deskripsi' => 'Kamus bahasa Inggris paling komprehensif di dunia.'],
            ['judul' => 'Tata Bahasa Baku Bahasa Indonesia', 'penulis' => 'Hasan Alwi', 'tahun_terbit' => 2003, 'kategori' => 'Bahasa', 'stok' => 3, 'rak_buku' => 3, 'deskripsi' => 'Panduan tata bahasa Indonesia yang baku dan benar.'],
            ['judul' => 'English Grammar in Use', 'penulis' => 'Raymond Murphy', 'tahun_terbit' => 2019, 'kategori' => 'Bahasa', 'stok' => 4, 'rak_buku' => 3, 'deskripsi' => 'Buku grammar bahasa Inggris terlaris di dunia.'],

            // === RAK 4 - Sains ===
            ['judul' => 'A Brief History of Time', 'penulis' => 'Stephen Hawking', 'tahun_terbit' => 1988, 'kategori' => 'Sains', 'stok' => 3, 'rak_buku' => 4, 'deskripsi' => 'Penjelasan tentang kosmologi, big bang, dan lubang hitam untuk pembaca umum.'],
            ['judul' => 'Cosmos', 'penulis' => 'Carl Sagan', 'tahun_terbit' => 1980, 'kategori' => 'Sains', 'stok' => 2, 'rak_buku' => 4, 'deskripsi' => 'Perjalanan menjelajahi alam semesta dan tempat manusia di dalamnya.'],
            ['judul' => 'The Origin of Species', 'penulis' => 'Charles Darwin', 'tahun_terbit' => 1901, 'kategori' => 'Sains', 'stok' => 2, 'rak_buku' => 4, 'deskripsi' => 'Teori evolusi melalui seleksi alam yang mengubah dunia sains.'],
            ['judul' => 'Fisika Dasar', 'penulis' => 'Halliday & Resnick', 'tahun_terbit' => 2013, 'kategori' => 'Sains', 'stok' => 5, 'rak_buku' => 4, 'deskripsi' => 'Buku teks fisika dasar untuk mahasiswa dan siswa SMK.'],

            // === RAK 5 - Teknologi & Komputer ===
            ['judul' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'tahun_terbit' => 2008, 'kategori' => 'Teknologi', 'stok' => 3, 'rak_buku' => 5, 'deskripsi' => 'Panduan menulis kode yang bersih, mudah dibaca, dan maintainable.'],
            ['judul' => 'The Pragmatic Programmer', 'penulis' => 'Andrew Hunt & David Thomas', 'tahun_terbit' => 1999, 'kategori' => 'Teknologi', 'stok' => 2, 'rak_buku' => 5, 'deskripsi' => 'Tips dan teknik praktis untuk menjadi programmer yang lebih baik.'],
            ['judul' => 'Introduction to Algorithms', 'penulis' => 'Thomas H. Cormen', 'tahun_terbit' => 2009, 'kategori' => 'Teknologi', 'stok' => 3, 'rak_buku' => 5, 'deskripsi' => 'Buku referensi utama untuk algoritma dan struktur data.'],
            ['judul' => 'Pemrograman Web dengan PHP & MySQL', 'penulis' => 'Lukmanul Hakim', 'tahun_terbit' => 2020, 'kategori' => 'Teknologi', 'stok' => 4, 'rak_buku' => 5, 'deskripsi' => 'Panduan lengkap membangun website dinamis dengan PHP dan MySQL.'],
            ['judul' => 'Belajar JavaScript Modern', 'penulis' => 'Eko Kurniawan', 'tahun_terbit' => 2021, 'kategori' => 'Teknologi', 'stok' => 3, 'rak_buku' => 5, 'deskripsi' => 'Buku panduan belajar JavaScript dari dasar hingga mahir.'],

            // === RAK 6 - Sejarah ===
            ['judul' => 'Sejarah Indonesia Modern', 'penulis' => 'M.C. Ricklefs', 'tahun_terbit' => 2005, 'kategori' => 'Sejarah', 'stok' => 3, 'rak_buku' => 6, 'deskripsi' => 'Sejarah Indonesia dari masa kolonial hingga era reformasi.'],
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'tahun_terbit' => 1980, 'kategori' => 'Sastra', 'stok' => 4, 'rak_buku' => 6, 'deskripsi' => 'Novel sejarah tentang perjuangan kaum pribumi di era kolonial Belanda.'],
            ['judul' => 'Guns, Germs, and Steel', 'penulis' => 'Jared Diamond', 'tahun_terbit' => 1997, 'kategori' => 'Sejarah', 'stok' => 2, 'rak_buku' => 6, 'deskripsi' => 'Mengapa beberapa peradaban lebih maju dari yang lain.'],
            ['judul' => 'Sejarah Dunia yang Disembunyikan', 'penulis' => 'Jonathan Black', 'tahun_terbit' => 2007, 'kategori' => 'Sejarah', 'stok' => 3, 'rak_buku' => 6, 'deskripsi' => 'Pandangan alternatif tentang sejarah peradaban manusia.'],

            // === RAK 7 - Sastra Indonesia ===
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'tahun_terbit' => 2005, 'kategori' => 'Sastra', 'stok' => 5, 'rak_buku' => 7, 'deskripsi' => 'Kisah inspiratif tentang perjuangan 10 anak di Belitung untuk mendapat pendidikan.'],
            ['judul' => 'Perahu Kertas', 'penulis' => 'Dee Lestari', 'tahun_terbit' => 2009, 'kategori' => 'Sastra', 'stok' => 3, 'rak_buku' => 7, 'deskripsi' => 'Novel tentang mimpi, cinta, dan seni yang saling bersinggungan.'],
            ['judul' => 'Ronggeng Dukuh Paruk', 'penulis' => 'Ahmad Tohari', 'tahun_terbit' => 1982, 'kategori' => 'Sastra', 'stok' => 2, 'rak_buku' => 7, 'deskripsi' => 'Kisah seorang ronggeng di desa terpencil Jawa yang penuh tragedi.'],
            ['judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'tahun_terbit' => 2009, 'kategori' => 'Sastra', 'stok' => 4, 'rak_buku' => 7, 'deskripsi' => 'Kisah persahabatan dan mimpi enam santri di pondok pesantren.'],
            ['judul' => 'Ayat-Ayat Cinta', 'penulis' => 'Habiburrahman El Shirazy', 'tahun_terbit' => 2004, 'kategori' => 'Sastra', 'stok' => 3, 'rak_buku' => 7, 'deskripsi' => 'Novel islami tentang kisah cinta seorang mahasiswa Indonesia di Mesir.'],

            // === RAK 8 - Agama ===
            ['judul' => 'Tafsir Al-Misbah', 'penulis' => 'M. Quraish Shihab', 'tahun_terbit' => 2002, 'kategori' => 'Agama', 'stok' => 2, 'rak_buku' => 8, 'deskripsi' => 'Tafsir Al-Quran kontemporer karya ulama Indonesia terkemuka.'],
            ['judul' => 'Fiqih Islam', 'penulis' => 'Sulaiman Rasjid', 'tahun_terbit' => 1976, 'kategori' => 'Agama', 'stok' => 4, 'rak_buku' => 8, 'deskripsi' => 'Buku panduan fiqih Islam yang mudah dipahami.'],
            ['judul' => 'Sejarah Peradaban Islam', 'penulis' => 'Badri Yatim', 'tahun_terbit' => 2008, 'kategori' => 'Agama', 'stok' => 3, 'rak_buku' => 8, 'deskripsi' => 'Sejarah peradaban Islam dari masa Nabi hingga modern.'],

            // === RAK 9 - Matematika ===
            ['judul' => 'Matematika Diskrit', 'penulis' => 'Rinaldi Munir', 'tahun_terbit' => 2016, 'kategori' => 'Matematika', 'stok' => 4, 'rak_buku' => 9, 'deskripsi' => 'Buku teks matematika diskrit untuk mahasiswa informatika.'],
            ['judul' => 'Kalkulus Jilid 1', 'penulis' => 'James Stewart', 'tahun_terbit' => 2015, 'kategori' => 'Matematika', 'stok' => 3, 'rak_buku' => 9, 'deskripsi' => 'Buku teks kalkulus standar untuk mahasiswa teknik dan sains.'],
            ['judul' => 'Aljabar Linear', 'penulis' => 'Howard Anton', 'tahun_terbit' => 2013, 'kategori' => 'Matematika', 'stok' => 3, 'rak_buku' => 9, 'deskripsi' => 'Pengantar aljabar linear dan aplikasinya.'],
            ['judul' => 'Statistika untuk Penelitian', 'penulis' => 'Sugiyono', 'tahun_terbit' => 2017, 'kategori' => 'Matematika', 'stok' => 5, 'rak_buku' => 9, 'deskripsi' => 'Panduan lengkap statistika untuk keperluan penelitian.'],

            // === RAK 10 - Campuran / Populer ===
            ['judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'tahun_terbit' => 2018, 'kategori' => 'Non-Fiksi', 'stok' => 4, 'rak_buku' => 10, 'deskripsi' => 'Pengantar filsafat Stoisisme untuk kehidupan modern.'],
            ['judul' => 'Laut Bercerita', 'penulis' => 'Leila S. Chudori', 'tahun_terbit' => 2017, 'kategori' => 'Sastra', 'stok' => 3, 'rak_buku' => 10, 'deskripsi' => 'Novel tentang aktivis mahasiswa yang hilang di era Orde Baru.'],
            ['judul' => 'Homo Deus', 'penulis' => 'Yuval Noah Harari', 'tahun_terbit' => 2015, 'kategori' => 'Non-Fiksi', 'stok' => 2, 'rak_buku' => 10, 'deskripsi' => 'Masa depan umat manusia di era kecerdasan buatan dan bioteknologi.'],
            ['judul' => 'Sang Pemimpi', 'penulis' => 'Andrea Hirata', 'tahun_terbit' => 2006, 'kategori' => 'Sastra', 'stok' => 4, 'rak_buku' => 10, 'deskripsi' => 'Sekuel Laskar Pelangi tentang mimpi dan petualangan tiga sahabat.'],
        ];

        foreach ($bukus as $data) {
            $kategori = Kategori::firstOrCreate(
                ['nama_kategori' => $data['kategori']],
                ['keterangan' => '-']
            );

            Buku::updateOrCreate(
                ['judul' => $data['judul']],
                [
                    'penulis' => $data['penulis'],
                    'tahun_terbit' => $data['tahun_terbit'],
                    'kategori_id' => $kategori->id,
                    'stok' => $data['stok'],
                    'rak_buku' => $data['rak_buku'],
                    'deskripsi' => $data['deskripsi'],
                ]
            );
        }
    }
}
