@extends('layout.master')

@section('judul', 'Peminjaman')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-exchange-alt" style="color: #a855f7; margin-right: 8px;"></i>Data Peminjaman
            </h1>
            <p class="page-subtitle">Pantau semua aktivitas peminjaman buku</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Catat Peminjaman
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white; font-weight: 700;">
            <i class="fas fa-history"></i> Riwayat Peminjaman
        </h5>
    </div>
    <div class="card-body">
        @if ($peminjamans->count() > 0)
            <div>
                <table class="table table-hover" style="word-break: break-word;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Siswa</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Tgl Dikembalikan</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $key => $peminjaman)
                        <tr>
                            <td>{{ $peminjamans->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-small">
                                        <i class="fas fa-user" style="font-size: 12px;"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $peminjaman->siswa->nama }}</div>
                                        <div style="font-size: 11px; color: #9ca3af;">{{ $peminjaman->siswa->nis }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $peminjaman->buku->judul }}</div>
                                    <div style="font-size: 11px; color: #9ca3af;">{{ $peminjaman->buku->penulis }}</div>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #93c5fd; font-size: 13px;">
                                    {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                @if($peminjaman->batas_kembali)
                                    @php
                                        $isOverdue = $peminjaman->status == 'dipinjam' && now()->gt($peminjaman->batas_kembali);
                                    @endphp
                                    <span style="font-weight: 600; color: {{ $isOverdue ? '#f87171' : '#fcd34d' }}; font-size: 13px;">
                                        {{ $peminjaman->batas_kembali->format('d M Y') }}
                                        @if($isOverdue)
                                            <br><small style="color: #f87171;"><i class="fas fa-exclamation-triangle"></i> Terlambat!</small>
                                        @endif
                                    </span>
                                @else
                                    <span style="color: #6b7280; font-style: italic; font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($peminjaman->tanggal_kembali)
                                    <span style="font-weight: 600; color: #86efac; font-size: 13px;">
                                        {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                    </span>
                                @else
                                    <span style="color: #6b7280; font-style: italic; font-size: 12px;">Belum kembali</span>
                                @endif
                            </td>
                            <td>
                                @if($peminjaman->status == 'dipinjam')
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(245,158,11,0.15); color: #fcd34d; border: 1px solid rgba(245,158,11,0.2);">
                                        <i class="fas fa-clock" style="font-size: 10px;"></i> Dipinjam
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(34,197,94,0.15); color: #86efac; border: 1px solid rgba(34,197,94,0.2);">
                                        <i class="fas fa-check-circle" style="font-size: 10px;"></i> Dikembalikan
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($peminjaman->denda > 0)
                                    <span class="badge bg-danger">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</span>
                                @else
                                    <span style="display: inline-flex; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; background: rgba(107,114,128,0.15); color: #9ca3af; border: 1px solid rgba(107,114,128,0.2);">Rp 0</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-sm btn-warning" data-tooltip="Edit Peminjaman">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                        data-id="{{ $peminjaman->id }}" 
                                        data-name="{{ $peminjaman->buku->judul }} - {{ $peminjaman->siswa->nama }}"
                                        data-tooltip="Hapus Peminjaman">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
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
                <i class="fas fa-exchange-alt"></i>
                <h3>Belum Ada Data Peminjaman</h3>
                <p>Sistem belum mencatat aktivitas peminjaman buku.</p>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Catat Peminjaman
                </a>
            </div>
        @endif
    </div>
</div>

@if ($peminjamans->count() > 0)
@foreach ($peminjamans as $peminjaman)
<form id="delete-form-{{ $peminjaman->id }}" action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach
@endif
@endsection

@section('extra_js')
<script>
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;

            Swal.fire({
                title: 'Hapus Peminjaman?',
                html: `Apakah kamu yakin ingin menghapus data peminjaman <strong>"${name}"</strong>?<br><small style="color:#f87171;">Data yang dihapus tidak bisa dikembalikan!</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#1a1a2e',
                color: '#e2e8f0',
                customClass: { popup: 'swal-dark-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });
</script>
<style>.swal-dark-popup { border: 1px solid rgba(147,51,234,0.2) !important; border-radius: 20px !important; }</style>
@endsection
