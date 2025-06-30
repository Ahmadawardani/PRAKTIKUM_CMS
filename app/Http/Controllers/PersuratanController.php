<?php

namespace App\Http\Controllers;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;


use Illuminate\Http\Request;

class PersuratanController extends Controller
{

        public function index()
    {
        $masuk = SuratMasuk::all();
        $keluar = SuratKeluar::all();

        return view('administrasi.persuratan.index', compact('masuk', 'keluar'));
    }

    // CREATE
public function createSuratMasuk()
{
    return view('administrasi.persuratan.suratmasuk.create');
}

// STORE
public function storeSuratMasuk(Request $request)
{
    $request->validate([
        'pengirim' => 'required|string',
        'perihal' => 'required|string',
        'tanggal' => 'required|date',
    ]);

    SuratMasuk::create($request->all());
    return redirect()->route('persuratan.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
}

// EDIT
public function editSuratMasuk($id)
{
    $suratMasuk = SuratMasuk::findOrFail($id);
    return view('administrasi.persuratan.suratmasuk.edit', compact('suratMasuk'));
}

// UPDATE
public function updateSuratMasuk(Request $request, $id)
{
    $request->validate([
        'pengirim' => 'required|string',
        'perihal' => 'required|string',
        'tanggal' => 'required|date',
    ]);

    $suratMasuk = SuratMasuk::findOrFail($id);
    $suratMasuk->update($request->all());

    return redirect()->route('persuratan.index')->with('success', 'Surat Masuk berhasil diperbarui.');
}

// DELETE
public function destroySuratMasuk($id)
{
    $suratMasuk = SuratMasuk::findOrFail($id);
    $suratMasuk->delete();

    return redirect()->route('persuratan.index')->with('success', 'Surat Masuk berhasil dihapus.');
}

// CREATE
public function createSuratKeluar()
{
    return view('administrasi.persuratan.suratkeluar.create');
}

// STORE
public function storeSuratKeluar(Request $request)
{
    $request->validate([
        'tujuan' => 'required|string',
        'perihal' => 'required|string',
        'tanggal' => 'required|date',
    ]);

    SuratKeluar::create($request->all());
    return redirect()->route('persuratan.index')->with('success', 'Surat Keluar berhasil ditambahkan.');
}

// EDIT
public function editSuratKeluar($id)
{
    $suratKeluar = SuratKeluar::findOrFail($id);
    return view('administrasi.persuratan.suratkeluar.edit', compact('suratKeluar'));
}

// UPDATE
public function updateSuratKeluar(Request $request, $id)
{
    $request->validate([
        'tujuan' => 'required|string',
        'perihal' => 'required|string',
        'tanggal' => 'required|date',
    ]);

    $suratKeluar = SuratKeluar::findOrFail($id);
    $suratKeluar->update($request->all());

    return redirect()->route('persuratan.index')->with('success', 'Surat Keluar berhasil diperbarui.');
}

// DELETE
public function destroySuratKeluar($id)
{
    $suratKeluar = SuratKeluar::findOrFail($id);
    $suratKeluar->delete();

    return redirect()->route('persuratan.index')->with('success', 'Surat Keluar berhasil dihapus.');
}

}
