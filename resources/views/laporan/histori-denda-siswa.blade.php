@extends('layout.master')

@section('judul', 'Histori Denda Siswa')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-money-bill-wave" style="color: #a855f7; margin-right: 8px;"></i>Histori Denda - {{ $siswa->nama }}
            </h1>
            <p class="page-subtitle">Riwayat denda peminjaman buku</p>
        </div>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white; font-weight: 700;">
            <i class="fas fa-money-bill-wave"></i> Data Denda Siswa: {{ $siswa->nama }}
        </h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="border: 1px solid rgba(168,85,247,0.2);">
                    <div class="card-body text-center" style="padding: 16px;">
                        <small class="text-muted">NIS</small>
                        <div style="font-weight: 700; color: #f1f5f9; font-size: 16px;">{{ $siswa->nis }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid rgba(168,85,247,0.2);">
                    <div class="card-body text-center" style="padding: 16px;">
                        <small class="text-muted">Kelas</small>
                        <div style="font-weight: 700; color: #f1f5f9; font-size: 16px;">{{ $siswa->kelas }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid rgba(168,85,247,0.2);">
                    <div class="card-body text-center" style="padding: 16px;">
                        <small class="text-muted">Jurusan</small>
                        <div style="font-weight: 700; color: #f1f5f9; font-size: 16px;">{{ $siswa->jurusan }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid rgba(239,68,68,0.3); background: rgba(239,68,68,0.08);">
                    <div class="card-body text-center" style="padding: 16px;">
                        <small style="color: #fca5a5;">Total Denda</small>
                        <div style="font-weight: 800; color: #fca5a5; font-size: 16px;">Rp {{ number_format($peminjamans->sum('denda'), 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        @if ($peminjamans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $key => $peminjaman)
                        <tr>
                            <td>{{ $peminjamans->firstItem() + $key }}</td>
                            <td style="font-weight: 600; color: #f1f5f9;">{{ $peminjaman->buku->judul }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                            <td><span class="badge bg-danger">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</span></td>
                            <td>{{ $peminjaman->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $peminjamans->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-check-circle text-success"></i>
                <h3>Tidak ada denda</h3>
                <p>Siswa ini belum pernah dikenakan denda.</p>
            </div>
        @endif
    </div>
</div>
@endsection