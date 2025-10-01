<?php

use App\Models\Setting;
use App\Http\Controllers\HalamanController;
use Illuminate\Support\Facades\Route;

// ... rute yang sudah ada
Route::get('/', function () { // <-- Injeksi class Settings
    $settings = Setting::all()->keyBy('key');
    $backgroundSetting = $settings->get('hero_background');
    $heroImageUrl = $backgroundSetting ? $backgroundSetting->getFirstMediaUrl('hero_background') : null;
    return view('welcome', [
        'settings' => $settings,
        'heroImageUrl' => $heroImageUrl,
    ]);
});

// Rute untuk menampilkan halaman
Route::get('/halaman/{halaman:slug}', [HalamanController::class, 'show'])->name('halaman.show');