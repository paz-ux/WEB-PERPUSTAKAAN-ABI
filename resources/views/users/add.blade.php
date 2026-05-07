@extends('layout.master')

@section('judul', 'Tambah User')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-user-plus" style="color: #a855f7; margin-right: 8px;"></i>Tambah User Baru
            </h1>
            <p class="page-subtitle">Daftarkan user untuk akses sistem</p>
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-user-plus"></i> Form Tambah User
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> Validasi Gagal!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user" style="color: #a855f7;"></i> Nama User <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" placeholder="Masukkan nama lengkap user" 
                            value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope" style="color: #a855f7;"></i> Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" placeholder="Masukkan email (contoh: user@perpustakaan.com)" 
                            value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock" style="color: #a855f7;"></i> Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" placeholder="Masukkan password (min. 8 karakter)" 
                            required>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text d-block mt-2">
                            Password harus minimal 8 karakter dan kombinasi dari huruf, angka, dan simbol.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock" style="color: #a855f7;"></i> Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                            id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" 
                            required>
                        @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-info-circle"></i> Panduan
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Informasi yang diperlukan:</strong></p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success"></i> <strong>Nama:</strong> Nama lengkap user</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Email:</strong> Email aktif (unik)</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Password:</strong> Min. 8 karakter</li>
                </ul>
                <hr>
                <p><strong class="text-warning"><i class="fas fa-exclamation-circle"></i> Persyaratan Password:</strong></p>
                <ul class="list-unstyled small">
                    <li><i class="fas fa-check text-success"></i> Minimal 8 karakter</li>
                    <li><i class="fas fa-check text-success"></i> Kombinasi huruf besar dan kecil</li>
                    <li><i class="fas fa-check text-success"></i> Minimal satu angka</li>
                    <li><i class="fas fa-check text-success"></i> Minimal satu simbol (!@#$%)</li>
                </ul>
                <hr>
                <p class="text-muted small">Pastikan email tidak sudah terdaftar di sistem sebelumnya.</p>
            </div>
        </div>
    </div>
</div>
@endsection
