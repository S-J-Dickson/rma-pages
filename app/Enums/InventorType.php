<?php

namespace App\Enums;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\Validators\BatteryIdentifierValidator;
use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class inventorType extends BaseEnum
{
    public const HYBRID = 'hy';
    public const AC = 'ac';
}
