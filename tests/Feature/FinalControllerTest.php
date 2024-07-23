<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Time;
use App\Models\Confronto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Cria 4 times para testar as semifinais e finais
        $times = [
            'Time A', 'Time B', 'Time C', 'Time D'
        ];

        foreach ($times as $time) {
            Time::create(['nome' => $time]);
        }
    }

    /** @teste */
    public function it_generates_finals_correctly()
    {
        // Cria mock dos vencedores da semifinal
        $vencedoresSemifinal = ['Time A', 'Time B'];

        $finalController = new \App\Http\Controllers\FinalController();
        list($placares, $vencedor) = $finalController->gerarFinais($vencedoresSemifinal);

        // Verifica se o confronto da final é gerado
        $this->assertCount(1, $placares);

        // Verifica se o vencedor está presente
        $this->assertNotEmpty($vencedor);
    }

    /** @teste */
    public function it_saves_final_results_correctly()
    {
        $placares = [
            [
                'time_casa' => 'Time A',
                'time_visitante' => 'Time B',
                'placar_casa' => 2,
                'placar_visitante' => 1,
            ],
        ];

        $finalController = new \App\Http\Controllers\FinalController();
        $finalController->salvarResultados($placares);

        $this->assertDatabaseHas('confrontos', [
            'time_casa' => 'Time A',
            'time_visitante' => 'Time B',
            'placar_casa' => 2,
            'placar_visitante' => 1,
            'vencedor' => 'Time A',
        ]);
    }

    /** @teste */
    public function it_determines_winner_correctly()
    {
        $placares = [
            [
                'time_casa' => 'Time A',
                'time_visitante' => 'Time B',
                'placar_casa' => 2,
                'placar_visitante' => 1,
            ],
        ];

        $finalController = new \App\Http\Controllers\FinalController();
        $vencedor = $finalController->determinarVencedores($placares);

        $this->assertEquals('Time A', $vencedor);
    }
}
