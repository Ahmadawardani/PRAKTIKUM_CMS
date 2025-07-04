<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_divisi'];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }
}
