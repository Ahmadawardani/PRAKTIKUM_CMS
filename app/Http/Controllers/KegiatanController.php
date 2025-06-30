<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Anggota;
use Illuminate\Http\Request;

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

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('anggotas');
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kegiatan->load('anggotas'); // ← Tambahan penting di sini
        $anggotas = Anggota::all();
        return view('kegiatan.edit', compact('kegiatan', 'anggotas'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'nullable',
            'tanggal' => 'nullable|date',
            'anggota_id' => 'array|nullable'
        ]);

        $kegiatan->update($request->only('nama_kegiatan', 'deskripsi', 'tanggal'));

        // Sync anggota (update daftar panitia)
        $kegiatan->anggotas()->sync($request->anggota_id);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->anggotas()->detach(); // Hapus relasi dulu
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan dihapus.');
    }
}
