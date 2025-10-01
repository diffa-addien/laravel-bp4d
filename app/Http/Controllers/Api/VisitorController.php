<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        // Cukup catat kunjungan untuk hari ini.
        // Logika uniknya ditangani oleh localStorage di frontend.
        Visitor::create(['visit_date' => now()->toDateString()]);

        return response()->json(['status' => 'success'], 201);
    }
}