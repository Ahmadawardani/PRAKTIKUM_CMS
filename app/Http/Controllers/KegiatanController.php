<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::withCount('anggotas')->get();
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('kegiatan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'nullable',
            'tanggal' => 'nullable|date',
            'anggota_id' => 'array|nullable'
        ]);

        $kegiatan = Kegiatan::create($request->only('nama_kegiatan', 'deskripsi', 'tanggal'));

        // Attach anggota jika ada
        if ($request->has('anggota_id')) {
            $kegiatan->anggotas()->attach($request->anggota_id);
        }

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        try {
            $kegiatan = Kegiatan::with('anggotas')->findOrFail($id);
            return view('kegiatan.show', compact('kegiatan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kegiatan.index')
                ->with('error', 'Kegiatan tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $kegiatan = Kegiatan::with('anggotas')->findOrFail($id);
            $anggotas = Anggota::all();
            return view('kegiatan.edit', compact('kegiatan', 'anggotas'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kegiatan.index')
                ->with('error', 'Kegiatan tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            
            $request->validate([
                'nama_kegiatan' => 'required',
                'deskripsi' => 'nullable',
                'tanggal' => 'nullable|date',
                'anggota_id' => 'array|nullable'
            ]);

            $kegiatan->update($request->only('nama_kegiatan', 'deskripsi', 'tanggal'));
            $kegiatan->anggotas()->sync($request->anggota_id ?? []);

            return redirect()->route('kegiatan.index')
                ->with('success', 'Kegiatan berhasil diperbarui.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kegiatan.index')
                ->with('error', 'Kegiatan tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->anggotas()->detach();
            $kegiatan->delete();

            return redirect()->route('kegiatan.index')
                ->with('success', 'Kegiatan dihapus.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kegiatan.index')
                ->with('error', 'Kegiatan tidak ditemukan.');
        }
    }
}