<?php

namespace App\Models\RMA\Type;

use App\Models\RMA\Type\Validators\ValidatesIdentifiers;

class INVERTER extends BaseIdentifiableEnum
{
    public const _3_KW_AC_COUPLED = 'giv-ac-3.0';
    public const _3_6_KW_AC_COUPLED = 'giv-ac-3.6';
    public const _5_KW_HYBRID = 'giv-hy-5.0';

    /**
     * @return ValidatesIdentifiers
     */
    protected function getValidator(): ValidatesIdentifiers
    {
        // TODO: Implement getValidator() method.
    }
}
