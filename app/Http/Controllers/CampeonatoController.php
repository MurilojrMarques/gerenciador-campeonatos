<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use App\Models\Confronto;

class CampeonatoController extends Controller
{
    public function show($id)
    {
        $placaresQuartas = Confronto::where('campeonato_id', $id)->where('fase', 'quartas')->get()->toArray();
        $placaresSemifinal = Confronto::where('campeonato_id', $id)->where('fase', 'semifinais')->get()->toArray();
        $placaresFinal = Confronto::where('campeonato_id', $id)->where('fase', 'final')->get()->toArray();

        return view('campeonato.show', [
            'placaresQuartas' => $placaresQuartas,
            'placaresSemifinal' => $placaresSemifinal,
            'placaresFinal' => $placaresFinal,
        ]);
    }
}
