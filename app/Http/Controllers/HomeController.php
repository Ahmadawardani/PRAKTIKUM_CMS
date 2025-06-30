<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class HomeController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->take(6)->get();
        return view('home', compact('kegiatans'));
    }
}

