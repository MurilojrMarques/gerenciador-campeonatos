<?php

namespace App\Http\Controllers;

use App\Http\Controllers\QuartasFinalController;
use App\Http\Controllers\SemifinalController;
use App\Http\Controllers\FinalController;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index()
    {
        $times = Time::all();
        return view('times.index', compact('times'));
    }

    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'times' => 'required|array|min:8|max:8',
            'times.*' => 'required|string|max:255',
        ]);

        foreach ($request->times as $nome) {
            Time::create(['nome' => $nome]);
        }

        return redirect()->route('times.index')->with('success', 'Times cadastrados com sucesso');
    }

    public function sortearConfrontos()
    {
        $quartasFinalController = new QuartasFinalController();
        $semifinalController = new SemifinalController();
        $finalController = new FinalController();


        list($placaresQuartas, $vencedoresQuartas) = $quartasFinalController->gerarQuartas();

        list($placaresSemifinal, $vencedoresSemifinal) = $semifinalController->gerarSemifinais($vencedoresQuartas);

        list($placaresFinal, $vencedorFinal) = $finalController->gerarFinais($vencedoresSemifinal);

        return view('times.resultados', compact('placaresQuartas', 'vencedoresQuartas', 'placaresSemifinal', 'vencedoresSemifinal', 'placaresFinal', 'vencedorFinal'));
    }
}
