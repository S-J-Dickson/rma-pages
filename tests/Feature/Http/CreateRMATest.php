<?php

namespace Tests\Feature\Http;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\RMA_TYPE;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class CreateRMATest extends TestCase
{
    use RefreshDatabase;

    public function test_the_create_page_can_be_visited_and_includes_text_value_pairs_for_all_types_and_their_subtypes()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('rma.create'));

        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('RMA/CreateRMA');

            $expected = RMA_TYPE::getCollection()->map(fn(RMA_TYPE $type) => [
                'text' => $type->description,
                'value' => $type->value,
                'items' => $type->getAssociatedInstanceMembers()->map(fn(BaseIdentifiableEnum $member) => [
                    'text' => $type->description,
                    'value' => $type->value
                ])->toArray()
            ])->toArray();

            $assert->where('types', $expected);
        });
    }
}
