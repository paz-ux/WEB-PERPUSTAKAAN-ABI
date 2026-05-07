<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    
    protected $fillable = [
        'siswa_id',
        'buku_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'batas_kembali',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'batas_kembali' => 'date',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
