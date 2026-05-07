<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'foto.required' => 'Pilih foto terlebih dahulu',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format harus jpeg, png, jpg, gif, atau webp',
            'foto.max' => 'Ukuran foto maksimal 2MB',
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->foto && file_exists(public_path('uploads/profile/' . $user->foto))) {
            unlink(public_path('uploads/profile/' . $user->foto));
        }

        // Upload foto baru
        $file = $request->file('foto');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile'), $filename);

        $user->foto = $filename;
        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Foto profil berhasil diperbarui');
    }

    public function deleteFoto()
    {
        $user = Auth::user();

        if ($user->foto && file_exists(public_path('uploads/profile/' . $user->foto))) {
            unlink(public_path('uploads/profile/' . $user->foto));
        }

        $user->foto = null;
        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Foto profil berhasil dihapus');
    }
}
