@extends('layout.master')

@section('judul', 'Profile Setting')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-user-cog" style="color: #a855f7; margin-right: 8px;"></i>Profile Setting
            </h1>
            <p class="page-subtitle">Kelola informasi profil dan foto anda</p>
        </div>
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

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

<div class="row">
    <!-- Foto Profile Section -->
    <div class="col-md-4">
        <div class="card profile-photo-card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-camera"></i> Foto Profil
                </h5>
            </div>
            <div class="card-body text-center">
                <div class="photo-container">
                    @if($user->foto)
                        <img src="{{ asset('uploads/profile/' . $user->foto) }}" 
                             alt="Foto Profil" class="profile-photo" id="previewPhoto">
                    @else
                        <div class="photo-placeholder" id="photoPlaceholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <img src="" alt="Preview" class="profile-photo" id="previewPhoto" style="display: none;">
                    @endif
                </div>
                
                <h4 class="profile-display-name">{{ $user->name }}</h4>
                <span class="badge bg-role">{{ ucfirst($user->role ?? 'admin') }}</span>

                <form action="{{ route('profile.foto') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="foto" id="fotoInput" accept="image/*" class="d-none" onchange="previewImage(event)">
                        <label for="fotoInput" class="upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Klik untuk upload foto</span>
                            <small>JPG, PNG, GIF, WebP (Max 2MB)</small>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3" id="btnUpload" style="display: none;">
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </form>

                @if($user->foto)
                <form action="{{ route('profile.foto.delete') }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                            onclick="return confirm('Yakin ingin menghapus foto profil?')">
                        <i class="fas fa-trash"></i> Hapus Foto
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Info Profile Section -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-user-edit"></i> Informasi Profil
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user" style="color: #a855f7;"></i> Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope" style="color: #a855f7;"></i> Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <h6 style="color: #a78bfa; margin-bottom: 16px;">
                        <i class="fas fa-lock"></i> Ubah Password
                        <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small>
                    </h6>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-key" style="color: #a855f7;"></i> Password Baru
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" placeholder="Masukkan password baru (min. 6 karakter)">
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-check-double" style="color: #a855f7;"></i> Konfirmasi Password
                        </label>
                        <input type="password" class="form-control" 
                            id="password_confirmation" name="password_confirmation" 
                            placeholder="Ulangi password baru">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .photo-container {
        width: 160px;
        height: 160px;
        margin: 0 auto 20px;
        position: relative;
    }

    .profile-photo {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid transparent;
        background: linear-gradient(rgba(15,15,35,1), rgba(15,15,35,1)) padding-box,
                    linear-gradient(135deg, #7c3aed, #3b82f6) border-box;
        box-shadow: 0 8px 30px rgba(124, 58, 237, 0.3);
    }

    .photo-placeholder {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7c3aed, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 64px;
        box-shadow: 0 8px 30px rgba(124, 58, 237, 0.3);
    }

    .profile-display-name {
        font-size: 22px;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: 8px;
    }

    .bg-role {
        background: linear-gradient(135deg, #7c3aed, #3b82f6) !important;
        font-size: 12px;
        padding: 5px 16px;
        border-radius: 20px;
    }

    .upload-area {
        border: 2px dashed rgba(168, 85, 247, 0.3);
        border-radius: 14px;
        padding: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: rgba(168, 85, 247, 0.6);
        background: rgba(168, 85, 247, 0.05);
    }

    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: #9ca3af;
        margin: 0;
    }

    .upload-label i {
        font-size: 32px;
        color: #a855f7;
    }

    .upload-label span {
        font-weight: 600;
        font-size: 14px;
        color: #d1d5db;
    }

    .upload-label small {
        color: #6b7280;
        font-size: 12px;
    }
</style>

@endsection

@section('extra_js')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('previewPhoto');
                const placeholder = document.getElementById('photoPlaceholder');
                
                preview.src = e.target.result;
                preview.style.display = 'block';
                
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
                
                document.getElementById('btnUpload').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
