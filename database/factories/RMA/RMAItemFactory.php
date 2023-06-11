<?php

namespace Database\Factories\RMA;

use App\Enums\BatteryIdentifier;
use App\Enums\InventorIdentifier;
use App\Enums\InventorType;
use App\Exceptions\InvalidEnumTypeException;
use App\Models\RMA\RMA;
use App\Models\RMA\Type\RMA_TYPE;
use Exception;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RMA\RMAItem>
 */
class RMAItemFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return array_merge(['rma_id' => RMA::factory()],
            static::makeData($this->faker));
    }

    /**
     * @param Generator $faker
     * @return array
     * @throws Exception
     */
    public static function makeData(Generator $faker): array
    {



        $type = RMA_TYPE::getInstances()["INVERTER"];



        $value = call_user_func([$type->getAssociatedEnumClass(), 'getRandomValue']);



        $identifier = self::createValidIdentifier($type, $value, $faker);

        return [
            'type' => $type->value,
            'value' => $value,
            // The identifier in the database structure is not nullable so always needs to provided
            // It is also not have to be unique
            // I would communicate to the stakeholders to find out if this is the case as peripherals
            // accept anything as identifier
            'identifier' => $identifier,
            'reason' => $faker->sentence
        ];
    }


    /**
     * @param RMA_TYPE $type
     * @param string $value
     * @param Generator $faker
     * @return string
     * @throws Exception
     * This method could be moved to the RMAType class (BATTERY, INVENTOR ETC) and be used for generating identifiers
     * the code be tweaked if the identifier needed to be unique
     * BaseIdentifiableEnum could have function declared createValidIdentifier: string
     */
    private static function createValidIdentifier(RMA_TYPE $type, string $value, Generator $faker): string
    {
        return match ((string) $type->value) {
            RMA_TYPE::BATTERY => self::createBatteryIdentifier($type, $value, $faker),
            RMA_TYPE::PERIPHERAL => self::createPeripheralIdentifier($faker),
            RMA_TYPE::INVERTER => self::createInverterIdentifier($type, $value, $faker),
            default => throw new InvalidEnumTypeException(),
        };
    }

    /**
     * @param RMA_TYPE $type
     * @param $value
     * @param Generator $faker
     * @return string
     * @throws Exception
     */
    private static function createInverterIdentifier(RMA_TYPE $type, $value, Generator $faker): string
    {
        $ce = InventorIdentifier::CE;
        $hybrid = [InventorIdentifier::SA, InventorIdentifier::SD];

        $identifier = null;

        if (str_contains($value, InventorType::AC)) {
            $identifier = $ce;
        } elseif (str_contains($value, InventorType::HYBRID)) {
            $identifier = $hybrid[$faker->numberBetween(0, (sizeof($hybrid) - 1))];
        }

        if (is_null($identifier)) {
            throw new Exception("Type does not exist please update logic.");
        }

        return $identifier . $faker->bothify('####') . "G" . $faker->bothify('###');
    }

    /**
     * @param RMA_TYPE $type
     * @param string $value
     * @param Generator $faker
     * @return string
     */
    private static function createBatteryIdentifier(RMA_TYPE $type, string $value, Generator $faker): string
    {
        $initialIdentifier = [BatteryIdentifier::BE, BatteryIdentifier::BB, BatteryIdentifier::BG];

        $identifier = $initialIdentifier[$faker->numberBetween(0, (sizeof($initialIdentifier)) - 1)];

        $numbersOnlyBattery = preg_replace("/[^0-9]/", "", $value);

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
