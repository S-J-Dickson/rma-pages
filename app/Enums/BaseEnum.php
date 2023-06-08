<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use Illuminate\Support\Collection;

class BaseEnum extends Enum implements LocalizedEnum
{
    /**
     * @param bool $preserveKeys
     * @return Collection
     */
    public static function getCollection(bool $preserveKeys = false): Collection
    {
        $collection = Collection::wrap(static::getInstances());

        if (!$preserveKeys) {
            $collection = $collection->values();
        }

        return $collection;
    }
}
