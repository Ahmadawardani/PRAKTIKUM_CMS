<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersuratanController;
use App\Http\Controllers\KeuanganController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes - hanya untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes - hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Home - pindahkan ke dalam middleware auth
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Resource routes
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('divisi', DivisiController::class);
    Route::resource('anggota', AnggotaController::class);
    
    // Administrasi routes
    Route::get('/administrasi', function () {
        return view('administrasi.index');
    })->name('administrasi.index');
    
    Route::get('/administrasi/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/administrasi/persuratan', [PersuratanController::class, 'index'])->name('persuratan.index');
    
    // Surat Keluar routes
    Route::get('/administrasi/persuratan/surat-keluar/create', [PersuratanController::class, 'createSuratKeluar'])->name('suratkeluar.create');
    Route::post('/administrasi/persuratan/surat-keluar/store', [PersuratanController::class, 'storeSuratKeluar'])->name('suratkeluar.store');
    Route::get('/administrasi/persuratan/surat-keluar/{id}/edit', [PersuratanController::class, 'editSuratKeluar'])->name('suratkeluar.edit');
    Route::put('/administrasi/persuratan/surat-keluar/{id}', [PersuratanController::class, 'updateSuratKeluar'])->name('suratkeluar.update');
    Route::delete('/administrasi/persuratan/surat-keluar/{id}', [PersuratanController::class, 'destroySuratKeluar'])->name('suratkeluar.destroy');
    
    // Surat Masuk routes
    Route::get('/administrasi/persuratan/surat-masuk/create', [PersuratanController::class, 'createSuratMasuk'])->name('suratmasuk.create');
    Route::post('/administrasi/persuratan/surat-masuk/store', [PersuratanController::class, 'storeSuratMasuk'])->name('suratmasuk.store');
    Route::get('/administrasi/persuratan/surat-masuk/{id}/edit', [PersuratanController::class, 'editSuratMasuk'])->name('suratmasuk.edit');
    Route::put('/administrasi/persuratan/surat-masuk/{id}', [PersuratanController::class, 'updateSuratMasuk'])->name('suratmasuk.update');
    Route::delete('/administrasi/persuratan/surat-masuk/{id}', [PersuratanController::class, 'destroySuratMasuk'])->name('suratmasuk.destroy');
    
    // Uang Keluar routes
    Route::get('/administrasi/keuangan/uang-keluar/create', [KeuanganController::class, 'createUangKeluar'])->name('uangkeluar.create');
    Route::post('/administrasi/keuangan/uang-keluar/store', [KeuanganController::class, 'storeUangKeluar'])->name('uangkeluar.store');
    Route::get('/administrasi/keuangan/uang-keluar/{id}/edit', [KeuanganController::class, 'editUangKeluar'])->name('uangkeluar.edit');
    Route::put('/administrasi/keuangan/uang-keluar/{id}', [KeuanganController::class, 'updateUangKeluar'])->name('uangkeluar.update');
    Route::delete('/administrasi/keuangan/uang-keluar/{id}', [KeuanganController::class, 'destroyUangKeluar'])->name('uangkeluar.destroy');
    
    // Uang Masuk routes
    Route::get('/administrasi/keuangan/uang-masuk/create', [KeuanganController::class, 'createUangMasuk'])->name('uangmasuk.create');
    Route::post('/administrasi/keuangan/uang-masuk/store', [KeuanganController::class, 'storeUangMasuk'])->name('uangmasuk.store');
    Route::get('/administrasi/keuangan/uang-masuk/{id}/edit', [KeuanganController::class, 'editUangMasuk'])->name('uangmasuk.edit');
    Route::put('/administrasi/keuangan/uang-masuk/{id}', [KeuanganController::class, 'updateUangMasuk'])->name('uangmasuk.update');
    Route::delete('/administrasi/keuangan/uang-masuk/{id}', [KeuanganController::class, 'destroyUangMasuk'])->name('uangmasuk.destroy');
    
    // Other protected routes
    Route::view('/profil', 'profil')->name('profil');
    Route::get('/struktur', function () {
        return view('struktur');
    })->name('struktur');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});