<?php

namespace Tests\Feature\Models\RMA;

use App\Models\RMA\RMA;
use App\Models\RMA\RMAItem;
use App\Models\RMA\Type\RMA_TYPE;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RMAItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_rma_items_rma_can_be_retrieved()
    {
        $rma = RMA::factory()->create();

        $item = RMAItem::factory()->create([
            'rma_id' => $rma->id
        ]);

        $this->assertTrue($item->rma->is($rma));
    }

    public function test_an_rma_items_enum_instance_can_be_retrieved()
    {
        foreach (RMA_TYPE::getInstances() as $type) {
            foreach($type->getAssociatedInstanceMembers() as $member) {
                $item = RMAItem::factory()->create([
                    'type' => $type->value,
                    'value' => $member->value
                ]);

                $this->assertTrue($member->is($item->getValue()));
            }
        }
    }
}
