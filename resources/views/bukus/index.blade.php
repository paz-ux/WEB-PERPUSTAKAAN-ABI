@extends('layout.master')

@section('judul', 'Buku')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 class="page-title">
                <i class="fas fa-book-open" style="color: #a855f7; margin-right: 8px;"></i>Koleksi Buku
            </h1>
            <p class="page-subtitle">Kelola perpustakaan digital dengan mudah</p>
        </div>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>
</div>

<!-- Alert Messages -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Data Table -->
<div class="card">
    <div class="card-header bg-gradient-blue-green">
        <h5 class="mb-0" style="color: white; font-weight: 700;">
            <i class="fas fa-book"></i> Koleksi Buku
        </h5>
    </div>
    <div class="card-body">
        @if ($bukus->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sampul</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Rak</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $key => $buku)
                        <tr>
                            <td>{{ $bukus->firstItem() + $key }}</td>
                            <td>
                                <div class="book-cover-thumb" style="width: 48px; height: 64px; border-radius: 8px; overflow: hidden; background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(59,130,246,0.15)); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(168,85,247,0.2); cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                    @if($buku->foto)
                                        onclick="openImageZoom('{{ asset('uploads/buku/' . $buku->foto) }}', '{{ $buku->judul }}')"
                                    @endif
                                    title="Klik untuk memperbesar">
                                    @if($buku->foto)
                                        <img src="{{ asset('uploads/buku/' . $buku->foto) }}" style="width:100%;height:100%;object-fit:cover;" alt="{{ $buku->judul }}">
                                    @else
                                        <i class="fas fa-book" style="color: #a855f7; font-size: 18px;"></i>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div style="font-weight: 700; color: #f1f5f9; font-size: 13px;">{{ $buku->judul }}</div>
                                    <div style="font-size: 11px; color: #9ca3af;">{{ $buku->tahun_terbit }}</div>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #f1f5f9; font-size: 13px;">{{ $buku->penulis }}</td>
                            <td>
                                <span style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(59,130,246,0.15); color: #93c5fd; border: 1px solid rgba(59,130,246,0.2);">
                                    {{ $buku->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>
                                @if($buku->rak_buku)
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; background: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(59,130,246,0.1)); color: #e9d5ff; border: 1px solid rgba(168,85,247,0.25);">
                                        <i class="fas fa-map-marker-alt" style="font-size: 10px;"></i> {{ $buku->rak_buku }}
                                    </span>
                                @else
                                    <span style="color: #6b7280; font-size: 12px; font-style: italic;">Belum diatur</span>
                                @endif
                            </td>
                            <td>
                                @if($buku->stok > 10)
                                    <span class="badge bg-success">{{ $buku->stok }}</span>
                                @elseif($buku->stok > 0)
                                    <span class="badge bg-warning">{{ $buku->stok }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $buku->stok }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-preview" 
                                        data-id="{{ $buku->id }}"
                                        data-tooltip="Preview Buku"
                                        style="background: linear-gradient(135deg, #06b6d4, #3b82f6); border: none; color: white; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; padding: 4px 8px;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning" data-tooltip="Edit Buku">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                        data-id="{{ $buku->id }}" 
                                        data-name="{{ $buku->judul }}"
                                        data-url="{{ route('buku.destroy', $buku->id) }}"
                                        data-tooltip="Hapus Buku">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $bukus->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-book"></i>
                <h3>Belum Ada Koleksi Buku</h3>
                <p>Perpustakaan belum memiliki koleksi buku.</p>
                <a href="{{ route('buku.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Tambah Buku
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Hidden delete forms -->
@if ($bukus->count() > 0)
@foreach ($bukus as $buku)
<form id="delete-form-{{ $buku->id }}" action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach
@endif

<!-- ==================== IMAGE ZOOM MODAL ==================== -->
<div id="imageZoomModal" style="
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.92);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    cursor: zoom-out;
    opacity: 0;
    transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1);
