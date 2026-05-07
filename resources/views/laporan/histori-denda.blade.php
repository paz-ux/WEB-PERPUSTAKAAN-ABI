@extends('layout.master')

@section('judul', 'Histori Denda')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-file-invoice-dollar" style="color: #a855f7; margin-right: 8px;"></i>Histori Denda
            </h1>
            <p class="page-subtitle">Riwayat seluruh denda keterlambatan pengembalian buku</p>
        </div>
        <a href="{{ route('laporan.denda-bulanan') }}" class="btn btn-secondary">
            <i class="fas fa-chart-bar"></i> Rekap Bulanan
        </a>
    </div>
</div>

<!-- Summary Stats -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
    <div style="
        background: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 16px;
        padding: 20px 24px;
        backdrop-filter: blur(12px);
    ">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="
                width: 48px; height: 48px; border-radius: 14px;
                background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(220,38,38,0.15));
                display: flex; align-items: center; justify-content: center;
                border: 1px solid rgba(239,68,68,0.25);
            ">
                <i class="fas fa-money-bill-wave" style="color: #fca5a5; font-size: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 900; color: #fca5a5; letter-spacing: -0.5px;">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </div>
                <div style="font-size: 12px; color: #9ca3af; font-weight: 500;">Total Denda Terkumpul</div>
            </div>
        </div>
    </div>

    <div style="
        background: rgba(245, 158, 11, 0.08);
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 16px;
        padding: 20px 24px;
        backdrop-filter: blur(12px);
    ">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="
                width: 48px; height: 48px; border-radius: 14px;
                background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(234,88,12,0.15));
                display: flex; align-items: center; justify-content: center;
                border: 1px solid rgba(245,158,11,0.25);
            ">
                <i class="fas fa-user-clock" style="color: #fcd34d; font-size: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 900; color: #fcd34d; letter-spacing: -0.5px;">
                    {{ $jumlahBelumKembali }}
                </div>
                <div style="font-size: 12px; color: #9ca3af; font-weight: 500;">Masih Terlambat (Belum Kembali)</div>
            </div>
        </div>
    </div>

    <div style="
        background: rgba(147, 51, 234, 0.08);
        border: 1px solid rgba(147, 51, 234, 0.2);
        border-radius: 16px;
        padding: 20px 24px;
        backdrop-filter: blur(12px);
    ">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="
                width: 48px; height: 48px; border-radius: 14px;
                background: linear-gradient(135deg, rgba(147,51,234,0.2), rgba(124,58,237,0.15));
                display: flex; align-items: center; justify-content: center;
                border: 1px solid rgba(147,51,234,0.25);
            ">
                <i class="fas fa-users" style="color: #c4b5fd; font-size: 20px;"></i>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 900; color: #c4b5fd; letter-spacing: -0.5px;">
                    {{ $jumlahSiswaDenda }}
                </div>
                <div style="font-size: 12px; color: #9ca3af; font-weight: 500;">Siswa Pernah Kena Denda</div>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white; font-weight: 700;">
            <i class="fas fa-history"></i> Riwayat Denda Keterlambatan
        </h5>
    </div>
    <div class="card-body">
        @if ($peminjamans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Siswa</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Tgl Dikembalikan</th>
                            <th>Terlambat</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $key => $p)
                        @php
                            $isOverdue = $p->status == 'dipinjam' && $p->batas_kembali && now()->gt($p->batas_kembali);
                            $hariTerlambat = 0;
                            if ($p->status == 'dikembalikan' && $p->tanggal_kembali && $p->batas_kembali) {
                                $hariTerlambat = (int) abs(\Carbon\Carbon::parse($p->tanggal_kembali)->startOfDay()->diffInDays(\Carbon\Carbon::parse($p->batas_kembali)->startOfDay()));
                            } elseif ($isOverdue) {
                                $hariTerlambat = (int) abs(now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($p->batas_kembali)->startOfDay()));
                            }
                        @endphp
                        <tr>
                            <td>{{ $peminjamans->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-small">
                                        <i class="fas fa-user" style="font-size: 12px;"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $p->siswa->nama }}</div>
                                        <div style="font-size: 11px; color: #9ca3af;">{{ $p->siswa->nis }} · {{ $p->siswa->kelas ?? '' }} {{ $p->siswa->jurusan ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $p->buku->judul }}</div>
                                    <div style="font-size: 11px; color: #9ca3af;">{{ $p->buku->penulis }}</div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #93c5fd; font-size: 13px;">
                                    {{ $p->tanggal_pinjam->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #fcd34d; font-size: 13px;">
                                    {{ $p->batas_kembali ? $p->batas_kembali->format('d M Y') : '-' }}
                                </span>
                            </td>
                            <td>
                                @if($p->tanggal_kembali)
                                    <span style="font-weight: 600; color: #86efac; font-size: 13px;">
                                        {{ $p->tanggal_kembali->format('d M Y') }}
                                    </span>
                                @else
                                    <span style="color: #f87171; font-style: italic; font-size: 12px;">
                                        <i class="fas fa-exclamation-circle"></i> Belum kembali
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($hariTerlambat > 0)
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
                                        background: rgba(239,68,68,0.15); color: #fca5a5;
                                        border: 1px solid rgba(239,68,68,0.25);
                                    ">
                                        <i class="fas fa-clock" style="font-size: 9px;"></i> {{ $hariTerlambat }} hari
                                    </span>
                                @else
                                    <span style="color: #6b7280; font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status == 'dikembalikan' && $p->denda > 0)
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
                                        background: rgba(34,197,94,0.15); color: #86efac;
                                        border: 1px solid rgba(34,197,94,0.2);
                                    ">
                                        <i class="fas fa-check-circle" style="font-size: 10px;"></i> Sudah Dikembalikan
                                    </span>
                                @elseif($isOverdue)
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
                                        background: rgba(239,68,68,0.15); color: #fca5a5;
                                        border: 1px solid rgba(239,68,68,0.2);
                                        animation: pulse-badge 2s ease-in-out infinite;
                                    ">
                                        <i class="fas fa-exclamation-triangle" style="font-size: 10px;"></i> Terlambat!
                                    </span>
                                @else
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
                                        background: rgba(245,158,11,0.15); color: #fcd34d;
                                        border: 1px solid rgba(245,158,11,0.2);
                                    ">
                                        <i class="fas fa-clock" style="font-size: 10px;"></i> Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($p->denda > 0)
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 800;
                                        background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(220,38,38,0.15));
                                        color: #fca5a5;
                                        border: 1px solid rgba(239,68,68,0.3);
                                    ">
                                        Rp {{ number_format($p->denda, 0, ',', '.') }}
                                    </span>
                                @elseif($isOverdue)
                                    @php
                                        $estimasiDenda = $hariTerlambat * (int) \App\Models\Setting::getValue('denda_per_hari', 10000);
                                    @endphp
                                    <span style="
                                        display: inline-flex; align-items: center; gap: 4px;
                                        padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;
                                        background: rgba(245,158,11,0.15); color: #fcd34d;
                                        border: 1px solid rgba(245,158,11,0.25);
                                    " title="Estimasi denda jika dikembalikan hari ini">
                                        <i class="fas fa-exclamation-circle" style="font-size: 10px;"></i>
                                        ~Rp {{ number_format($estimasiDenda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span style="color: #6b7280; font-size: 12px;">Rp 0</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $peminjamans->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-file-invoice-dollar"></i>
                <h3>Tidak Ada Histori Denda</h3>
                <p>Belum ada data peminjaman yang dikenakan denda keterlambatan.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('extra_css')
<style>
    @keyframes pulse-badge {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>
@endsection
