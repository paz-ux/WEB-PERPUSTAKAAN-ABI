<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalSiswa = Siswa::count();
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $totalDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        return view('dashboard.index', compact(
            'totalBuku', 'totalSiswa', 'totalDipinjam', 'totalDikembalikan'
        ));
    }

    public function searchRakBuku(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $bukus = Buku::with('kategori')
            ->where('judul', 'LIKE', "%{$query}%")
            ->orWhere('penulis', 'LIKE', "%{$query}%")
            ->orWhere('rak_buku', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($buku) {
                return [
                    'id' => $buku->id,
                    'judul' => $buku->judul,
                    'penulis' => $buku->penulis,
                    'rak_buku' => $buku->rak_buku ?? 'Belum ditetapkan',
                    'stok' => $buku->stok,
                    'kategori' => $buku->kategori->nama_kategori ?? '-',
                    'foto' => $buku->foto ? asset('uploads/buku/' . $buku->foto) : null,
                ];
            });

        return response()->json($bukus);
    }
}