">
    <!-- Close button -->
    <button onclick="closeImageZoom()" style="
        position: absolute;
        top: 20px;
        right: 24px;
        z-index: 10001;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    " onmouseover="this.style.background='rgba(239,68,68,0.3)';this.style.borderColor='rgba(239,68,68,0.5)'" onmouseout="this.style.background='rgba(255,255,255,0.1)';this.style.borderColor='rgba(255,255,255,0.2)'">
        <i class="fas fa-times"></i>
    </button>

    <!-- Image container -->
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; padding: 40px;">
        <img id="zoomImage" src="" alt="" style="
            max-width: 90%;
            max-height: 80vh;
            border-radius: 16px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6), 0 0 40px rgba(147, 51, 234, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transform: scale(0.8);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            object-fit: contain;
        ">
        <p id="zoomTitle" style="
            margin-top: 20px;
            color: rgba(255,255,255,0.8);
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            letter-spacing: -0.2px;
        "></p>
    </div>
</div>

<!-- ==================== BOOK PREVIEW MODAL ==================== -->
<div id="bookPreviewModal" class="bkm-overlay">
    <button onclick="closePreview()" class="bkm-x"><i class="fas fa-times"></i></button>
    <div id="previewLoading" class="bkm-load">
        <div class="bkm-spinner"></div>
        <p>Membuka buku...</p>
    </div>
    <div id="previewData" class="bkm-stage" style="display:none;">
        <div class="bkm-book" id="bookContainer">
            <!-- Left Page -->
            <div class="bkm-page bkm-left">
                <div class="bkm-pg-inner">
                    <div id="previewCover" class="bkm-img"><i class="fas fa-book" style="color:#b91c1c;font-size:40px;"></i></div>
                    <h3 id="previewJudul" class="bkm-title"></h3>
                    <p id="previewPenulis" class="bkm-author"></p>
                    <div class="bkm-tags">
                        <span id="previewKategori" class="bkm-tag tg-r"></span>
                        <span id="previewTahun" class="bkm-tag tg-y"></span>
                    </div>
                    <div class="bkm-stats">
                        <div class="bkm-s"><div id="previewStok" class="bkm-sn sg"></div><div class="bkm-sl">Stok</div></div>
                        <div class="bkm-s"><div id="previewDipinjam" class="bkm-sn sa"></div><div class="bkm-sl">Dipinjam</div></div>
                        <div class="bkm-s"><div id="previewTotal" class="bkm-sn sr"></div><div class="bkm-sl">Total</div></div>
                    </div>
                </div>
            </div>
            <!-- Spine -->
            <div class="bkm-spine"></div>
            <!-- Right Page -->
            <div class="bkm-page bkm-right">
                <div class="bkm-pg-inner">
                    <h4 class="bkm-sect"><i class="fas fa-feather-alt"></i> Tentang Buku Ini</h4>
                    <div id="previewDeskripsiWrap" class="bkm-desc" style="display:none;"><p id="previewDeskripsi"></p></div>
                    <div id="previewNoDeskripsi" class="bkm-nodesc"><i class="fas fa-info-circle"></i> Belum ada deskripsi.</div>
                    <div class="bkm-hr"></div>
                    <h4 class="bkm-sect"><i class="fas fa-info-circle"></i> Detail Informasi</h4>
                    <div class="bkm-dl">
                        <div class="bkm-dr"><span><i class="fas fa-map-marker-alt" style="color:#b91c1c"></i> Rak</span><b id="previewRak"></b></div>
                        <div class="bkm-dr"><span><i class="fas fa-calendar" style="color:#b91c1c"></i> Tahun</span><b id="previewTahunFull"></b></div>
                        <div class="bkm-dr"><span><i class="fas fa-layer-group" style="color:#b91c1c"></i> Kategori</span><b id="previewKategoriFull"></b></div>
                    </div>
                    <div style="margin-top:auto;text-align:center;padding-top:8px;color:rgba(185,28,28,0.12);font-size:14px;"><i class="fas fa-book-open"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<style>
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes bookSpread {
        0% { transform: scaleX(0) scaleY(0.95); opacity:0; }
        50% { transform: scaleX(1.02) scaleY(1.01); opacity:1; }
        70% { transform: scaleX(0.99) scaleY(1); }
        100% { transform: scaleX(1) scaleY(1); opacity:1; }
    }
    @keyframes bookClose {
        0% { transform: scaleX(1) scaleY(1); opacity:1; }
        100% { transform: scaleX(0) scaleY(0.95); opacity:0; }
    }
    @keyframes slideUp {
        0% { opacity:0; transform:translateY(12px); }
        100% { opacity:1; transform:translateY(0); }
    }
    @keyframes slideLeft {
        0% { opacity:0; transform:translateX(-20px); }
        100% { opacity:1; transform:translateX(0); }
    }
    @keyframes slideRight {
        0% { opacity:0; transform:translateX(20px); }
        100% { opacity:1; transform:translateX(0); }
    }
    @keyframes spineGlow {
        0%,100% { box-shadow:0 0 10px rgba(185,28,28,0.2); }
        50% { box-shadow:0 0 25px rgba(185,28,28,0.5); }
    }

    .book-cover-thumb:hover { transform:scale(1.1)!important; box-shadow:0 4px 20px rgba(185,28,28,0.4)!important; }
    .btn-preview:hover { transform:translateY(-2px); box-shadow:0 4px 15px rgba(6,182,212,0.4); }
    .swal-dark-popup { border:1px solid rgba(185,28,28,0.2)!important; border-radius:20px!important; }

    /* Overlay */
    .bkm-overlay { display:none; position:fixed; inset:0; z-index:9998; background:rgba(0,0,0,0); backdrop-filter:blur(0px); transition:background 0.4s ease, backdrop-filter 0.4s ease; align-items:center; justify-content:center; }
    .bkm-overlay.active { display:flex; }
    .bkm-overlay.visible { background:rgba(0,0,0,0.85); backdrop-filter:blur(16px); }
    .bkm-x { position:absolute; top:20px; right:24px; z-index:10001; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; width:44px; height:44px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center; transition:all 0.3s; opacity:0; transform:scale(0.5) rotate(-90deg); }
    .bkm-overlay.visible .bkm-x { opacity:1; transform:scale(1) rotate(0deg); transition-delay:0.5s; }
    .bkm-x:hover { background:rgba(239,68,68,0.4); border-color:rgba(239,68,68,0.5); transform:scale(1.1) rotate(90deg)!important; }
    .bkm-load { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; z-index:10; }
    .bkm-load p { color:#fca5a5; font-size:14px; margin-top:14px; }
    .bkm-spinner { width:44px; height:44px; border:3px solid rgba(185,28,28,0.15); border-top-color:#ef4444; border-radius:50%; animation:spin 0.6s linear infinite; margin:0 auto; }

    /* Book container */
    .bkm-stage { display:flex; align-items:center; justify-content:center; width:100%; height:100%; padding:20px; }
    .bkm-book { display:flex; align-items:stretch; max-width:860px; width:100%; transform-origin:center center; animation:bookSpread 0.65s cubic-bezier(0.34,1.56,0.64,1) forwards; }
    .bkm-book.closing { animation:bookClose 0.35s cubic-bezier(0.55,0,1,0.45) forwards; }

    /* Spine */
    .bkm-spine { width:8px; flex-shrink:0; background:linear-gradient(180deg,#b91c1c,#7f1d1d,#b91c1c); border-radius:4px; z-index:5; animation:spineGlow 2s ease-in-out infinite; position:relative; }
    .bkm-spine::before { content:''; position:absolute; top:10%; bottom:10%; left:1px; right:1px; background:linear-gradient(180deg,rgba(255,255,255,0.1),transparent,rgba(255,255,255,0.1)); border-radius:2px; }

    /* Pages */
    .bkm-page { flex:1; min-height:480px; position:relative; }
    .bkm-left { background:linear-gradient(135deg,#fdfbf5,#f5f0e1); border-radius:12px 0 0 12px; border:1px solid #e5dcc8; border-right:none; box-shadow:-6px 6px 24px rgba(0,0,0,0.15), inset -4px 0 12px rgba(0,0,0,0.03); animation:slideLeft 0.5s ease 0.3s both; }
    .bkm-right { background:linear-gradient(135deg,#f8f4e8,#fdfbf5); border-radius:0 12px 12px 0; border:1px solid #e5dcc8; border-left:none; box-shadow:6px 6px 24px rgba(0,0,0,0.15), inset 4px 0 12px rgba(0,0,0,0.03); animation:slideRight 0.5s ease 0.3s both; }
    .bkm-pg-inner { padding:24px 20px; height:100%; display:flex; flex-direction:column; overflow-y:auto; }
    .bkm-pg-inner::-webkit-scrollbar { width:3px; }
    .bkm-pg-inner::-webkit-scrollbar-thumb { background:rgba(185,28,28,0.15); border-radius:3px; }

    /* Page line decorations */
    .bkm-left::before, .bkm-right::before { content:''; position:absolute; top:16px; bottom:16px; width:1px; background:linear-gradient(180deg,transparent,rgba(185,28,28,0.08),rgba(185,28,28,0.08),transparent); }
    .bkm-left::before { right:0; }
    .bkm-right::before { left:0; }

    /* Left page content */
    .bkm-img { width:100%; aspect-ratio:3/4; max-height:200px; border-radius:10px; overflow:hidden; background:#ebe4d3; display:flex; align-items:center; justify-content:center; border:1px solid #d6cdb5; margin-bottom:14px; cursor:pointer; transition:all 0.3s; box-shadow:0 4px 16px rgba(0,0,0,0.1); animation:slideUp 0.4s ease 0.5s both; }
    .bkm-img:hover { transform:scale(1.03); box-shadow:0 6px 20px rgba(0,0,0,0.15); }
    .bkm-img img { width:100%; height:100%; object-fit:contain; background:#fff; }
    .bkm-title { color:#1a1a1a; font-size:20px; font-weight:800; margin-bottom:4px; line-height:1.3; animation:slideUp 0.4s ease 0.6s both; }
    .bkm-author { color:#6b4c3b; font-size:14px; font-weight:500; margin-bottom:10px; animation:slideUp 0.4s ease 0.65s both; }
    .bkm-tags { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:14px; animation:slideUp 0.4s ease 0.7s both; }
    .bkm-tag { display:inline-flex; align-items:center; gap:3px; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600; }
    .tg-r { background:rgba(185,28,28,0.08); color:#991b1b; border:1px solid rgba(185,28,28,0.15); }
    .tg-y { background:rgba(146,64,14,0.08); color:#92400e; border:1px solid rgba(146,64,14,0.15); }
    .bkm-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:6px; margin-top:auto; animation:slideUp 0.4s ease 0.75s both; }
    .bkm-s { border-radius:8px; padding:8px 4px; text-align:center; background:rgba(0,0,0,0.025); border:1px solid rgba(0,0,0,0.05); transition:all 0.2s; }
    .bkm-s:hover { background:rgba(185,28,28,0.04); border-color:rgba(185,28,28,0.12); transform:translateY(-1px); }
    .bkm-sn { font-size:22px; font-weight:800; }
    .sg { color:#15803d; } .sa { color:#b45309; } .sr { color:#b91c1c; }
    .bkm-sl { font-size:10px; color:#78716c; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; }

    /* Right page content */
    .bkm-sect { font-weight:700; color:#7f1d1d; font-size:14px; text-transform:uppercase; letter-spacing:1px; margin-bottom:10px; display:flex; align-items:center; gap:6px; animation:slideUp 0.4s ease 0.5s both; }
    .bkm-sect i { font-size:13px; color:#b91c1c; }
    .bkm-desc { background:rgba(185,28,28,0.03); border:1px solid rgba(185,28,28,0.08); border-radius:8px; padding:12px; margin-bottom:12px; animation:slideUp 0.4s ease 0.6s both; }
    .bkm-desc p { color:#44403c; font-size:14px; line-height:1.8; margin:0; white-space:pre-line; }
    .bkm-nodesc { color:#a8a29e; font-size:13px; font-style:italic; display:flex; align-items:center; gap:6px; margin-bottom:12px; padding:10px; background:rgba(0,0,0,0.015); border-radius:8px; border:1px dashed #d6d3d1; animation:slideUp 0.4s ease 0.6s both; }
    .bkm-hr { height:1px; margin:4px 0 10px; background:linear-gradient(90deg,transparent,#d6cdb5,transparent); }
    .bkm-dl { display:flex; flex-direction:column; animation:slideUp 0.4s ease 0.7s both; }
    .bkm-dr { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(0,0,0,0.04); font-size:14px; color:#57534e; transition:all 0.2s; }
    .bkm-dr:hover { padding-left:4px; color:#292524; }
    .bkm-dr:last-child { border-bottom:none; }
    .bkm-dr i { margin-right:5px; font-size:12px; }
    .bkm-dr b { font-weight:700; color:#292524; }

    @media (max-width:768px) {
        .bkm-book { flex-direction:column; max-width:400px; }
        .bkm-left { border-radius:12px 12px 0 0; border-right:1px solid #e5dcc8; border-bottom:none; min-height:auto; }
        .bkm-right { border-radius:0 0 12px 12px; border-left:1px solid #e5dcc8; border-top:none; min-height:auto; }
        .bkm-spine { width:auto; height:6px; border-radius:3px; }
        .bkm-page { min-height:320px; }
        .bkm-left::before, .bkm-right::before { display:none; }
    }
</style>

<script>
    function openImageZoom(src, title) {
        const m = document.getElementById('imageZoomModal'), i = document.getElementById('zoomImage'), t = document.getElementById('zoomTitle');
        i.src = src; i.alt = title; t.textContent = title;
        m.style.display = 'block'; m.offsetHeight; m.style.opacity = '1'; i.style.transform = 'scale(1)';
    }
    function closeImageZoom() {
        const m = document.getElementById('imageZoomModal'), i = document.getElementById('zoomImage');
        m.style.opacity = '0'; i.style.transform = 'scale(0.8)';
        setTimeout(() => { m.style.display = 'none'; }, 350);
    }
    document.getElementById('imageZoomModal').addEventListener('click', function(e) {
        if (e.target === this) closeImageZoom();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeImageZoom(); closePreview(); }
    });

    function openPreview(id) {
        const modal = document.getElementById('bookPreviewModal');
        const ld = document.getElementById('previewLoading');
        const dt = document.getElementById('previewData');
        ld.style.display = 'block'; dt.style.display = 'none';
        modal.classList.add('active');
        requestAnimationFrame(() => modal.classList.add('visible'));

        fetch(`/perpustakaan/buku/${id}`, { headers: { 'Accept':'application/json', 'X-Requested-With':'XMLHttpRequest' } })
        .then(r => r.json())
        .then(b => {
            document.getElementById('previewJudul').textContent = b.judul;
            document.getElementById('previewPenulis').innerHTML = '<i class="fas fa-pen-fancy" style="margin-right:5px;font-size:10px;"></i>' + b.penulis;
            document.getElementById('previewKategori').innerHTML = '<i class="fas fa-bookmark" style="font-size:8px;"></i> ' + b.kategori;
            document.getElementById('previewTahun').innerHTML = '<i class="fas fa-calendar-alt" style="font-size:8px;"></i> ' + b.tahun_terbit;
            document.getElementById('previewStok').textContent = b.stok;
            document.getElementById('previewDipinjam').textContent = b.sedang_dipinjam;
            document.getElementById('previewTotal').textContent = b.total_peminjaman;
            document.getElementById('previewRak').textContent = b.rak_buku;
            document.getElementById('previewTahunFull').textContent = b.tahun_terbit;
            document.getElementById('previewKategoriFull').textContent = b.kategori;

            const dW = document.getElementById('previewDeskripsiWrap'), nD = document.getElementById('previewNoDeskripsi');
            if (b.deskripsi && b.deskripsi.trim()) {
                document.getElementById('previewDeskripsi').textContent = b.deskripsi;
                dW.style.display = 'block'; nD.style.display = 'none';
            } else { dW.style.display = 'none'; nD.style.display = 'flex'; }

            const cv = document.getElementById('previewCover');
            if (b.foto) {
                cv.innerHTML = `<img src="${b.foto}" alt="${b.judul}">`;
                cv.onclick = () => openImageZoom(b.foto, b.judul);
                cv.style.cursor = 'pointer';
            } else {
                cv.innerHTML = '<i class="fas fa-book" style="color:#b91c1c;font-size:40px;"></i>';
                cv.onclick = null; cv.style.cursor = 'default';
            }

            ld.style.display = 'none'; dt.style.display = 'flex';
            const bc = document.getElementById('bookContainer');
            bc.classList.remove('closing');
            bc.style.animation = 'none'; bc.offsetHeight; bc.style.animation = '';
        })
        .catch(() => {
            ld.innerHTML = '<i class="fas fa-exclamation-triangle" style="font-size:36px;color:#f87171;margin-bottom:10px;"></i><p style="color:#fca5a5;font-size:13px;">Gagal memuat data</p><button onclick="closePreview()" style="margin-top:10px;padding:7px 18px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:white;border-radius:8px;cursor:pointer;">Tutup</button>';
        });
    }

    function closePreview() {
        const modal = document.getElementById('bookPreviewModal');
        const bc = document.getElementById('bookContainer');
        if (bc) bc.classList.add('closing');
        setTimeout(() => {
            modal.classList.remove('visible');
            setTimeout(() => { modal.classList.remove('active'); if (bc) bc.classList.remove('closing'); }, 400);
        }, 300);
    }

    document.getElementById('bookPreviewModal').addEventListener('click', function(e) { if (e.target === this) closePreview(); });
    document.querySelectorAll('.btn-preview').forEach(b => b.addEventListener('click', function() { openPreview(this.dataset.id); }));
    document.querySelectorAll('.btn-delete').forEach(b => {
        b.addEventListener('click', function() {
            const id = this.dataset.id, nm = this.dataset.name;
            Swal.fire({ title:'Hapus Buku?', html:`Apakah kamu yakin ingin menghapus buku <strong>"${nm}"</strong>?<br><small style="color:#f87171;">Data yang dihapus tidak bisa dikembalikan!</small>`, icon:'warning', showCancelButton:true, confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280', confirmButtonText:'<i class="fas fa-trash"></i> Ya, Hapus!', cancelButtonText:'Batal', background:'#1a1a2e', color:'#e2e8f0', customClass:{popup:'swal-dark-popup'} }).then(r => { if (r.isConfirmed) document.getElementById('delete-form-'+id).submit(); });
        });
    });
</script>
@endsection


