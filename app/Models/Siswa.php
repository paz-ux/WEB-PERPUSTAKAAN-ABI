<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswas';
    
    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jurusan',
    ];

    protected $casts = [
        'jurusan' => 'string', // or enum if using enum
    ];

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
