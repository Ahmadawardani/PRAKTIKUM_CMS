<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Divisi;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::with('divisi')->get();
        return view('anggota.index', compact('anggotas'));
    }

    public function show(Anggota $anggotum)
    {
        return view('anggota.show', ['anggota' => $anggotum]);
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('anggota.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIM' => 'required|unique:anggotas,NIM',
            'NAMA' => 'required',
            'JABATAN' => 'required',
            'DIVISI_ID' => 'nullable|exists:divisis,id',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

public function edit(Anggota $anggotum)
{
    $divisis = Divisi::all();
    return view('anggota.edit', ['anggota' => $anggotum, 'divisis' => $divisis]);
}

public function update(Request $request, Anggota $anggotum)
{
    $request->validate([
        'NIM' => 'required|unique:anggotas,NIM,' . $anggotum->id,
        'NAMA' => 'required',
        'JABATAN' => 'required',
        'DIVISI' => 'nullable|exists:divisis,id',
    ]);

    $anggotum->update($request->all());
    return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diupdate.');
}

public function destroy(Anggota $anggotum)
{
    $anggotum->delete();
    return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
}
}