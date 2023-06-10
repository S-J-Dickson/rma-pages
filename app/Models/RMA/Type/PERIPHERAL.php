<?php

namespace App\Models\RMA\Type;

use App\Models\RMA\Type\Validators\PeripheralIdentifierValidator;
use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class PERIPHERAL extends BaseIdentifiableEnum
{
    public const CABLE = "cable";
    public const SCREWS = "screws";

    /**
     * @inheritDoc
     */
    protected function getValidator(): ValidatesIdentifiers
    {
        //any identifiers given for peripherals should always pass validation checks
        //regardless of their content
        return new PeripheralIdentifierValidator();
    }
}
