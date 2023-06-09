<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\INVERTER;
use Illuminate\Support\Facades\Validator;

class PeripheralIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param INVERTER $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {
        return null;
    }
}
