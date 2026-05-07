@extends('layout.master')

@section('judul', 'Tambah Buku')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-plus-circle" style="color: #a855f7; margin-right: 8px;"></i>Tambah Buku Baru
            </h1>
            <p class="page-subtitle">Masukkan data buku baru ke koleksi perpustakaan</p>
        </div>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-book"></i> Form Tambah Buku
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

                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">
                            <i class="fas fa-book" style="color: #a855f7;"></i> Judul Buku <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                            id="judul" name="judul" placeholder="Masukkan judul buku" 
                            value="{{ old('judul') }}" required>
                        @error('judul')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penulis" class="form-label">
                            <i class="fas fa-pen-fancy" style="color: #a855f7;"></i> Penulis <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                            id="penulis" name="penulis" placeholder="Masukkan nama penulis" 
                            value="{{ old('penulis') }}" required>
                        @error('penulis')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">
                                    <i class="fas fa-calendar" style="color: #a855f7;"></i> Tahun Terbit <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                                    id="tahun_terbit" name="tahun_terbit" placeholder="Contoh: 2024" 
                                    value="{{ old('tahun_terbit') }}" min="1900" max="{{ date('Y') + 1 }}" required>
                                @error('tahun_terbit')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori_nama" class="form-label">
                                    <i class="fas fa-list" style="color: #a855f7;"></i> Kategori <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('kategori_nama') is-invalid @enderror" 
                                    id="kategori_nama" name="kategori_nama" placeholder="Contoh: Novel, Fiksi, Sains" 
                                    value="{{ old('kategori_nama') }}" required>
                                @error('kategori_nama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stok" class="form-label">
                                    <i class="fas fa-cubes" style="color: #a855f7;"></i> Stok <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                    id="stok" name="stok" placeholder="Jumlah eksemplar" 
                                    value="{{ old('stok') }}" min="0" required>
                                @error('stok')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rak_buku" class="form-label">
                                    <i class="fas fa-map-marker-alt" style="color: #a855f7;"></i> Rak Buku
                                </label>
                                <input type="number" class="form-control @error('rak_buku') is-invalid @enderror" 
                                    id="rak_buku" name="rak_buku" placeholder="Contoh: 1, 2, 3" 
                                    value="{{ old('rak_buku') }}" min="1">
                                @error('rak_buku')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text d-block mt-1">Nomor rak tempat buku disimpan</small>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Buku -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">
                            <i class="fas fa-align-left" style="color: #a855f7;"></i> Deskripsi Buku
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                            id="deskripsi" name="deskripsi" rows="4" 
                            placeholder="Tuliskan deskripsi singkat tentang isi buku ini..."
                            style="resize: vertical; min-height: 100px;">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text d-block mt-1">Opsional. Maksimal 1000 karakter.</small>
                    </div>

                    <!-- Upload Foto/Sampul -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-image" style="color: #a855f7;"></i> Sampul Buku
                        </label>
                        <div style="border: 2px dashed rgba(168,85,247,0.3); border-radius: 14px; padding: 24px; text-align: center; cursor: pointer; transition: all 0.3s ease;" 
                            id="uploadArea" onclick="document.getElementById('fotoInput').click();">
                            <input type="file" name="foto" id="fotoInput" accept="image/*" class="d-none" onchange="previewBookCover(event)">
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 36px; color: #a855f7; margin-bottom: 8px;"></i>
                                <p style="font-weight: 600; color: #d1d5db; margin-bottom: 4px;">Klik untuk upload sampul buku</p>
                                <small style="color: #6b7280;">JPG, PNG, GIF, WebP (Max 2MB)</small>
                            </div>
                            <img id="previewCover" src="" alt="Preview" style="max-height: 200px; border-radius: 10px; display: none;">
                        </div>
                        @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Buku
                        </button>
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
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
                    <li><i class="fas fa-check text-success"></i> <strong>Judul:</strong> Judul buku lengkap</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Penulis:</strong> Nama penulis buku</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Tahun:</strong> Tahun terbit buku</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Kategori:</strong> Ketik nama kategori</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Stok:</strong> Jumlah eksemplar</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Rak:</strong> Lokasi penyimpanan</li>
                    <li><i class="fas fa-check text-success"></i> <strong>Sampul:</strong> Foto cover buku</li>
                </ul>
                <hr>
                <p><strong class="text-info"><i class="fas fa-info-circle"></i> Tips:</strong></p>
                <ul class="list-unstyled small">
                    <li class="mb-1"><i class="fas fa-lightbulb text-warning"></i> Kategori dibuat otomatis jika belum ada</li>
                    <li class="mb-1"><i class="fas fa-lightbulb text-warning"></i> Isi nomor rak sesuai lokasi di perpustakaan</li>
                    <li><i class="fas fa-lightbulb text-warning"></i> Sampul buku max 2MB</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    function previewBookCover(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewCover').src = e.target.result;
                document.getElementById('previewCover').style.display = 'block';
                document.getElementById('uploadPlaceholder').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
