@extends('layout.master')

@section('judul', 'Cari Rak Buku')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fas fa-search-location" style="color: #a855f7; margin-right: 8px;"></i>Cari Rak Buku
        </h1>
        <p class="page-subtitle">Temukan lokasi rak buku dengan cepat</p>
    </div>
</div>

<!-- Search Widget -->
<div class="card mb-4" style="border: 1px solid rgba(168,85,247,0.2);">
    <div class="card-body" style="padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(59,130,246,0.15)); border-radius: 50%; margin-bottom: 16px; border: 1px solid rgba(168,85,247,0.2);">
                <i class="fas fa-search" style="font-size: 24px; color: #a855f7;"></i>
            </div>
            <h3 style="font-weight: 800; color: #f1f5f9; font-size: 20px; margin-bottom: 6px;">Cari Buku</h3>
            <p style="color: #9ca3af; font-size: 14px;">Ketik judul buku, penulis, atau nomor rak untuk menemukan lokasi buku</p>
        </div>

        <div style="max-width: 600px; margin: 0 auto; position: relative;">
            <div style="position: relative;">
                <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: rgba(168,85,247,0.4); font-size: 18px; z-index: 2;"></i>
                <input type="text" id="searchRakInput" class="form-control" 
                    placeholder="Ketik judul buku, penulis, atau rak..."
                    style="padding-left: 50px; padding-right: 20px; height: 56px; border-radius: 16px; font-size: 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(168,85,247,0.3); color: #f1f5f9;"
                    autocomplete="off">
                <div id="searchSpinner" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); display: none;">
                    <i class="fas fa-spinner fa-spin" style="color: #a855f7;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Results -->
<div id="searchResults" style="display: none;">
    <div class="card">
        <div class="card-header bg-gradient-blue-green">
            <h5 class="mb-0" style="color: white; font-weight: 700;">
                <i class="fas fa-map-marked-alt"></i> Hasil Pencarian
                <span id="resultCount" style="font-size: 13px; font-weight: 500; opacity: 0.8;"></span>
            </h5>
        </div>
        <div class="card-body" id="resultsContainer">
            <!-- Results will be rendered here -->
        </div>
    </div>
</div>

<!-- No Results -->
<div id="noResults" style="display: none;">
    <div class="empty-state">
        <i class="fas fa-search"></i>
        <h3>Buku tidak ditemukan</h3>
        <p>Coba cari dengan kata kunci yang berbeda</p>
    </div>
</div>

