<?php

namespace App\Models\RMA\Type;

use App\Enums\BaseEnum;
use App\Models\RMA\Type\Validators\ValidatesIdentifiers;
use Illuminate\Support\Arr;

abstract class BaseIdentifiableEnum extends BaseEnum
{
    /**
     * Validate the given identifier
     *
     * @param string $identifier
     * @return array|null
     */
    public function validate(string $identifier): ?array
    {
        $validator = $this->getValidator();

        $messages = $validator->validate($this, $identifier);

        if ($messages === null) return null;

        return array_filter(Arr::wrap($messages));
    }

    /**
     * Get the validator associated with this enum instance
     *
     * @return ValidatesIdentifiers
     */
    abstract protected function getValidator(): ValidatesIdentifiers;
}
