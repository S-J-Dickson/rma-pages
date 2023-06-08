<?php

namespace Database\Factories\RMA;

use App\Models\RMA\RMA;
use App\Models\RMA\Type\RMA_TYPE;
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

        return [
            'type' => $type->value,
            'value' => call_user_func([$type->getAssociatedEnumClass(), 'getRandomValue']),
            'identifier' => strtoupper($faker->bothify('??####?###')), //not actually valid, but generating so something is there
            'reason' => $faker->sentence
        ];
    }
}
