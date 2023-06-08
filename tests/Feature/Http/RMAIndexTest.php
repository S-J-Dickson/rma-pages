<?php

namespace Tests\Feature\Http;

use App\Models\RMA\RMA;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class RMAIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_index_method_returns_all_rmas()
    {
        $count = 100;

        RMA::factory()->count($count)->create();

        $response = $this->actingAs(User::factory()->create())->get(route('rma.index'));

        $response->assertOk();

        $response->assertInertia(fn(AssertableInertia $assert) => $assert->component('RMA/RMAList')
            ->where('data', fn(Collection $data) => $data->count() === $count));
    }
}
