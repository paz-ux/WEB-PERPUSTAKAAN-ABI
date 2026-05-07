<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::paginate(10);
        return view('siswas.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswas.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis|max:20',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|in:PPLG 1,PPLG 2,TJKT,DKV 1,DKV 2,BD 1,BD 2',
        ], [
            'nama.required' => 'Nama siswa harus diisi',
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas harus diisi',
            'jurusan.required' => 'Jurusan harus diisi',
            'jurusan.in' => 'Jurusan tidak valid',
        ]);

        Siswa::create($validated);

        return redirect('/perpustakaan/siswa')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $id,
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|in:PPLG 1,PPLG 2,TJKT,DKV 1,DKV 2,BD 1,BD 2',
        ], [
            'nama.required' => 'Nama siswa harus diisi',
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas harus diisi',
            'jurusan.required' => 'Jurusan harus diisi',
            'jurusan.in' => 'Jurusan tidak valid',
        ]);

        $siswa->update($validated);

        return redirect('/perpustakaan/siswa')
            ->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        // Check if siswa has any related peminjamans
        if ($siswa->peminjamans()->exists()) {
            return redirect('/perpustakaan/siswa')
                ->with('error', 'Tidak dapat menghapus siswa ini karena masih memiliki data peminjaman. Hapus data peminjaman terlebih dahulu.');
        }
        
        $siswa->delete();

        return redirect('/perpustakaan/siswa')
            ->with('success', 'Siswa berhasil dihapus');
    }
}
