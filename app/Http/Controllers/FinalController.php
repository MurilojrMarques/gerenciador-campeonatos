<?php

namespace App\Http\Controllers;

use App\Models\Confronto;
use Illuminate\Http\Request;

class FinalController extends Controller
{
    public function gerarFinais($vencedoresSemifinal, $campeonato_id)
    {
        if (count($vencedoresSemifinal) != 2) {
            throw new \Exception('Número de vencedores inválido para a final.');
        }

        if (Confronto::where('campeonato_id', $campeonato_id)->where('fase', 'final')->exists()) {
            return redirect()->route('times.index')->with('error', 'O confronto da final já foi gerado.');
        }

        $confronto = [
            'time_casa' => $vencedoresSemifinal[0],
            'time_visitante' => $vencedoresSemifinal[1],
        ];

        $placares = $this->gerarPlacaresConfrontos([$confronto]);
        $this->salvarResultados($placares, $campeonato_id);
        $vencedor = $this->determinarVencedores($placares);

        return [$placares, $vencedor];
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

    private function salvarResultados($placares, $campeonato_id)
    {
        foreach ($placares as $placar) {
            Confronto::create([
                'time_casa' => $placar['time_casa'],
                'placar_casa' => $placar['placar_casa'],
                'time_visitante' => $placar['time_visitante'],
                'placar_visitante' => $placar['placar_visitante'],
                'vencedor' => $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'],
                'campeonato_id' => $campeonato_id,
                'fase' => 'final',
            ]);
        }
    }

    private function determinarVencedores($placares)
    {
        $vencedor = [];
        foreach ($placares as $placar) {
            $vencedor = $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'];
            
        }
        return $vencedor;
    }
}
