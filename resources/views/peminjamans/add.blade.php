@extends('layout.master')

@section('judul', 'Tambah Peminjaman')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-plus-circle" style="color: #a855f7; margin-right: 8px;"></i>Tambah Peminjaman Baru
            </h1>
            <p class="page-subtitle">Catat data peminjaman buku baru</p>
        </div>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-plus-circle"></i> Form Tambah Peminjaman
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

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="siswa_id" class="form-label">
                            <i class="fas fa-user-graduate" style="color: #a855f7;"></i> Siswa <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('siswa_id') is-invalid @enderror" 
                            id="siswa_id" name="siswa_id" required>
                            <option value="">-- Pilih Siswa --</option>
                            @if(isset($siswas))
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->nama }} ({{ $siswa->nis }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('siswa_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label">
                            <i class="fas fa-book" style="color: #a855f7;"></i> Buku <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('buku_id') is-invalid @enderror" 
                            id="buku_id" name="buku_id" required>
                            <option value="">-- Pilih Buku --</option>
                            @if(isset($bukus))
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }} (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('buku_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">
                            <i class="fas fa-user-tie" style="color: #a855f7;"></i> Petugas <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('user_id') is-invalid @enderror" 
                            id="user_id" name="user_id" required>
                            <option value="">-- Pilih Petugas --</option>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">
                            <i class="fas fa-calendar-alt" style="color: #a855f7;"></i> Tanggal Pinjam <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                            id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Contoh: 2026-04-15"
                            value="{{ old('tanggal_pinjam') }}" required>
                        @error('tanggal_pinjam')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
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
                <p><strong>Cara meminjam buku:</strong></p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success"></i> Pilih <strong>Siswa</strong> yang meminjam</li>
                    <li><i class="fas fa-check text-success"></i> Pilih <strong>Buku</strong> yang dipinjam</li>
                    <li><i class="fas fa-check text-success"></i> Pilih <strong>Petugas</strong> yang mencatat</li>
                    <li><i class="fas fa-check text-success"></i> Isi <strong>Tanggal Pinjam</strong></li>
                    <li><i class="fas fa-check text-success"></i> Klik <strong>Simpan</strong></li>
                </ul>
                <hr>
                <p class="text-muted small mb-1"><i class="fas fa-info-circle"></i> Status otomatis menjadi <strong>"Dipinjam"</strong></p>
                <p class="text-muted small mb-0"><i class="fas fa-info-circle"></i> Siswa boleh meminjam <strong>buku yang sama lebih dari 1</strong> selama stok masih ada</p>
            </div>
        </div>
    </div>
</div>
@endsection
