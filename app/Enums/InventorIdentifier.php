<?php

namespace App\Enums;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\Validators\BatteryIdentifierValidator;
use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class InventorIdentifier extends BaseEnum
{
 const CE = "CE";
 const SA = "SA";
 const SD = "SD";

}
