<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confronto;
use App\Models\Campeonato;
use App\Models\Time;

class SemifinalController extends Controller
{
    public function gerarSemifinais($vencedoresQuartas, $campeonato_id)
    {
        if (count($vencedoresQuartas) != 4) {
            throw new \Exception('Número de vencedores inválido para as semifinais.');
        }

        if (Confronto::where('campeonato_id', $campeonato_id)->where('fase', 'semifinais')->exists()) {
            return redirect()->route('times.index')->with('error', 'Os confrontos das semifinais já foram gerados.');
        }

        $confrontos = [
            [
                'time_casa' => $vencedoresQuartas[0],
                'time_visitante' => $vencedoresQuartas[1],
            ],
            [
                'time_casa' => $vencedoresQuartas[2],
                'time_visitante' => $vencedoresQuartas[3],
            ]
        ];

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
                'fase' => 'semifinais',
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

        return $this->resolverEmpate($placar);
    }

    private function resolverEmpate($placar)
    {
        $timeCasaId = Time::where('nome', $placar['time_casa'])->value('id');
        $timeVisitanteId = Time::where('nome', $placar['time_visitante'])->value('id');


        $pontosCasa = $placar['placar_casa'] + (5 - $placar['placar_visitante']);
        $pontosVisitante = $placar['placar_visitante'] + (5 - $placar['placar_casa']);

        if ($pontosCasa > $pontosVisitante) {
            return $placar['time_casa'];
        } elseif ($pontosCasa < $pontosVisitante) {
            return $placar['time_visitante'];
        }


        return $timeCasaId < $timeVisitanteId ? $placar['time_casa'] : $placar['time_visitante'];
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
