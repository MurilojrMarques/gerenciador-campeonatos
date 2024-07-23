<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Time;
use App\Models\Confronto;
use App\Http\Controllers\QuartasFinalController;

class QuartasFinalControllerTest extends TestCase{
    use RefreshDatabase;

    /** @test */
    public function it_generates_quartas()
    {
        // Cria 8 times
        Time::factory()->count(8)->create();

        $controller = new QuartasFinalController();
        
        list($placaresQuartas, $vencedoresQuartas) = $controller->gerarQuartas();

        // Verifica se o método retorna arrays
        $this->assertIsArray($placaresQuartas);
        $this->assertIsArray($vencedoresQuartas);

        // Verifica se os resultados foram salvos no banco de dados
        $this->assertDatabaseHas('confrontos', [
            'time_casa' => $placaresQuartas[0]['time_casa'],
            'time_visitante' => $placaresQuartas[0]['time_visitante'],
        ]);

        // Verifica se o número de vencedores está correto
        $this->assertCount(4, $vencedoresQuartas);
    }

    /** @teste*/
    public function it_generates_match_scores_correctly()
    {
        $confrontos = [
            ['time_casa' => 'Time A', 'time_visitante' => 'Time B'],
            ['time_casa' => 'Time C', 'time_visitante' => 'Time D'],
        ];

        $controller = new QuartasFinalController();
        $placares = $controller->gerarPlacaresConfrontos($confrontos);

        $this->assertCount(2, $placares);
        foreach ($placares as $placar) {
            $this->assertArrayHasKey('time_casa', $placar);
            $this->assertArrayHasKey('time_visitante', $placar);
            $this->assertArrayHasKey('placar_casa', $placar);
            $this->assertArrayHasKey('placar_visitante', $placar);
            $this->assertIsInt($placar['placar_casa']);
            $this->assertIsInt($placar['placar_visitante']);
        }
    }

    /** @test */
    public function it_saves_results_to_database()
    {
        $placares = [
            [
                'time_casa' => 'Time E',
                'placar_casa' => 2,
                'time_visitante' => 'Time F',
                'placar_visitante' => 3,
                'vencedor' => 'Time F',
            ],
        ];

        $controller = new QuartasFinalController();
        $controller->salvarResultados($placares);

        $this->assertDatabaseHas('confrontos', [
            'time_casa' => 'Time E',
            'placar_casa' => 2,
            'time_visitante' => 'Time F',
            'placar_visitante' => 3,
            'vencedor' => 'Time F',
        ]);
    }

    /** @teste*/
    public function it_determines_winner_correctly()
    {
        $placares = [
            ['time_casa' => 'Time G', 'placar_casa' => 4, 'time_visitante' => 'Time H', 'placar_visitante' => 2],
            ['time_casa' => 'Time I', 'placar_casa' => 1, 'time_visitante' => 'Time J', 'placar_visitante' => 3],
        ];

        $controller = new QuartasFinalController();
        $vencedores = $controller->determinarVencedores($placares);

        $this->assertCount(2, $vencedores);
        $this->assertEquals('Time G', $vencedores[0]); // Time G venceu o primeiro confronto
        $this->assertEquals('Time J', $vencedores[1]); // Time J venceu o segundo confronto
    }
}
