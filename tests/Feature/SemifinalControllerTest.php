<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Time;
use App\Models\Confronto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SemifinalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Cria 8 times para testar
        $times = [
            'Time A', 'Time B', 'Time C', 'Time D',
            'Time E', 'Time F', 'Time G', 'Time H'
        ];

        foreach ($times as $time) {
            Time::create(['nome' => $time]);
        }
    }

    /** @teste */
    public function it_generates_semifinals_correctly()
    {
        $quartasFinalController = new \App\Http\Controllers\QuartasFinalController();
        list($placaresQuartas, $vencedoresQuartas) = $quartasFinalController->gerarQuartas();

        $semifinalController = new \App\Http\Controllers\SemifinalController();
        list($placaresSemifinal, $vencedoresSemifinal) = $semifinalController->gerarSemifinais($vencedoresQuartas);

        // Verifica se os confrontos são gerados
        $this->assertCount(2, $placaresSemifinal);

        // Verifica se há vencedores
        $this->assertCount(2, $vencedoresSemifinal);
    }

    /** @teste */
    public function it_saves_results_correctly()
    {
        $placares = [
            [
                'time_casa' => 'Time A',
                'time_visitante' => 'Time B',
                'placar_casa' => 2,
                'placar_visitante' => 1,
            ],
            [
                'time_casa' => 'Time C',
                'time_visitante' => 'Time D',
                'placar_casa' => 0,
                'placar_visitante' => 3,
            ],
        ];

        $semifinalController = new \App\Http\Controllers\SemifinalController();
        $semifinalController->salvarResultados($placares);

        $this->assertDatabaseHas('confrontos', [
            'time_casa' => 'Time A',
            'time_visitante' => 'Time B',
            'placar_casa' => 2,
            'placar_visitante' => 1,
            'vencedor' => 'Time A',
        ]);

        $this->assertDatabaseHas('confrontos', [
            'time_casa' => 'Time C',
            'time_visitante' => 'Time D',
            'placar_casa' => 0,
            'placar_visitante' => 3,
            'vencedor' => 'Time D',
        ]);
    }

    /** @teste */
    public function it_determines_winners_correctly()
    {
        $placares = [
            [
                'time_casa' => 'Time A',
                'time_visitante' => 'Time B',
                'placar_casa' => 2,
                'placar_visitante' => 1,
            ],
            [
                'time_casa' => 'Time C',
                'time_visitante' => 'Time D',
                'placar_casa' => 0,
                'placar_visitante' => 3,
            ],
        ];

        $semifinalController = new \App\Http\Controllers\SemifinalController();
        $vencedores = $semifinalController->determinarVencedores($placares);

        $this->assertEquals(['Time A', 'Time D'], $vencedores);
    }
}
