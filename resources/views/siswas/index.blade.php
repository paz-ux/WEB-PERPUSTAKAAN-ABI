@extends('layout.master')

@section('judul', 'Siswa')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-user-graduate" style="color: #a855f7; margin-right: 8px;"></i>Daftar Siswa
            </h1>
            <p class="page-subtitle">Kelola data siswa perpustakaan dengan mudah</p>
        </div>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Siswa
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
            <i class="fas fa-users"></i> Data Siswa
        </h5>
    </div>
    <div class="card-body">
        @if ($siswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $key => $siswa)
                        <tr>
                            <td>{{ $siswas->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-small">
                                        <i class="fas fa-user" style="font-size: 12px;"></i>
                                    </div>
                                    <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $siswa->nama }}</div>
                                </div>
                            </td>
                            <td>
                                <span style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(59,130,246,0.15); color: #93c5fd; border: 1px solid rgba(59,130,246,0.2);">
                                    {{ $siswa->nis }}
                                </span>
                            </td>
                            <td style="color: #d1d5db; font-weight: 500; font-size: 13px;">{{ $siswa->kelas }}</td>
                            <td>
                                <span style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(168,85,247,0.15); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.2);">
                                    {{ $siswa->jurusan }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('laporan.denda-siswa', $siswa->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 8px; font-size: 11px; font-weight: 600;" data-tooltip="Histori Denda">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning" data-tooltip="Edit Siswa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                        data-id="{{ $siswa->id }}" 
                                        data-name="{{ $siswa->nama }}"
                                        data-tooltip="Hapus Siswa">
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
                {{ $siswas->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-user-graduate"></i>
                <h3>Belum Ada Data Siswa</h3>
                <p>Sistem perpustakaan belum memiliki data siswa yang terdaftar.</p>
                <a href="{{ route('siswa.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>
            </div>
        @endif
    </div>
</div>

@if ($siswas->count() > 0)
@foreach ($siswas as $siswa)
<form id="delete-form-{{ $siswa->id }}" action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: none;">
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
                title: 'Hapus Siswa?',
                html: `Apakah kamu yakin ingin menghapus siswa <strong>"${name}"</strong>?<br><small style="color:#f87171;">Data yang dihapus tidak bisa dikembalikan!</small>`,
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
