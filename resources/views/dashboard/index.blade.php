@extends('layout.master')

@section('page_title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="card mb-4" style="background: linear-gradient(135deg, rgba(124,58,237,0.3), rgba(59,130,246,0.2)); border: 1px solid rgba(147,51,234,0.2);">
    <div class="card-body" style="padding: 32px; position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; opacity: 0.06;">
            <div style="position: absolute; top: 0; left: 0; width: 120px; height: 120px; background: white; border-radius: 50%; transform: translate(-40px, -40px);"></div>
            <div style="position: absolute; top: 0; right: 0; width: 90px; height: 90px; background: white; border-radius: 50%; transform: translate(30px, -30px);"></div>
        </div>

        <div style="position: relative; z-index: 1; text-align: center; color: white;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: transparent; border-radius: 50%; margin-bottom: 16px; overflow: hidden;">
                <img src="{{ asset('logo.png') }}" alt="Logo PAZPUS" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.outerHTML='<div style=\'display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 100%; background: rgba(255,255,255,0.15); backdrop-filter: blur(8px); border-radius: 50%;\'><i class=\'fas fa-book\' style=\'font-size: 28px; color: white;\'></i></div>'">
            </div>
            <h1 style="font-size: 28px; font-weight: 900; margin-bottom: 12px; letter-spacing: -0.5px;">
                Selamat Datang di
                    PAZPERPUS
            </h1>
            <p style="font-size: 14px; color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto;">
                Sistem informasi PAZPUS modern untuk mengelola data buku, siswa, dan peminjaman.
            </p>
        </div>
    </div>
</div>

<!-- Quick Search Rak Buku -->
<div class="card mb-4" style="border: 1px solid rgba(168,85,247,0.2);">
    <div class="card-body" style="padding: 20px;">
        <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 250px;">
                <div style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(168,85,247,0.2), rgba(59,130,246,0.15)); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-search-location" style="color: #a855f7; font-size: 18px;"></i>
                </div>
                <div>
                    <h6 style="font-weight: 700; color: #f1f5f9; margin-bottom: 2px; font-size: 14px;">Cari Rak Buku</h6>
                    <p style="font-size: 12px; color: #9ca3af; margin: 0;">Temukan lokasi buku dengan cepat</p>
                </div>
            </div>
            <a href="{{ route('cari-rak.index') }}" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari Sekarang
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card" style="transition: all 0.3s ease;">
            <div class="card-body" style="padding: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <p style="font-size: 12px; font-weight: 600; color: #9ca3af; margin-bottom: 4px;">Total Buku</p>
                        <p style="font-size: 28px; font-weight: 900; color: #f1f5f9; margin: 0;">{{ $totalBuku ?? 0 }}</p>
                    </div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book-open" style="color: white; font-size: 18px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card" style="transition: all 0.3s ease;">
            <div class="card-body" style="padding: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <p style="font-size: 12px; font-weight: 600; color: #9ca3af; margin-bottom: 4px;">Total Siswa</p>
                        <p style="font-size: 28px; font-weight: 900; color: #f1f5f9; margin: 0;">{{ $totalSiswa ?? 0 }}</p>
                    </div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-graduate" style="color: white; font-size: 18px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card" style="transition: all 0.3s ease;">
            <div class="card-body" style="padding: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <p style="font-size: 12px; font-weight: 600; color: #9ca3af; margin-bottom: 4px;">Dipinjam</p>
                        <p style="font-size: 28px; font-weight: 900; color: #f1f5f9; margin: 0;">{{ $totalDipinjam ?? 0 }}</p>
                    </div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exchange-alt" style="color: white; font-size: 18px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card" style="transition: all 0.3s ease;">
            <div class="card-body" style="padding: 20px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <p style="font-size: 12px; font-weight: 600; color: #9ca3af; margin-bottom: 4px;">Dikembalikan</p>
                        <p style="font-size: 28px; font-weight: 900; color: #f1f5f9; margin: 0;">{{ $totalDikembalikan ?? 0 }}</p>
                    </div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #a855f7, #7c3aed); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle" style="color: white; font-size: 18px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guide Section -->
<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-info-circle"></i> Panduan Cepat
                </h5>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 14px;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="flex-shrink: 0; width: 28px; height: 28px; background: rgba(59,130,246,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(59,130,246,0.2);">
                            <span style="font-size: 12px; font-weight: 800; color: #93c5fd;">1</span>
                        </div>
                        <div>
                            <h6 style="font-weight: 700; color: #f1f5f9; font-size: 14px; margin-bottom: 2px;">Cara Meminjam Buku</h6>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">Peminjaman → Catat Peminjaman → Pilih siswa & buku → Simpan</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="flex-shrink: 0; width: 28px; height: 28px; background: rgba(34,197,94,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(34,197,94,0.2);">
                            <span style="font-size: 12px; font-weight: 800; color: #86efac;">2</span>
                        </div>
                        <div>
                            <h6 style="font-weight: 700; color: #f1f5f9; font-size: 14px; margin-bottom: 2px;">Cara Mengembalikan</h6>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">Edit peminjaman → Status "Dikembalikan" → Denda otomatis dihitung</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="flex-shrink: 0; width: 28px; height: 28px; background: rgba(168,85,247,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(168,85,247,0.2);">
                            <span style="font-size: 12px; font-weight: 800; color: #d8b4fe;">3</span>
                        </div>
                        <div>
                            <h6 style="font-weight: 700; color: #f1f5f9; font-size: 14px; margin-bottom: 2px;">Cari Rak Buku</h6>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">Menu "Cari Rak Buku" → ketik judul → lihat lokasi rak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
