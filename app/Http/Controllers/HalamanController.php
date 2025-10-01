<?php

namespace App\Http\Controllers;

use App\Models\Halaman;

class HalamanController extends Controller
{
    public function show(Halaman $halaman)
    {
        return view('halaman', [
            'halaman' => $halaman,
            'title' => $halaman->judul // Mengirim judul ke layout
        ]);
    }
}