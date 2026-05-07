@extends('layout.master')

@section('page_title', 'Edit Kategori')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-edit" style="color: #a855f7; margin-right: 8px;"></i>Edit Kategori
            </h1>
            <p class="page-subtitle">Ubah informasi kategori buku</p>
        </div>
        <a href="{{ url('/perpustakaan/kategori') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-layer-group"></i> Form Edit Kategori
                </h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            <i class="fas fa-tag" style="color: #a855f7;"></i> Nama Kategori
                        </label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama kategori" value="Teknologi">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">
                            <i class="fas fa-align-left" style="color: #a855f7;"></i> Deskripsi
                        </label>
                        <textarea class="form-control" id="deskripsi" rows="4" placeholder="Deskripsi kategori">Buku-buku tentang teknologi dan programming</textarea>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ url('/perpustakaan/kategori') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
