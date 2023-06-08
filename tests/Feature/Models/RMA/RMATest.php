<?php

namespace Tests\Feature\Models\RMA;

use App\Http\Requests\CreateRMARequest;
use App\Models\RMA\RMA;
use App\Models\RMA\RMAItem;
use App\Models\RMA\RMAItemData;
use App\Models\User;
use Database\Factories\RMA\RMAItemFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RMATest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_an_rmas_user_can_be_fetched()
    {
        $user = User::factory()->create();

        $rma = RMA::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertTrue($rma->user->is($user));
    }

    public function test_an_rmas_items_can_be_fetched()
    {
        $rma = RMA::factory()->create();

        $count = 5;

        $items = RMAItem::factory()->count($count)->create([
            'rma_id' => $rma->id
        ]);

        RMAItem::factory()->count(3)->create();

        $this->assertSame($rma->items->count($count), $count);
        $this->assertEquals($rma->items->pluck('id')->sort()->toArray(), $items->pluck('id')->sort()->toArray());
    }

    public function test_an_empty_collection_is_returned_if_an_rma_has_no_items()
    {
        $rma = RMA::factory()->create();

        RMAItem::factory()->count(3)->create();

        $this->assertTrue($rma->items->isEmpty());
    }

    public function test_an_rma_can_be_created_from_a_valid_rma_request()
    {
        $request = $this->mock(CreateRMARequest::class);

        $items = [
            $this->makeRmaData(),
            $this->makeRmaData(),
            $this->makeRmaData(),
            $this->makeRmaData(),
            $this->makeRmaData()
        ];

        $request->shouldReceive('getItems')->andReturn($items);

        $user = User::factory()->create();
        $request->shouldReceive('user')->andReturn($user);

        $rma = RMA::createFromRequest($request);

        $this->assertTrue($rma->user->is($user));
        $this->assertSame($rma->items->count(), sizeof($items));
        $this->assertEquals($rma->items->pluck('value')->sort()->toArray(), Collection::wrap($items)->pluck('value')->sort()->toArray());
    }

    private function makeRmaData(): RMAItemData
    {
        return new RMAItemData(RMAItemFactory::makeData($this->faker));
    }
}
