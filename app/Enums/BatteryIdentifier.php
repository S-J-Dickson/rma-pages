<?php

namespace App\Enums;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\Validators\BatteryIdentifierValidator;
use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class BatteryIdentifier extends BaseEnum
{
 const BE = "BE";
 const BB = "BB";
 const BG = "BG";

}
