<?php

namespace Tests\Feature\Http;

use App\Models\RMA\RMA;
use App\Models\RMA\Type\INVERTER;
use App\Models\RMA\Type\RMA_TYPE;
use App\Models\User;
use Database\Factories\RMA\RMAItemFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreRMATest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_a_422_is_thrown_if_no_items_are_passed()
    {
        $response = $this->actingAs(User::factory()->create())->postJson(route('rma.store'), ['items' => []]);

        $response->assertJsonValidationErrors('items');
    }

    public function test_a_422_is_thrown_if_any_items_are_missing_required_properties()
    {
        foreach (array_keys(RMAItemFactory::makeData($this->faker)) as $property) {
            $data = RMAItemFactory::makeData($this->faker);

            unset($data[$property]);

            $response = $this->actingAs(User::factory()->create())->postJson(route('rma.store'), [
                'items' => [$data]
            ]);

            $response->assertJsonValidationErrors("items.0.$property");
        }
    }

    public function test_a_422_is_thrown_if_an_invalid_identifier_is_passed()
    {
        $response = $this->actingAs(User::factory()->create())->postJson(route('rma.store'), [
            'items' => [
                [
                    'type' => RMA_TYPE::INVERTER,
                    'value' => INVERTER::_5_KW_HYBRID,
                    'identifier' => 'CE2145G001',
                    'reason' => 'a reason'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('items.0.identifier');
    }

    public function test_the_rma_and_its_items_are_created_if_the_given_data_is_valid()
    {
        $data = [
            'items' => [
                RMAItemFactory::makeData($this->faker),
                RMAItemFactory::makeData($this->faker),
                RMAItemFactory::makeData($this->faker),
                RMAItemFactory::makeData($this->faker),
            ]
        ];


        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('rma.store'), $data);
        $response->assertRedirect();

        $this->assertSame(RMA::count(), 1);

        $rma = RMA::first();

        $this->assertSame($rma->items->count(), sizeof($data['items']));
    }


    /**
     * @testWith ["value"]
     *
     */
    public function test_a_422_is_thrown_if_an_invalid_data_is_passed($field)
    {

        $item = RMAItemFactory::makeData($this->faker);
        $item[$field] = "incorrect";

        $data = [
            'items' => [$item]
        ];


        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('rma.store'), $data)
            ->assertJsonValidationErrors("items.0.$field");
    }
}
