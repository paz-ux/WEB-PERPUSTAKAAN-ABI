<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->paginate(10);
        return view('bukus.index', compact('bukus'));
    }

    /**
     * Show book detail (JSON for preview modal)
     */
    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        $totalPeminjaman = $buku->peminjamans()->count();
        $sedangDipinjam = $buku->peminjamans()->where('status', 'dipinjam')->count();

        return response()->json([
            'id' => $buku->id,
            'judul' => $buku->judul,
            'penulis' => $buku->penulis,
            'tahun_terbit' => $buku->tahun_terbit,
            'kategori' => $buku->kategori->nama_kategori ?? '-',
            'stok' => $buku->stok,
            'rak_buku' => $buku->rak_buku ?? 'Belum ditetapkan',
            'foto' => $buku->foto ? asset('uploads/buku/' . $buku->foto) : null,
            'deskripsi' => $buku->deskripsi ?? '',
            'total_peminjaman' => $totalPeminjaman,
            'sedang_dipinjam' => $sedangDipinjam,
        ]);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('bukus.add', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:2100',
            'kategori_nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'rak_buku' => 'nullable|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'penulis.required' => 'Penulis harus diisi',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka',
            'kategori_nama.required' => 'Kategori harus diisi',
            'stok.required' => 'Stok harus diisi',
            'stok.min' => 'Stok tidak boleh minus',
            'rak_buku.integer' => 'Nomor rak harus berupa angka',
            'rak_buku.min' => 'Nomor rak minimal 1',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WebP',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $kategori = Kategori::firstOrCreate(
            ['nama_kategori' => $validated['kategori_nama']],
            ['keterangan' => '-']
        );

        unset($validated['kategori_nama']);
        $validated['kategori_id'] = $kategori->id;

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/buku'), $filename);
            $validated['foto'] = $filename;
        }

        Buku::create($validated);

        return redirect('/perpustakaan/buku')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:2100',
            'kategori_nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'rak_buku' => 'nullable|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'penulis.required' => 'Penulis harus diisi',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka',
            'kategori_nama.required' => 'Kategori harus diisi',
            'stok.required' => 'Stok harus diisi',
            'stok.min' => 'Stok tidak boleh minus',
            'rak_buku.integer' => 'Nomor rak harus berupa angka',
            'rak_buku.min' => 'Nomor rak minimal 1',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WebP',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $kategori = Kategori::firstOrCreate(
            ['nama_kategori' => $validated['kategori_nama']],
            ['keterangan' => '-']
        );

        unset($validated['kategori_nama']);
        $validated['kategori_id'] = $kategori->id;

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($buku->foto && file_exists(public_path('uploads/buku/' . $buku->foto))) {
                unlink(public_path('uploads/buku/' . $buku->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/buku'), $filename);
            $validated['foto'] = $filename;
        }

        $buku->update($validated);

        return redirect('/perpustakaan/buku')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        
        // Check if buku has any related peminjamans
        if ($buku->peminjamans()->exists()) {
            return redirect('/perpustakaan/buku')
                ->with('error', 'Tidak dapat menghapus buku ini karena masih memiliki data peminjaman. Hapus data peminjaman terlebih dahulu.');
        }

        // Delete photo if exists
        if ($buku->foto && file_exists(public_path('uploads/buku/' . $buku->foto))) {
            unlink(public_path('uploads/buku/' . $buku->foto));
        }
        
        $buku->delete();

        return redirect('/perpustakaan/buku')
            ->with('success', 'Buku berhasil dihapus');
    }

    /**
     * Search books (AJAX endpoint for shelf search)
     */
    public function search(Request $request)
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

    /**
     * Show Cari Rak Buku page with all shelves displayed
     */
    public function cariRak()
    {
        $bukusByRak = Buku::with('kategori')
            ->whereNotNull('rak_buku')
            ->orderBy('rak_buku')
            ->orderBy('judul')
            ->get()
            ->groupBy('rak_buku');

        return view('cari-rak.index', compact('bukusByRak'));
    }
}
