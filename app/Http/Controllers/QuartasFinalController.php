<?php

namespace App\Http\Controllers;

use App\Models\Confronto;
use App\Models\Time;
use Illuminate\Http\Request;

class QuartasFinalController extends Controller
{
    public function gerarQuartas($campeonato_id)
    {
        if (Confronto::where('campeonato_id', $campeonato_id)->where('fase', 'quartas')->exists()) {
            return redirect()->route('times.index')->with('error', 'Os confrontos das quartas de final já foram gerados.');
        }

        $times = Time::inRandomOrder()->get()->toArray();
        $confrontos = [];
        for ($i = 0; $i < count($times); $i += 2) {
            $confrontos[] = [
                'time_casa' => $times[$i]['nome'],
                'time_visitante' => $times[$i + 1]['nome'],
            ];
        }

        $placares = $this->gerarPlacaresConfrontos($confrontos);
        $this->salvarResultados($placares, $campeonato_id);

        $vencedores = $this->determinarVencedores($placares);
        return [$placares, $vencedores];
    }

    private function gerarPlacaresConfrontos($confrontos)
    {
        $placares = [];
        foreach ($confrontos as $confronto) {
            $placarCasa = mt_rand(0, 5);
            $placarVisitante = mt_rand(0, 5);

            if ($placarCasa === $placarVisitante) {
                $placarCasa += mt_rand(1, 2);
            }

            $placares[] = [
                'time_casa' => $confronto['time_casa'],
                'time_visitante' => $confronto['time_visitante'],
                'placar_casa' => $placarCasa,
                'placar_visitante' => $placarVisitante,
            ];
        }
        return $placares;
    }

    private function salvarResultados($placares, $campeonato_id)
    {
        foreach ($placares as $placar) {
            Confronto::create([
                'time_casa' => $placar['time_casa'],
                'placar_casa' => $placar['placar_casa'],
                'time_visitante' => $placar['time_visitante'],
                'placar_visitante' => $placar['placar_visitante'],
                'vencedor' => $this->determinarVencedor($placar),
                'campeonato_id' => $campeonato_id,
                'fase' => 'quartas',
            ]);
        }
    }

    private function determinarVencedor($placar)
    {
        if ($placar['placar_casa'] > $placar['placar_visitante']) {
            return $placar['time_casa'];
        } elseif ($placar['placar_casa'] < $placar['placar_visitante']) {
            return $placar['time_visitante'];
        }

        return mt_rand(0, 1) ? $placar['time_casa'] : $placar['time_visitante'];
    }

    private function determinarVencedores($placares)
    {
        $vencedores = [];
        foreach ($placares as $placar) {
            $vencedores[] = $this->determinarVencedor($placar);
        }
        return $vencedores;
    }
}
