<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_published', true)->latest()->paginate(6);
        return view('berita.index', compact('beritas'));
    }

    public function show(Berita $berita)
    {
        // Pastikan berita yang diakses sudah di-publish
        if (!$berita->is_published) {
            abort(404);
        }
        return view('berita.show', compact('berita'));
    }
}