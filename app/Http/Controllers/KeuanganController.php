<?php

namespace App\Http\Controllers;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{

public function index()
{
    $masuk = UangMasuk::all();
    $keluar = UangKeluar::all();

    $total_masuk = $masuk->sum('jumlah');
    $total_keluar = $keluar->sum('jumlah');
    $total_kas = $total_masuk - $total_keluar;

    // Group by bulan
    $groupedMasuk = $masuk->groupBy(function($item) {
        return Carbon::parse($item->tanggal)->format('Y-m');
    });

    $groupedKeluar = $keluar->groupBy(function($item) {
        return Carbon::parse($item->tanggal)->format('Y-m');
    });

    // Nama bulan dalam bahasa Indonesia
    $namaBulanIndonesia = [
        1 => 'Januari',
        2 => 'Februari', 
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $labels = [];
    $dataMasuk = [];
    $dataKeluar = [];

    // Loop untuk 12 bulan lengkap
    foreach (range(1, 12) as $bulan) {
        $bln = now()->year . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);
        
        // Gunakan nama bulan Indonesia
        $labels[] = $namaBulanIndonesia[$bulan];
        
        // Ambil data untuk bulan ini
        $dataMasuk[] = isset($groupedMasuk[$bln]) ? $groupedMasuk[$bln]->sum('jumlah') : 0;
        $dataKeluar[] = isset($groupedKeluar[$bln]) ? $groupedKeluar[$bln]->sum('jumlah') : 0;
    }

    return view('administrasi.keuangan.index', compact(
        'masuk', 'keluar', 'total_masuk', 'total_keluar', 'total_kas',
        'labels', 'dataMasuk', 'dataKeluar'
    ));
}

    public function createUangMasuk()
    {
        return view('administrasi.keuangan.uangmasuk.create');
    }

    public function storeUangMasuk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        UangMasuk::create($request->all());
        return redirect()->route('keuangan.index')->with('success', 'Uang Masuk berhasil ditambahkan.');
    }

    public function editUangMasuk($id)
    {
        $uangMasuk = UangMasuk::findOrFail($id);
        return view('administrasi.keuangan.uangmasuk.edit', compact('uangMasuk'));
    }

    public function updateUangMasuk(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        $uangMasuk = UangMasuk::findOrFail($id);
        $uangMasuk->update($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Uang Masuk berhasil diperbarui.');
    }

    public function destroyUangMasuk($id)
    {
        $uangMasuk = UangMasuk::findOrFail($id);
        $uangMasuk->delete();
        return redirect()->route('keuangan.index')->with('success', 'Uang Masuk berhasil dihapus.');
    }

    public function createUangKeluar()
    {
        return view('administrasi.keuangan.uangkeluar.create');
    }

    public function storeUangKeluar(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        UangKeluar::create($request->all());
        return redirect()->route('keuangan.index')->with('success', 'Uang Keluar berhasil ditambahkan.');
    }

    public function editUangKeluar($id)
    {
        $uangKeluar = UangKeluar::findOrFail($id);
        return view('administrasi.keuangan.uangkeluar.edit', compact('uangKeluar'));
    }

    public function updateUangKeluar(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        $uangKeluar = UangKeluar::findOrFail($id);
        $uangKeluar->update($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Uang Keluar berhasil diperbarui.');
    }

    public function destroyUangKeluar($id)
    {
        $uangKeluar = UangKeluar::findOrFail($id);
        $uangKeluar->delete();
        return redirect()->route('keuangan.index')->with('success', 'Uang Keluar berhasil dihapus.');
    }
}