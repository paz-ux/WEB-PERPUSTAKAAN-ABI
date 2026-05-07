@extends('layout.master')

@section('judul', 'Pengaturan Denda')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-cog" style="color: #a855f7; margin-right: 8px;"></i>Pengaturan Sistem
            </h1>
            <p class="page-subtitle">Konfigurasi nominal denda keterlambatan</p>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-money-bill-wave"></i> Pengaturan Denda Keterlambatan
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

                <form action="{{ route('settings.update') }}" method="POST" id="settingsForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="denda_per_hari" class="form-label">
                            <i class="fas fa-coins" style="color: #f59e0b;"></i> Nominal Denda Per Hari <span class="text-danger">*</span>
                        </label>
                        <div style="position: relative;">
                            <span style="
                                position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
                                color: #a78bfa; font-weight: 700; font-size: 14px; z-index: 2;
                            ">Rp</span>
                            <input type="number" 
                                class="form-control @error('denda_per_hari') is-invalid @enderror" 
                                id="denda_per_hari" 
                                name="denda_per_hari" 
                                value="{{ old('denda_per_hari', $dendaPerHari) }}" 
                                min="0" 
                                max="1000000"
                                required
                                style="padding-left: 48px; font-size: 18px; font-weight: 700; letter-spacing: 0.5px;">
                        </div>
                        @error('denda_per_hari')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text d-block mt-2">
                            Masukkan nominal denda dalam Rupiah. Denda akan dihitung <strong>per hari</strong> keterlambatan dari batas kembali.
                        </small>
                    </div>

                    <!-- Preview calculation -->
                    <div id="previewCalc" style="
                        padding: 20px; 
                        background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(239,68,68,0.06)); 
                        border: 1px solid rgba(245,158,11,0.2); 
                        border-radius: 14px; 
                        margin-bottom: 20px;
                    ">
                        <h6 style="font-weight: 700; color: #fcd34d; margin-bottom: 14px; font-size: 13px;">
                            <i class="fas fa-calculator"></i> Simulasi Perhitungan Denda
                        </h6>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <div style="
                                padding: 12px; background: rgba(255,255,255,0.04); 
                                border-radius: 10px; border: 1px solid rgba(255,255,255,0.06);
                            ">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 4px;">Terlambat 1 hari</div>
                                <div id="calc1" style="font-size: 16px; font-weight: 800; color: #fcd34d;"></div>
                            </div>
                            <div style="
                                padding: 12px; background: rgba(255,255,255,0.04); 
                                border-radius: 10px; border: 1px solid rgba(255,255,255,0.06);
                            ">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 4px;">Terlambat 3 hari</div>
                                <div id="calc3" style="font-size: 16px; font-weight: 800; color: #f59e0b;"></div>
                            </div>
                            <div style="
                                padding: 12px; background: rgba(255,255,255,0.04); 
                                border-radius: 10px; border: 1px solid rgba(255,255,255,0.06);
                            ">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 4px;">Terlambat 7 hari</div>
                                <div id="calc7" style="font-size: 16px; font-weight: 800; color: #f87171;"></div>
                            </div>
                            <div style="
                                padding: 12px; background: rgba(255,255,255,0.04); 
                                border-radius: 10px; border: 1px solid rgba(255,255,255,0.06);
                            ">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 4px;">Terlambat 14 hari</div>
                                <div id="calc14" style="font-size: 16px; font-weight: 800; color: #ef4444;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnSave">
                            <i class="fas fa-save"></i> Simpan Pengaturan
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('denda_per_hari').value='10000'; updateCalc();">
                            <i class="fas fa-undo"></i> Reset ke Default
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-gradient-blue-green">
                <h5 class="mb-0" style="color: white; font-weight: 700;">
                    <i class="fas fa-info-circle"></i> Panduan
                </h5>
            </div>
            <div class="card-body">
                <div style="padding: 16px; background: rgba(59,130,246,0.08); border-radius: 14px; border: 1px solid rgba(59,130,246,0.2); margin-bottom: 16px;">
                    <h6 style="font-weight: 700; color: #93c5fd; font-size: 13px; margin-bottom: 10px;">
                        <i class="fas fa-question-circle"></i> Bagaimana denda dihitung?
                    </h6>
                    <ul style="padding-left: 16px; font-size: 12px; margin: 0; color: #d1d5db;">
                        <li class="mb-2">Batas kembali buku = <strong>4 hari</strong> setelah tanggal pinjam</li>
                        <li class="mb-2">Jika buku dikembalikan <strong>setelah batas kembali</strong>, denda akan dihitung otomatis</li>
                        <li class="mb-2"><strong>Rumus:</strong> Jumlah hari terlambat × Nominal denda per hari</li>
                        <li>Jika tepat waktu = <strong>Rp 0</strong> (tidak ada denda)</li>
                    </ul>
                </div>

                <div style="padding: 16px; background: rgba(245,158,11,0.08); border-radius: 14px; border: 1px solid rgba(245,158,11,0.2); margin-bottom: 16px;">
                    <h6 style="font-weight: 700; color: #fcd34d; font-size: 13px; margin-bottom: 10px;">
                        <i class="fas fa-exclamation-triangle"></i> Perhatian
                    </h6>
                    <ul style="padding-left: 16px; font-size: 12px; margin: 0; color: #d1d5db;">
                        <li class="mb-2">Perubahan nominal denda <strong>hanya berlaku untuk pengembalian baru</strong></li>
                        <li>Denda yang sudah tercatat <strong>tidak akan berubah</strong></li>
                    </ul>
                </div>

                <!-- Current setting display -->
                <div style="padding: 16px; background: linear-gradient(135deg, rgba(124,58,237,0.1), rgba(59,130,246,0.08)); border-radius: 14px; border: 1px solid rgba(147,51,234,0.2);">
                    <div style="font-size: 11px; color: #a78bfa; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                        Denda Saat Ini
                    </div>
                    <div style="font-size: 28px; font-weight: 900; color: #e9d5ff; letter-spacing: -0.5px;">
                        Rp {{ number_format($dendaPerHari, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 12px; color: #9ca3af; margin-top: 4px;">per hari keterlambatan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    const input = document.getElementById('denda_per_hari');

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateCalc() {
        const val = parseInt(input.value) || 0;
        document.getElementById('calc1').textContent = formatRupiah(val * 1);
        document.getElementById('calc3').textContent = formatRupiah(val * 3);
        document.getElementById('calc7').textContent = formatRupiah(val * 7);
        document.getElementById('calc14').textContent = formatRupiah(val * 14);
    }

    input.addEventListener('input', updateCalc);
    updateCalc();

    // SweetAlert confirmation before save
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const val = parseInt(input.value) || 0;

        Swal.fire({
            title: 'Simpan Pengaturan?',
            html: `Nominal denda akan diubah menjadi:<br><strong style="font-size: 20px; color: #fcd34d;">Rp ${val.toLocaleString('id-ID')}/hari</strong><br><small style="color: #9ca3af;">Perubahan berlaku untuk pengembalian baru</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7c3aed',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-save"></i> Ya, Simpan!',
            cancelButtonText: 'Batal',
            background: '#1a1a2e',
            color: '#e2e8f0',
            customClass: { popup: 'swal-dark-popup' }
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
</script>
<style>.swal-dark-popup { border: 1px solid rgba(147,51,234,0.2) !important; border-radius: 20px !important; }</style>
@endsection
