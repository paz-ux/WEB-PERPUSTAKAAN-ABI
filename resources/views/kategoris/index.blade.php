@extends('layout.master')

@section('judul', 'Kategori')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-layer-group" style="color: #a855f7; margin-right: 8px;"></i>Daftar Kategori Buku
            </h1>
            <p class="page-subtitle">Kelola kategori buku perpustakaan</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
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
            <i class="fas fa-list"></i> Data Kategori
        </h5>
    </div>
    <div class="card-body">
        @if ($kategoris->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $key => $kategori)
                        <tr>
                            <td>{{ $kategoris->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-small">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <span style="margin-left: 12px; font-weight: 600; color: #f1f5f9;">{{ $kategori->nama_kategori }}</span>
                                </div>
                            </td>
                            <td>{{ Str::limit($kategori->keterangan, 50) }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning" data-tooltip="Edit Kategori">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                    data-id="{{ $kategori->id }}" 
                                    data-name="{{ $kategori->nama_kategori }}"
                                    data-tooltip="Hapus Kategori">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $kategoris->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Tidak ada data</h3>
                <p>Belum ada kategori yang dibuat. <a href="{{ route('kategori.create') }}" class="text-primary">Buat sekarang</a></p>
            </div>
        @endif
    </div>
</div>

@if ($kategoris->count() > 0)
@foreach ($kategoris as $kategori)
<form id="delete-form-{{ $kategori->id }}" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: none;">
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
                title: 'Hapus Kategori?',
                html: `Apakah kamu yakin ingin menghapus kategori <strong>"${name}"</strong>?<br><small style="color:#f87171;">Data yang dihapus tidak bisa dikembalikan!</small>`,
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
