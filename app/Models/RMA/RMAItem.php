<?php

namespace App\Models\RMA;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\BATTERY;
use App\Models\RMA\Type\INVERTER;
use App\Models\RMA\Type\PERIPHERAL;
use App\Models\RMA\Type\RMA_TYPE;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Exception;
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

    protected $fillable= [
        "type",
        "value",
        "identifier",
        "reason",
        "rma_id"
    ];

    /**
     * @param RMA $rma
     * @param RMAItemData $data
     * @return static
     */
    public static function createFromData(RMA $rma, RMAItemData $data): static
    {
        return RMAItem::create(
            array_merge($data->toArray(),["rma_id" => $rma->id])
        );
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
     * @throws InvalidEnumMemberException
     * @throws Exception
     */
    public function getValue(): BaseIdentifiableEnum
    {
        return match ($this->type->value) {
            RMA_TYPE::BATTERY => new BATTERY($this->value),
            RMA_TYPE::INVERTER => new INVERTER($this->value),
            RMA_TYPE::PERIPHERAL => new PERIPHERAL($this->value),
            default => throw new Exception("Type does not exist, please add enum type and classes."),
        };
    }
}
