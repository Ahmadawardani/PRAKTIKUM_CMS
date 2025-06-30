<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kegiatan', 'deskripsi', 'tanggal'];

    public function anggotas()
    {
        return $this->belongsToMany(Anggota::class);
    }
}
