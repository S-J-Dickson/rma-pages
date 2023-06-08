<?php

namespace App\Models\RMA;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\RMA_TYPE;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RMAItem extends Model
{
    use HasFactory;

    protected $table = 'rma_items';

    protected $casts = [
        'type' => RMA_TYPE::class
    ];

    /**
     * @param RMA $rma
     * @param RMAItemData $data
     * @return static
     */
    public static function createFromData(RMA $rma, RMAItemData $data): static
    {
        //todo implement creation of RMAItem from data
    }

    /**
     * @return BelongsTo
     */
    public function rma(): BelongsTo
    {
        //todo implement rma relationship
    }

    /**
     * @return BaseIdentifiableEnum
     */
    public function getValue(): BaseIdentifiableEnum
    {
        //todo get the correct enum instance from the type/value combination
    }
}
