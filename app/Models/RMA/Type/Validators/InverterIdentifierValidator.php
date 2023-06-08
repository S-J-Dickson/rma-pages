<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\INVERTER;

class InverterIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param INVERTER $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {
        //the identifier must be 10 characters long
        //if the type is a hybrid inverter, the identifier must start with characters 'SA' or 'SD'
        //if the type is an AC coupled inverter, the identifier must start with characters 'CE'
        //the 7th character in the identifier must be the letter 'G'
        //the rest of the identifier must be made up of numbers
        //the identifier is case-sensitive

        //CE2125G001 is VALID
        //SE2125H00B is NOT VALID

        return null;
    }
}
