@extends('layout.master')

@section('judul', 'Edit Buku')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-edit" style="color: #a855f7; margin-right: 8px;"></i>Edit Data Buku
            </h1>
            <p class="page-subtitle">Ubah informasi buku</p>
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
                    <i class="fas fa-edit"></i> Form Edit Buku
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

                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">
                            <i class="fas fa-book" style="color: #a855f7;"></i> Judul Buku <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                            id="judul" name="judul" placeholder="Masukkan judul buku" 
                            value="{{ old('judul', $buku->judul) }}" required>
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
                            value="{{ old('penulis', $buku->penulis) }}" required>
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
                                    id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit" 
                                    value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') + 1 }}" required>
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
                                    id="kategori_nama" name="kategori_nama" placeholder="Ketik nama kategori" 
                                    value="{{ old('kategori_nama', $buku->kategori->nama_kategori ?? '') }}" required>
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
                                    id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required>
                                @error('stok')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div style="margin-top: 8px; padding: 8px 12px; background: rgba(168,85,247,0.1); border-radius: 8px; border: 1px solid rgba(168,85,247,0.15);">
                                    <small style="color: #d8b4fe;">
                                        <i class="fas fa-boxes"></i> Stok saat ini: <strong style="color: #e9d5ff;">{{ $buku->stok }} eksemplar</strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rak_buku" class="form-label">
                                    <i class="fas fa-map-marker-alt" style="color: #a855f7;"></i> Rak Buku
                                </label>
                                <input type="number" class="form-control @error('rak_buku') is-invalid @enderror" 
                                    id="rak_buku" name="rak_buku" placeholder="Contoh: 1, 2, 3" 
                                    value="{{ old('rak_buku', $buku->rak_buku) }}" min="1">
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
                            style="resize: vertical; min-height: 100px;">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
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
                            
                            @if($buku->foto)
                                <div id="uploadPlaceholder" style="display: none;">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 36px; color: #a855f7; margin-bottom: 8px;"></i>
                                    <p style="font-weight: 600; color: #d1d5db; margin-bottom: 4px;">Klik untuk ganti sampul buku</p>
                                    <small style="color: #6b7280;">JPG, PNG, GIF, WebP (Max 2MB)</small>
                                </div>
                                <img id="previewCover" src="{{ asset('uploads/buku/' . $buku->foto) }}" alt="Sampul" style="max-height: 200px; border-radius: 10px;">
                                <p style="margin-top: 8px; font-size: 12px; color: #9ca3af;">Klik untuk mengganti</p>
                            @else
                                <div id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 36px; color: #a855f7; margin-bottom: 8px;"></i>
                                    <p style="font-weight: 600; color: #d1d5db; margin-bottom: 4px;">Klik untuk upload sampul buku</p>
                                    <small style="color: #6b7280;">JPG, PNG, GIF, WebP (Max 2MB)</small>
                                </div>
                                <img id="previewCover" src="" alt="Preview" style="max-height: 200px; border-radius: 10px; display: none;">
                            @endif
                        </div>
                        @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui Data
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
                    <i class="fas fa-info-circle"></i> Info Buku
                </h5>
            </div>
            <div class="card-body">
                @if($buku->foto)
                <div style="text-align: center; margin-bottom: 16px;">
                    <img src="{{ asset('uploads/buku/' . $buku->foto) }}" alt="Sampul" style="max-height: 150px; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.3);">
                </div>
                @endif
                <ul class="list-unstyled">
                    <li><i class="fas fa-book text-primary"></i> <strong>Judul:</strong> {{ $buku->judul }}</li>
                    <li><i class="fas fa-pen-fancy text-primary"></i> <strong>Penulis:</strong> {{ $buku->penulis }}</li>
                    <li><i class="fas fa-calendar text-primary"></i> <strong>Tahun:</strong> {{ $buku->tahun_terbit }}</li>
                    <li><i class="fas fa-list text-primary"></i> <strong>Kategori:</strong> {{ $buku->kategori->nama_kategori ?? '-' }}</li>
                    <li><i class="fas fa-boxes text-primary"></i> <strong>Stok:</strong> {{ $buku->stok }}</li>
                    <li><i class="fas fa-map-marker-alt text-primary"></i> <strong>Rak:</strong> {{ $buku->rak_buku ?? 'Belum diatur' }}</li>
                </ul>
                <hr>
                <p class="text-muted small">
                    <i class="fas fa-clock"></i> 
                    Diperbarui: {{ $buku->updated_at->format('d M Y H:i') }}
                </p>
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
                const placeholder = document.getElementById('uploadPlaceholder');
                if (placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
