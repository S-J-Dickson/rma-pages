<?php

namespace Database\Factories\RMA;

use App\Enums\BatteryIdentifier;
use App\Enums\InventorIdentifier;
use App\Enums\inventorType;
use App\Models\RMA\RMA;
use App\Models\RMA\Type\BATTERY;
use App\Models\RMA\Type\INVERTER;
use App\Models\RMA\Type\PERIPHERAL;
use App\Models\RMA\Type\RMA_TYPE;
use Exception;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Validator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RMA\RMAItem>
 */
class RMAItemFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array_merge(['rma_id' => RMA::factory()],
            static::makeData($this->faker));
    }

    /**
     * @param Generator $faker
     * @return array
     */
    public static function makeData(Generator $faker): array
    {
        $type = RMA_TYPE::getRandomInstance();

        $value = call_user_func([$type->getAssociatedEnumClass(), 'getRandomValue']);

        $identifier = self::createValidIdentifier($type, $value, $faker);

        return [
            'type' => $type->value,
            'value' => call_user_func([$type->getAssociatedEnumClass(), 'getRandomValue']),
            'identifier' => strtoupper($faker->bothify('??####?###')),
            //not actually valid, but generating so something is there
            'reason' => $faker->sentence
        ];
    }


    /**
     * @throws Exception
     */
    private static function createValidIdentifier(RMA_TYPE $type, string $value, Generator $faker)
    {
        dump($type->value);

        return match ($type->value) {
            RMA_TYPE::BATTERY => self::createBatteryIdentifier($type, $value, $faker),
            RMA_TYPE::INVERTER => self::createInverterIdentifier($type, $faker),
            RMA_TYPE::PERIPHERAL => self::createPeripheralIdentifier($faker),
            default => throw new Exception("Type does not exist, please add enum type and classes."),
        };
    }

    /**
     * @throws Exception
     */
    private static function createInverterIdentifier(RMA_TYPE $type, Generator $faker)
    {
        $key = $type->key;

        $ce = InventorIdentifier::CE;
        $hybrid = [InventorIdentifier::SA, InventorIdentifier::SD];

        $identifier = null;

        if (str_contains($key, InventorType::AC)) {
            $identifier = $ce;
        } elseif (str_contains($key, InventorType::HYBRID)) {
            $identifier = $hybrid[$faker->numberBetween(0, (sizeof($hybrid) - 1))];
        }

        if (is_null($identifier)) {
            throw new Exception("Type does not exist please update logic.");
        }

        return $identifier . $faker->bothify('####') . "G" . $faker->bothify('###');
    }

    private static function createBatteryIdentifier(RMA_TYPE $type, string $value, Generator $faker): string
    {
        $initialIdentifier = [BatteryIdentifier::BE, BatteryIdentifier::BB, BatteryIdentifier::BG];

        $identifier = $initialIdentifier[$faker->numberBetween(0, (sizeof($initialIdentifier)) - 1)];

        $numbersOnlyBattery = preg_replace("/[^0-9]/", "", $type->key);


        return $identifier . $numbersOnlyBattery . $faker->bothify('########');
    }


    /**
     * @param Generator $faker
     * @return string
     */
    private static function createPeripheralIdentifier(Generator $faker): string
    {
        return strtoupper($faker->bothify('??####?###'));
    }

}
