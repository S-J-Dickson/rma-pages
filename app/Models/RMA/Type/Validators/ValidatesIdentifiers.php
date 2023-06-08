<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;

interface ValidatesIdentifiers
{
    /**
     * Validate an identifier
     *
     * @param BaseIdentifiableEnum $type
     * @param string $identifier
     * @return string|array|null Return a string if there is one error message, array if multiple error messages or null if no errors
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null;
}
