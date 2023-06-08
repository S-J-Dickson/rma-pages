<?php

namespace Tests\Feature\Http;

use App\Models\RMA\RMA;
use App\Models\RMA\RMAItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ViewRMATest extends TestCase
{
    use RefreshDatabase;

    public function test_the_view_rma_page_can_be_visited()
    {
        $itemCount = 5;

        $rma = RMA::factory()->has(RMAItem::factory()->count($itemCount), 'items')->create();

        $response = $this->actingAs(User::factory()->create())->get(route('rma.show', [
            'rma' => $rma->id
        ]));

        $response->assertOk();

        $response->assertInertia(fn(AssertableInertia $assert) => $assert->component('RMA/ViewRMA')
            ->has('created_at')
            ->has('created_by')
            ->where('items', fn($items) => $items->count() === $itemCount)
        );
    }

    public function test_a_404_is_returned_if_the_rma_doesnt_exist()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('rma.show', [
            'rma' => 1
        ]));

        $response->assertNotFound();
    }
}
