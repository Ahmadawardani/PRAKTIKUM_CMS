<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::with('divisi')
            ->orderBy('id', 'asc')
            ->get();
        return view('anggota.index', compact('anggotas'));
    }

    public function show($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            return view('anggota.show', ['anggota' => $anggota]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Anggota tidak ditemukan.');
        }
        Log::info('user registered', [
            'time' => now()->toDateTimeString(),
        ]);
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

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $divisis = Divisi::all();
            return view('anggota.edit', ['anggota' => $anggota, 'divisis' => $divisis]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Anggota tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            
            $request->validate([
                'NIM' => 'required|unique:anggotas,NIM,' . $anggota->id,
                'NAMA' => 'required',
                'JABATAN' => 'required',
                'DIVISI' => 'nullable|exists:divisis,id',
            ]);

            $anggota->update($request->all());
            return redirect()->route('anggota.index')
                ->with('success', 'Data anggota berhasil diupdate.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Anggota tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();
            return redirect()->route('anggota.index')
                ->with('success', 'Data anggota berhasil dihapus.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('anggota.index')
                ->with('error', 'Anggota tidak ditemukan.');
        }
    }
}