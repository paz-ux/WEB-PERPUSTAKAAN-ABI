@extends('layout.master')

@section('judul', 'User')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-users" style="color: #a855f7; margin-right: 8px;"></i>Daftar User
            </h1>
            <p class="page-subtitle">Kelola pengguna sistem perpustakaan</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
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
            <i class="fas fa-users-cog"></i> Data User
        </h5>
    </div>
    <div class="card-body">
        @if ($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Terdaftar Sejak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-small">
                                        <i class="fas fa-user" style="font-size: 14px;"></i>
                                    </div>
                                    <div style="font-weight: 700; color: #f1f5f9;">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td style="color: #d1d5db;">{{ $user->email }}</td>
                            <td>
                                <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: rgba(168,85,247,0.15); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.2);">
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning" data-tooltip="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}"
                                        data-tooltip="Hapus User">
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
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Data User</h3>
                <p>Belum ada user yang terdaftar di sistem.</p>
                <a href="{{ route('user.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>
        @endif
    </div>
</div>

@if ($users->count() > 0)
@foreach ($users as $user)
<form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
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
                title: 'Hapus User?',
                html: `Apakah kamu yakin ingin menghapus user <strong>"${name}"</strong>?<br><small style="color:#f87171;">Data yang dihapus tidak bisa dikembalikan!</small>`,
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
