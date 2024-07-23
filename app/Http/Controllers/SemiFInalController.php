<?php
namespace App\Http\Controllers;

use App\Models\Confronto;
use Illuminate\Http\Request;

class SemifinalController extends Controller
{
    public function gerarSemifinais($vencedoresQuartas)
    {
        if (count($vencedoresQuartas) != 4) {
            throw new \Exception('Número de vencedores inválido para a semifinal.');
        }

        $confrontos = [
            ['time_casa' => $vencedoresQuartas[0], 'time_visitante' => $vencedoresQuartas[1]],
            ['time_casa' => $vencedoresQuartas[2], 'time_visitante' => $vencedoresQuartas[3]],
        ];

        $placares = $this->gerarPlacaresConfrontos($confrontos);
        $this->salvarResultados($placares);
        $vencedores = $this->determinarVencedores($placares);

        return [$placares, $vencedores];
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

    private function salvarResultados($placares)
    {
        foreach ($placares as $placar) {
            Confronto::create([
                'time_casa' => $placar['time_casa'],
                'placar_casa' => $placar['placar_casa'],
                'time_visitante' => $placar['time_visitante'],
                'placar_visitante' => $placar['placar_visitante'],
                'vencedor' => $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'],
            ]);
        }
    }

    private function determinarVencedores($placares)
    {
        $vencedores = [];
        foreach ($placares as $placar) {
            $vencedor = $placar['placar_casa'] > $placar['placar_visitante'] ? $placar['time_casa'] : $placar['time_visitante'];
            $vencedores[] = $vencedor;
        }
        return $vencedores;
    }
}
