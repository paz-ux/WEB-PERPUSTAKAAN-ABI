@extends('layout.master')

@section('judul', 'User')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 class="page-title">Daftar User</h1>
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

<div class="card shadow-sm">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white;">
            <i class="fas fa-list"></i> Data User
        </h5>
    </div>
    <div class="card-body">
        @if ($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Terdaftar Sejak</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-small">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span style="margin-left: 10px;">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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
                <i class="fas fa-inbox"></i>
                <h3>Tidak ada data</h3>
                <p>Belum ada user yang terdaftar. <a href="{{ route('user.create') }}" class="text-primary">Tambah sekarang</a></p>
            </div>
        @endif
    </div>
</div>

<style>
    .bg-gradient-blue-green {
        background: linear-gradient(135deg, #0072ff 0%, #00c853 100%);
    }

    .avatar-small {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0072ff 0%, #00c853 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0072ff 0%, #00c853 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 114, 255, 0.4);
        background: linear-gradient(135deg, #0072ff 0%, #00c853 100%);
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border: none;
        padding: 20px;
    }

    .card-body {
        padding: 20px;
    }
</style>
@endsection