<!-- Rak Buku Shelves -->
<div id="rakBukuShelves">
    @if(isset($bukusByRak) && $bukusByRak->count() > 0)
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div>
                <h3 style="font-weight: 800; color: #f1f5f9; font-size: 22px; margin: 0;">
                    <i class="fas fa-layer-group" style="color: #a855f7; margin-right: 8px;"></i>Semua Rak Buku
                </h3>
                <p style="color: #9ca3af; font-size: 13px; margin: 4px 0 0 0;">
                    {{ $bukusByRak->count() }} rak • {{ $bukusByRak->flatten()->count() }} buku tersedia
                </p>
            </div>
        </div>

        @foreach($bukusByRak as $rakNumber => $bukus)
        <div class="card mb-4" style="border: 1px solid rgba(168,85,247,0.15); overflow: hidden;">
            <!-- Rak Header -->
            <div style="padding: 18px 24px; background: linear-gradient(135deg, rgba(124,58,237,0.12), rgba(59,130,246,0.08)); border-bottom: 1px solid rgba(168,85,247,0.15); display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7c3aed, #3b82f6); border-radius: 14px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(124,58,237,0.3);">
                        <span style="font-size: 20px; font-weight: 900; color: white;">{{ $rakNumber }}</span>
                    </div>
                    <div>
                        <h5 style="font-weight: 800; color: #f1f5f9; margin: 0; font-size: 17px;">Rak {{ $rakNumber }}</h5>
                        <p style="font-size: 12px; color: #9ca3af; margin: 2px 0 0 0;">{{ $bukus->count() }} buku tersimpan</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; background: rgba(168,85,247,0.15); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.25);">
                        <i class="fas fa-book" style="margin-right: 4px;"></i>{{ $bukus->count() }}
                    </span>
                </div>
            </div>

            <!-- Buku List in Rak -->
            <div class="card-body" style="padding: 16px;">
                <div class="row g-3">
                    @foreach($bukus as $buku)
                    <div class="col-md-6 col-lg-4">
                        <div style="display: flex; align-items: center; gap: 12px; padding: 14px; background: rgba(255,255,255,0.03); border-radius: 14px; border: 1px solid rgba(255,255,255,0.06); transition: all 0.3s ease; cursor: default;"
                             onmouseover="this.style.background='rgba(168,85,247,0.08)'; this.style.borderColor='rgba(168,85,247,0.2)'; this.style.transform='translateY(-2px)';"
                             onmouseout="this.style.background='rgba(255,255,255,0.03)'; this.style.borderColor='rgba(255,255,255,0.06)'; this.style.transform='translateY(0)';">
                            <!-- Book Cover -->
                            <div style="flex-shrink: 0; width: 50px; height: 68px; border-radius: 10px; overflow: hidden; background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(59,130,246,0.15)); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(168,85,247,0.2);">
                                @if($buku->foto)
                                    <img src="{{ asset('uploads/buku/' . $buku->foto) }}" style="width:100%;height:100%;object-fit:cover;" alt="{{ $buku->judul }}">
                                @else
                                    <i class="fas fa-book" style="color: #a855f7; font-size: 18px;"></i>
                                @endif
                            </div>
                            <!-- Book Info -->
                            <div style="flex: 1; min-width: 0;">
                                <h6 style="font-weight: 700; color: #f1f5f9; margin-bottom: 3px; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $buku->judul }}</h6>
                                <p style="font-size: 11px; color: #9ca3af; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <i class="fas fa-pen-fancy" style="margin-right: 3px; font-size: 9px;"></i>{{ $buku->penulis }}
                                </p>
                                <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                    <span style="display: inline-flex; align-items: center; gap: 3px; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; background: rgba(59,130,246,0.12); color: #93c5fd; border: 1px solid rgba(59,130,246,0.2);">
                                        {{ $buku->kategori->nama_kategori ?? '-' }}
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 3px; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; background: rgba(34,197,94,0.12); color: #86efac; border: 1px solid rgba(34,197,94,0.2);">
                                        <i class="fas fa-layer-group" style="font-size: 8px;"></i> {{ $buku->stok }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="card" style="text-align: center; padding: 48px 24px;">
            <div style="width: 72px; height: 72px; background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(59,130,246,0.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <i class="fas fa-book-open" style="color: #a855f7; font-size: 28px;"></i>
            </div>
            <h5 style="font-weight: 700; color: #f1f5f9; margin-bottom: 6px;">Belum Ada Rak Buku</h5>
            <p style="color: #9ca3af; font-size: 14px; max-width: 400px; margin: 0 auto;">Tambahkan nomor rak pada data buku agar muncul di sini</p>
        </div>
    @endif
</div>

@endsection

@section('extra_js')
<script>
    const searchInput = document.getElementById('searchRakInput');
    const searchResults = document.getElementById('searchResults');
    const noResults = document.getElementById('noResults');
    const rakBukuShelves = document.getElementById('rakBukuShelves');
    const resultsContainer = document.getElementById('resultsContainer');
    const resultCount = document.getElementById('resultCount');
    const searchSpinner = document.getElementById('searchSpinner');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 1) {
            searchResults.style.display = 'none';
            noResults.style.display = 'none';
            rakBukuShelves.style.display = 'block';
            return;
        }

        searchSpinner.style.display = 'block';
        rakBukuShelves.style.display = 'none';

        searchTimeout = setTimeout(() => {
            fetch(`{{ url('/api/search-buku') }}?q=${encodeURIComponent(query)}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                searchSpinner.style.display = 'none';

                if (data.length === 0) {
                    searchResults.style.display = 'none';
                    noResults.style.display = 'block';
                    return;
                }

                noResults.style.display = 'none';
                searchResults.style.display = 'block';
                resultCount.textContent = `(${data.length} hasil)`;

                resultsContainer.innerHTML = data.map(buku => `
                    <div style="display: flex; align-items: center; gap: 16px; padding: 16px; margin-bottom: 8px; background: rgba(255,255,255,0.03); border-radius: 14px; border: 1px solid rgba(255,255,255,0.06); transition: all 0.3s ease;">
                        <div style="flex-shrink: 0; width: 60px; height: 80px; border-radius: 10px; overflow: hidden; background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(59,130,246,0.15)); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(168,85,247,0.2);">
                            ${buku.foto 
                                ? `<img src="${buku.foto}" style="width:100%;height:100%;object-fit:cover;" alt="${buku.judul}">` 
                                : `<i class="fas fa-book" style="color: #a855f7; font-size: 20px;"></i>`
                            }
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <h6 style="font-weight: 700; color: #f1f5f9; margin-bottom: 4px; font-size: 15px;">${buku.judul}</h6>
                            <p style="font-size: 12px; color: #9ca3af; margin-bottom: 6px;">
                                <i class="fas fa-pen-fancy" style="margin-right: 4px;"></i>${buku.penulis} • 
                                <span style="color: #93c5fd;">${buku.kategori}</span>
                            </p>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(168,85,247,0.15); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.2);">
                                    <i class="fas fa-map-marker-alt"></i> Stok: ${buku.stok}
                                </span>
                            </div>
                        </div>
                        <div style="flex-shrink: 0; text-align: center; padding: 12px 20px; background: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(59,130,246,0.1)); border-radius: 14px; border: 1px solid rgba(168,85,247,0.2);">
                            <div style="font-size: 10px; font-weight: 600; color: #a78bfa; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Rak Buku</div>
                            <div style="font-size: 20px; font-weight: 900; color: #e9d5ff;">${buku.rak_buku}</div>
                        </div>
                    </div>
                `).join('');
            })
            .catch(err => {
                searchSpinner.style.display = 'none';
                console.error('Search error:', err);
            });
        }, 300);
    });

    // Auto focus
    searchInput.focus();
</script>
@endsection
