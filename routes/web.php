<?php

use App\Models\Setting;
use App\Models\Berita; // Tambahkan ini
use App\Models\Agenda; 
use App\Http\Controllers\HalamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DokumenController; // Tambahkan ini


// ... rute yang sudah ada
Route::get('/', function () { // <-- Injeksi class Settings
    $settings = Setting::all()->keyBy('key');
    $backgroundSetting = $settings->get('hero_background');
    $heroImageUrl = $backgroundSetting ? $backgroundSetting->getFirstMediaUrl('hero_background') : null;
    $latestBeritas = Berita::where('is_published', true)->latest()->take(3)->get(); // Ambil 3 berita
    $latestAgenda = Agenda::where('is_published', true)->latest('tanggal')->first();
    
    return view('welcome', [
        'settings' => $settings,
        'heroImageUrl' => $heroImageUrl,
        'latestBeritas' => $latestBeritas,
        'latestAgenda' => $latestAgenda,
    ]);
})->name('home');

// Rute untuk menampilkan halaman
Route::get('/halaman/{halaman:slug}', [HalamanController::class, 'show'])->name('halaman.show');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/agenda/{agenda:slug}', [AgendaController::class, 'show'])->name('agenda.show');
Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
