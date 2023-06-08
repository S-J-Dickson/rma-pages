<?php

namespace App\Models\RMA\Type;

use App\Enums\BaseEnum;
use Exception;
use Illuminate\Support\Collection;

class RMA_TYPE extends BaseEnum
{
    public const BATTERY = "battery";
    public const INVERTER = "inverter";
    public const PERIPHERAL = "peripheral";

    /**
     * @param mixed $enumValue
     * @param string $identifier
     * @return array|null
     */
    public function validate(mixed $enumValue, string $identifier): ?array
    {
        return $this->getAssociatedEnumInstance($enumValue)->validate($identifier);
    }

    /**
     * @param mixed $enumValue
     * @return BaseIdentifiableEnum
     */
    public function getAssociatedEnumInstance(mixed $enumValue): BaseIdentifiableEnum
    {
        $enum = $this->getAssociatedEnumClass();

        return call_user_func([$enum, 'fromValue'], $enumValue);
    }

    /**
     * Get the members of this type's associated enum
     *
     * @return Collection|BaseIdentifiableEnum[]
     */
    public function getAssociatedInstanceMembers(): Collection
    {
        return call_user_func([$this->getAssociatedEnumClass(), 'getCollection'], false);
    }

    /**
     * @return string
     */
    public function getAssociatedEnumClass(): string
    {
        //todo get the enum class associated with this instance's value
        //static::BATTERY should correspond to BATTERY::class etc

        return match ($this->value) {
            self::BATTERY => BATTERY::class,
            self::INVERTER => INVERTER::class,
            self::PERIPHERAL => PERIPHERAL::class,
            default => throw new Exception("Type does not exist, please add enum type and classes."),
        };
    }
}
