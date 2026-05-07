<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'bukus';
    
    protected $fillable = [
        'judul',
        'penulis',
        'tahun_terbit',
        'kategori_id',
        'stok',
        'rak_buku',
        'foto',
        'deskripsi',
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
