<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Confronto;
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
        try {
            $times = Time::inRandomOrder()->get()->toArray();

            $confrontos = [];
            for ($i = 0; $i < count($times); $i += 2) {
                $confrontos[] = [
                    'time_casa' => $times[$i]['nome'],
                    'time_visitante' => $times[$i + 1]['nome'],
                ];
            }

            $placaresQuartas = $this->gerarPlacaresConfrontos($confrontos);
            $this->salvarResultados($placaresQuartas);
            $vencedores = $this->determinarVencedores($placaresQuartas);

            return view('times.resultados', compact('placaresQuartas', 'vencedores'));

        } catch (\Exception $exception) {
            return back()->withError('Falha ao sortear confrontos. ' . $exception->getMessage());
        }
    }

    private function gerarPlacaresConfrontos($confrontos)
    {
        $placares = [];
        foreach ($confrontos as $confronto) {
            $placares[] = [
                'time_casa' => $confronto['time_casa'],
                'time_visitante' => $confronto['time_visitante'],
                'placar_casa' => mt_rand(0, 5), 
                'placar_visitante' => mt_rand(0, 5),
            ];
        }
        return $placares;
    }

    private function salvarResultados($placaresQuartas)
    {
        foreach ($placaresQuartas as $placar) {
            Confronto::create([
                'time_casa' => $placar['time_casa'],
                'placar_casa' => $placar['placar_casa'],
                'time_visitante' => $placar['time_visitante'],
                'placar_visitante' => $placar['placar_visitante'],
                'vencedor' => $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'],
            ]);
        }
    }

    private function determinarVencedores($placaresQuartas)
    {
        $vencedores = [];
        foreach ($placaresQuartas as $placar) {
            $vencedor = $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'];
            $vencedores[] = $vencedor;
        }
        return $vencedores;
    }
}
