<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::latest()->paginate(10);
        return view('dokumen.index', compact('dokumens'));
    }
}