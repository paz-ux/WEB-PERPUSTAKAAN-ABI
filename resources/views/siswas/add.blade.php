@extends('layout.master')

@section('judul', 'Tambah Siswa')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-user-plus" style="color: #a855f7; margin-right: 8px;"></i>Tambah Siswa Baru
            </h1>
            <p class="page-subtitle">Masukkan data siswa yang akan didaftarkan</p>
        </div>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-user-plus"></i> Form Tambah Siswa
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

                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user" style="color: #a855f7;"></i> Nama Siswa <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" name="nama" placeholder="Masukkan nama lengkap" 
                            value="{{ old('nama') }}" required>
                        @error('nama')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nis" class="form-label">
                            <i class="fas fa-id-card" style="color: #a855f7;"></i> NIS (Nomor Induk Siswa) <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                            id="nis" name="nis" placeholder="Masukkan NIS (Misal: 001001)" 
                            value="{{ old('nis') }}" required>
                        @error('nis')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">
                            <i class="fas fa-school" style="color: #a855f7;"></i> Kelas <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                            id="kelas" name="kelas" placeholder="Masukkan kelas (Misal: XI PPLG 1)" 
                            value="{{ old('kelas') }}" required>
                        @error('kelas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">
                            <i class="fas fa-book" style="color: #a855f7;"></i> Jurusan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('jurusan') is-invalid @enderror" 
                            id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="PPLG 1" {{ old('jurusan') == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
                            <option value="PPLG 2" {{ old('jurusan') == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
                            <option value="TJKT" {{ old('jurusan') == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                            <option value="DKV 1" {{ old('jurusan') == 'DKV 1' ? 'selected' : '' }}>DKV 1</option>
                            <option value="DKV 2" {{ old('jurusan') == 'DKV 2' ? 'selected' : '' }}>DKV 2</option>
                            <option value="BD 1" {{ old('jurusan') == 'BD 1' ? 'selected' : '' }}>BD 1</option>
                            <option value="BD 2" {{ old('jurusan') == 'BD 2' ? 'selected' : '' }}>BD 2</option>
                        </select>
                        @error('jurusan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
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
                    <li><i class="fas fa-check text-success"></i> <strong>Nama:</strong> Nama lengkap siswa</li>
                    <li><i class="fas fa-check text-success"></i> <strong>NIS:</strong> Nomor Induk Siswa (unik)</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Kelas:</strong> Tingkat dan rombel siswa</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Jurusan:</strong> Program keahlian siswa</li>
                </ul>
                <hr>
                <p class="text-muted small">Semua field harus diisi dengan benar untuk mendaftarkan siswa baru.</p>
            </div>
        </div>
    </div>
</div>
@endsection
