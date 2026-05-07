@extends('layout.master')

@section('judul', 'Edit Peminjaman')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-edit" style="color: #a855f7; margin-right: 8px;"></i>Edit Data Peminjaman
            </h1>
            <p class="page-subtitle">Ubah informasi peminjaman atau kembalikan buku</p>
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
                    <i class="fas fa-edit"></i> Form Edit Peminjaman
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

                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="siswa_id" class="form-label">
                            <i class="fas fa-user-graduate" style="color: #a855f7;"></i> Siswa <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('siswa_id') is-invalid @enderror" id="siswa_id" name="siswa_id" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id', $peminjaman->siswa_id) == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label">
                            <i class="fas fa-book" style="color: #a855f7;"></i> Buku <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id }}" {{ old('buku_id', $peminjaman->buku_id) == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->judul }} (Stok: {{ $buku->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">
                            <i class="fas fa-user-tie" style="color: #a855f7;"></i> Petugas <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $peminjaman->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">
                            <i class="fas fa-calendar-alt" style="color: #a855f7;"></i> Tanggal Pinjam <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                            id="tanggal_pinjam" name="tanggal_pinjam"
                            value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam->format('Y-m-d')) }}" required>
                        @error('tanggal_pinjam')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info Tanggal -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-calendar-times" style="color: #f59e0b;"></i> Batas Kembali
                            </label>
                            <div style="padding: 10px 14px; background: rgba(245,158,11,0.1); border-radius: 10px; border: 1px solid rgba(245,158,11,0.2); color: #fcd34d; font-weight: 600;">
                                <i class="fas fa-clock"></i> 
                                {{ $peminjaman->batas_kembali ? $peminjaman->batas_kembali->format('d M Y') : 'Akan dihitung otomatis' }}
                                <br><small style="color: #d1d5db; font-weight: 400;">Otomatis 4 hari setelah tanggal pinjam</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_kembali" class="form-label">
                                <i class="fas fa-calendar-check" style="color: #22c55e;"></i> Tanggal Dikembalikan
                            </label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                                id="tanggal_kembali" name="tanggal_kembali"
                                value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('Y-m-d') : '') }}">
                            @error('tanggal_kembali')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text d-block mt-1">Isi tanggal saat buku dikembalikan</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">
                            <i class="fas fa-info-circle" style="color: #a855f7;"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Auto Denda Info -->
                    <div id="dendaInfo" style="padding: 16px; background: rgba(239,68,68,0.08); border-radius: 14px; border: 1px solid rgba(239,68,68,0.2); margin-bottom: 16px; {{ $peminjaman->status == 'dikembalikan' ? '' : 'display:none;' }}">
                        <h6 style="font-weight: 700; color: #fca5a5; margin-bottom: 8px;">
                            <i class="fas fa-money-bill-wave"></i> Informasi Denda
                        </h6>
                        @if($peminjaman->status == 'dikembalikan' && $peminjaman->denda > 0)
                            <p style="color: #fca5a5; font-size: 14px; margin: 0;">
                                Denda keterlambatan: <strong style="font-size: 18px;">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</strong>
                            </p>
                        @elseif($peminjaman->status == 'dikembalikan')
                            <p style="color: #86efac; font-size: 14px; margin: 0;">
                                <i class="fas fa-check-circle"></i> Buku dikembalikan tepat waktu. <strong>Tidak ada denda.</strong>
                            </p>
                        @else
                            <p style="color: #d1d5db; font-size: 13px; margin: 0;">
                                <i class="fas fa-info-circle"></i> Denda otomatis dihitung saat status diubah ke "Dikembalikan".<br>
                                <strong>Tarif: Rp {{ number_format($dendaPerHari, 0, ',', '.') }}/hari</strong> keterlambatan dari batas kembali.
                            </p>
                        @endif
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui Data
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
                <p><strong>Cara mengembalikan buku:</strong></p>
                <ol style="padding-left: 18px; font-size: 14px;">
                    <li class="mb-2">Ubah <strong>Status</strong> ke <strong>"Dikembalikan"</strong></li>
                    <li class="mb-2">Klik <strong>Perbarui Data</strong></li>
                    <li class="mb-2">Tanggal kembali & denda <strong>otomatis</strong></li>
                </ol>
                <hr>
                <div style="padding: 12px; background: rgba(245,158,11,0.1); border-radius: 10px; border: 1px solid rgba(245,158,11,0.2);">
                    <p class="mb-1" style="font-weight: 700; color: #fcd34d; font-size: 13px;">
                        <i class="fas fa-calculator"></i> Perhitungan Denda:
                    </p>
                    <ul style="padding-left: 16px; font-size: 12px; margin: 0; color: #d1d5db;">
                        <li>Batas kembali: <strong>4 hari</strong> setelah pinjam</li>
                        <li>Tarif: <strong>Rp {{ number_format($dendaPerHari, 0, ',', '.') }}/hari</strong> terlambat</li>
                        <li>Denda = 0 jika tepat waktu</li>
                    </ul>
                </div>
                <hr>

                <!-- Info Timeline -->
                <div style="padding: 12px; background: rgba(59,130,246,0.1); border-radius: 10px; border: 1px solid rgba(59,130,246,0.2);">
                    <p class="mb-2" style="font-weight: 700; color: #93c5fd; font-size: 13px;">
                        <i class="fas fa-list-ol"></i> Timeline:
                    </p>
                    <div style="font-size: 12px; color: #d1d5db;">
                        <div class="mb-1"><i class="fas fa-circle" style="color: #93c5fd; font-size: 6px;"></i> <strong>Tgl Pinjam:</strong> {{ $peminjaman->tanggal_pinjam->format('d M Y') }}</div>
                        <div class="mb-1"><i class="fas fa-circle" style="color: #fcd34d; font-size: 6px;"></i> <strong>Batas Kembali:</strong> {{ $peminjaman->batas_kembali ? $peminjaman->batas_kembali->format('d M Y') : '-' }}</div>
                        <div><i class="fas fa-circle" style="color: {{ $peminjaman->tanggal_kembali ? '#86efac' : '#9ca3af' }}; font-size: 6px;"></i> <strong>Dikembalikan:</strong> {{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d M Y') : 'Belum' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    document.getElementById('status').addEventListener('change', function() {
        document.getElementById('dendaInfo').style.display = this.value === 'dikembalikan' ? 'block' : 'none';
    });
</script>
@endsection
