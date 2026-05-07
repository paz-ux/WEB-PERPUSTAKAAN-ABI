<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $dendaPerHari = Setting::getValue('denda_per_hari', 10000);
        return view('settings.index', compact('dendaPerHari'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'denda_per_hari' => 'required|integer|min:0|max:1000000',
        ], [
            'denda_per_hari.required' => 'Nominal denda harus diisi',
            'denda_per_hari.integer' => 'Nominal denda harus berupa angka',
            'denda_per_hari.min' => 'Nominal denda tidak boleh minus',
            'denda_per_hari.max' => 'Nominal denda maksimal Rp 1.000.000',
        ]);

        Setting::setValue('denda_per_hari', $validated['denda_per_hari']);

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan denda berhasil diperbarui. Denda per hari: Rp ' . number_format($validated['denda_per_hari'], 0, ',', '.'));
    }
}
