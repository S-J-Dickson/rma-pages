<?php

namespace App\Models\RMA\Type;

use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class BATTERY extends BaseIdentifiableEnum
{
    public const _2_6_KWH = 'giv-bat-2.6';
    public const _5_2_KWH = 'giv-bat-5.2';
    public const _9_2_KWH = 'giv-bat-9.2';

    /**
     * @return ValidatesIdentifiers
     */
    protected function getValidator(): ValidatesIdentifiers
    {
        // TODO: Implement getValidator() method.
    }
}
