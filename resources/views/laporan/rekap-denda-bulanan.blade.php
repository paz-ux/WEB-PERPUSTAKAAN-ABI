@extends('layout.master')

@section('judul', 'Rekap Denda Bulanan')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-chart-bar" style="color: #a855f7; margin-right: 8px;"></i>Rekap Denda Bulanan
            </h1>
            <p class="page-subtitle">Laporan denda peminjaman per bulan</p>
        </div>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white; font-weight: 700;">
            <i class="fas fa-chart-bar"></i> Rekap Denda Tahun {{ $tahun }}
        </h5>
    </div>
    <div class="card-body">
        @if ($rekap->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Bulan</th>
                            <th>Jumlah Peminjaman Denda</th>
                            <th>Total Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td style="font-weight: 600; color: #f1f5f9;">{{ \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->format('F Y') }}</td>
                            <td><span class="badge bg-warning">{{ $data->jumlah_peminjaman }}</span></td>
                            <td><span class="badge bg-danger">Rp {{ number_format($data->total_denda, 0, ',', '.') }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-dark">
                            <th colspan="2">Total</th>
                            <th>{{ $rekap->sum('jumlah_peminjaman') }}</th>
                            <th>Rp {{ number_format($rekap->sum('total_denda'), 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-chart-line"></i>
                <h3>Tidak ada data denda</h3>
                <p>Belum ada peminjaman yang dikenakan denda pada tahun ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection