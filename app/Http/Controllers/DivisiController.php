<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return redirect()->route('divisi.index')
            ->with('success', 'Divisi ditambahkan.');
    }

    public function show($id)
    {
        try {
            $divisi = Divisi::with('anggotas')->findOrFail($id);
            return view('divisi.show', compact('divisi'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('divisi.index')
                ->with('error', 'Divisi tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $divisi = Divisi::findOrFail($id);
            return view('divisi.edit', compact('divisi'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('divisi.index')
                ->with('error', 'Divisi tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $divisi = Divisi::findOrFail($id);
            
            $request->validate([
                'nama_divisi' => 'required|unique:divisis,nama_divisi,' . $divisi->id,
            ]);

            $divisi->update($request->all());
            return redirect()->route('divisi.index')
                ->with('success', 'Divisi diperbarui.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('divisi.index')
                ->with('error', 'Divisi tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $divisi = Divisi::findOrFail($id);
            $divisi->delete();
            return redirect()->route('divisi.index')
                ->with('success', 'Divisi dihapus.');
                
        } catch (ModelNotFoundException $e) {
            return redirect()->route('divisi.index')
                ->with('error', 'Divisi tidak ditemukan.');
        }
    }
}