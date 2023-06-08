<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\BATTERY;

class BatteryIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param BATTERY $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {
        //the identifier must be 12 characters long
        //the identifier must start with characters 'BE', 'BB' or 'BG'
        //the identifier's 3rd and 4th characters must be the battery size times 10 (e.g. 9.5kWh = 95)
        //the identifier is case-sensitive
        //the rest of the identifier must be made up of numbers

        return null;
    }
}
