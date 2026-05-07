<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['siswa', 'buku', 'user'])->paginate(10);
        return view('peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $bukus = Buku::where('stok', '>', 0)->get();
        $users = User::all();
        return view('peminjamans.add', compact('siswas', 'bukus', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_pinjam' => 'required|date',
        ], [
            'siswa_id.required' => 'Siswa harus dipilih',
            'buku_id.required' => 'Buku harus dipilih',
            'user_id.required' => 'User harus dipilih',
            'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
        ]);

        // Cek stok buku
        $buku = Buku::find($validated['buku_id']);
        if ($buku->stok <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Stok buku habis!');
        }

        // Kurangi stok buku
        $buku->decrement('stok');

        // Set fields
        $validated['status'] = 'dipinjam';
        $validated['denda'] = 0;
        $validated['batas_kembali'] = Carbon::parse($validated['tanggal_pinjam'])->addDays(4)->toDateString();
        $validated['tanggal_kembali'] = null; // Belum dikembalikan

        Peminjaman::create($validated);

        return redirect('/perpustakaan/peminjaman')
            ->with('success', 'Peminjaman berhasil dicatat. Batas kembali: ' . Carbon::parse($validated['batas_kembali'])->format('d M Y'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $siswas = Siswa::all();
        $bukus = Buku::all();
        $users = User::all();
        $dendaPerHari = (int) Setting::getValue('denda_per_hari', 10000);
        
        return view('peminjamans.edit', compact('peminjaman', 'siswas', 'bukus', 'users', 'dendaPerHari'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ], [
            'siswa_id.required' => 'Siswa harus dipilih',
            'buku_id.required' => 'Buku harus dipilih',
            'user_id.required' => 'User harus dipilih',
            'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
            'status.required' => 'Status harus dipilih',
            'tanggal_kembali.date' => 'Format tanggal kembali tidak valid',
        ]);

        // Recalculate batas_kembali if tanggal_pinjam changed
        $validated['batas_kembali'] = Carbon::parse($validated['tanggal_pinjam'])->addDays(4)->toDateString();

        // Handle stok: hanya kembalikan stok saat PERTAMA KALI transisi dipinjam -> dikembalikan
        if ($peminjaman->status == 'dipinjam' && $validated['status'] == 'dikembalikan') {
            $buku = Buku::find($validated['buku_id']);
            $buku->increment('stok');
        }

        // Hitung denda setiap kali status = dikembalikan
        if ($validated['status'] == 'dikembalikan') {
            // Gunakan tanggal kembali dari form, fallback ke hari ini
            if (empty($validated['tanggal_kembali'])) {
                $validated['tanggal_kembali'] = now()->toDateString();
            }

            // Hitung denda otomatis: Rp X per hari terlambat (dari pengaturan)
            $tanggalDikembalikan = Carbon::parse($validated['tanggal_kembali'])->startOfDay();
            $batasKembali = Carbon::parse($validated['batas_kembali'])->startOfDay();
            
            if ($tanggalDikembalikan->gt($batasKembali)) {
                $dendaPerHari = (int) Setting::getValue('denda_per_hari', 10000);
                $hariTerlambat = (int) abs($tanggalDikembalikan->diffInDays($batasKembali));
                $validated['denda'] = $hariTerlambat * $dendaPerHari;
            } else {
                $validated['denda'] = 0;
            }
        } else {
            // Status dipinjam: tanggal_kembali = null, denda = 0
            $validated['tanggal_kembali'] = null;
            $validated['denda'] = 0;
        }

        $peminjaman->update($validated);

        $message = 'Peminjaman berhasil diperbarui';
        if (isset($validated['denda']) && $validated['denda'] > 0) {
            $message .= '. Denda keterlambatan: Rp ' . number_format($validated['denda'], 0, ',', '.');
        }

        return redirect('/perpustakaan/peminjaman')
            ->with('success', $message);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Kembalikan stok jika status dipinjam
        if ($peminjaman->status == 'dipinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            $buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect('/perpustakaan/peminjaman')
            ->with('success', 'Peminjaman berhasil dihapus');
    }

    public function historiDenda()
    {
        $peminjamans = Peminjaman::with(['siswa', 'buku', 'user'])
            ->where(function ($query) {
                $query->where('denda', '>', 0)
                      ->orWhere(function ($q) {
                          $q->where('status', 'dipinjam')
                            ->whereNotNull('batas_kembali')
                            ->where('batas_kembali', '<', now()->toDateString());
                      });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        // Summary stats
        $totalDenda = Peminjaman::where('denda', '>', 0)->sum('denda');
        $jumlahSiswaDenda = Peminjaman::where('denda', '>', 0)->distinct('siswa_id')->count('siswa_id');
        $jumlahBelumKembali = Peminjaman::where('status', 'dipinjam')
            ->whereNotNull('batas_kembali')
            ->where('batas_kembali', '<', now()->toDateString())
            ->count();

        return view('laporan.histori-denda', compact('peminjamans', 'totalDenda', 'jumlahSiswaDenda', 'jumlahBelumKembali'));
    }

    public function historiDendaSiswa($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $peminjamans = Peminjaman::with(['buku', 'user'])
            ->where('siswa_id', $siswa_id)
            ->where('denda', '>', 0)
            ->orderBy('tanggal_kembali', 'desc')
            ->paginate(10);

        return view('laporan.histori-denda-siswa', compact('siswa', 'peminjamans'));
    }

    public function rekapDendaBulanan()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        $rekap = Peminjaman::selectRaw('DATE_FORMAT(tanggal_kembali, "%Y-%m") as bulan, SUM(denda) as total_denda, COUNT(*) as jumlah_peminjaman')
            ->where('denda', '>', 0)
            ->whereYear('tanggal_kembali', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('laporan.rekap-denda-bulanan', compact('rekap', 'bulan', 'tahun'));
    }
}
