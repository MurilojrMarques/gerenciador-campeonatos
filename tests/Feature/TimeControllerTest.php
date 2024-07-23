<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Time;
use App\Models\Confronto;

class TimeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @teste */
    public function it_can_display_all_times()
    {
        $times = Time::factory()->count(3)->create();

        $response = $this->get(route('times.index'));

        $response->assertStatus(200);
        $response->assertViewHas('times', $times);
    }

    /** @teste */
    public function it_can_display_the_create_time_form()
    {
        $response = $this->get(route('times.create'));

        $response->assertStatus(200);
    }

    /** @teste */
    public function it_can_store_a_new_time()
    {
        $response = $this->post(route('times.store'), [
            'times' => ['Time 1', 'Time 2', 'Time 3', 'Time 4', 'Time 5', 'Time 6', 'Time 7', 'Time 8']
        ]);

        $response->assertRedirect(route('times.index'));
        $response->assertSessionHas('success', 'Times cadastrados com sucesso');

        $this->assertCount(8, Time::all());
    }

    /** @teste */
    public function it_can_sortear_confrontos()
    {
        Time::factory()->count(8)->create();

        $response = $this->get(route('times.sortearConfrontos'));

        $response->assertStatus(200);
        $response->assertViewHas('placaresQuartas');
        $response->assertViewHas('vencedoresQuartas');
        $response->assertViewHas('placaresSemifinal');
        $response->assertViewHas('vencedoresSemifinal');
        $response->assertViewHas('placaresFinal');
        $response->assertViewHas('vencedorFinal');
    }
}
