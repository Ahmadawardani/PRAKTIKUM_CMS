<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisis = Divisi::withCount('anggotas')->get();
        return view('divisi.index', compact('divisis'));
    }

    public function create()
    {
        return view('divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisis',
        ]);

        Divisi::create($request->all());
        return redirect()->route('divisi.index')->with('success', 'Divisi ditambahkan.');
    }

    public function show(Divisi $divisi)
    {
        $divisi->load('anggotas');
        return view('divisi.show', compact('divisi'));
    }

    public function edit(Divisi $divisi)
    {
        return view('divisi.edit', compact('divisi'));
    }

    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'nama_divisi' => 'required|unique:divisis,nama_divisi,' . $divisi->id,
        ]);

        $divisi->update($request->all());
        return redirect()->route('divisi.index')->with('success', 'Divisi diperbarui.');
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return redirect()->route('divisi.index')->with('success', 'Divisi dihapus.');
    }
}
