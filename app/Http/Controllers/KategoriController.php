<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::paginate(10);
        return view('kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'required|string',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        Kategori::create($validated);

        return redirect('/perpustakaan/kategori')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'required|string',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $kategori->update($validated);

        return redirect('/perpustakaan/kategori')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Check if kategori has any related bukus
        if ($kategori->bukus()->exists()) {
            return redirect('/perpustakaan/kategori')
                ->with('error', 'Tidak dapat menghapus kategori ini karena masih memiliki data buku. Hapus data buku terlebih dahulu.');
        }
        
        $kategori->delete();

        return redirect('/perpustakaan/kategori')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
