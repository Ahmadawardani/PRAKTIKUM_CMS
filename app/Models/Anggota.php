<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = ['NIM', 'NAMA', 'JABATAN', 'DIVISI_ID'];

    // Relasi ke Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    // Relasi ke Kegiatan (many-to-many)
    public function kegiatans()
    {
        return $this->belongsToMany(Kegiatan::class);
    }
}
