@extends('layout.master')

@section('judul', 'Edit Siswa')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-user-edit" style="color: #a855f7; margin-right: 8px;"></i>Edit Data Siswa
            </h1>
            <p class="page-subtitle">Ubah informasi siswa</p>
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
                    <i class="fas fa-edit"></i> Form Edit Siswa
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

                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user" style="color: #a855f7;"></i> Nama Siswa <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" name="nama" placeholder="Masukkan nama lengkap" 
                            value="{{ old('nama', $siswa->nama) }}" required>
                        @error('nama')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nis" class="form-label">
                            <i class="fas fa-id-card" style="color: #a855f7;"></i> NIS (Nomor Induk Siswa) <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                            id="nis" name="nis" placeholder="Masukkan NIS" 
                            value="{{ old('nis', $siswa->nis) }}" required>
                        @error('nis')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">
                            <i class="fas fa-school" style="color: #a855f7;"></i> Kelas <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                            id="kelas" name="kelas" placeholder="Masukkan kelas" 
                            value="{{ old('kelas', $siswa->kelas) }}" required>
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
                            <option value="PPLG 1" {{ old('jurusan', $siswa->jurusan) == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
                            <option value="PPLG 2" {{ old('jurusan', $siswa->jurusan) == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
                            <option value="TJKT" {{ old('jurusan', $siswa->jurusan) == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                            <option value="DKV 1" {{ old('jurusan', $siswa->jurusan) == 'DKV 1' ? 'selected' : '' }}>DKV 1</option>
                            <option value="DKV 2" {{ old('jurusan', $siswa->jurusan) == 'DKV 2' ? 'selected' : '' }}>DKV 2</option>
                            <option value="BD 1" {{ old('jurusan', $siswa->jurusan) == 'BD 1' ? 'selected' : '' }}>BD 1</option>
                            <option value="BD 2" {{ old('jurusan', $siswa->jurusan) == 'BD 2' ? 'selected' : '' }}>BD 2</option>
                        </select>
                        @error('jurusan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui Data
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
                    <i class="fas fa-user"></i> Informasi Siswa
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
                <p><strong>Jurusan:</strong> {{ $siswa->jurusan }}</p>
                <hr>
                <p class="text-muted small">
                    <i class="fas fa-clock"></i> 
                    Diperbarui: {{ $siswa->updated_at->format('d M Y H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
