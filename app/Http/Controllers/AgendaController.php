<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::where('is_published', true)->latest('tanggal')->paginate(6);
        return view('agenda.index', compact('agendas'));
    }

    public function show(Agenda $agenda)
    {
        if (!$agenda->is_published) {
            abort(404);
        }
        return view('agenda.show', compact('agenda'));
    }
}