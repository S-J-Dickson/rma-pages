<?php

namespace Tests\Unit\Models\RMA\Validation;

use App\Models\RMA\Type\BATTERY;
use App\Models\RMA\Type\Validators\BatteryIdentifierValidator;
use Tests\TestCase;

class BatteryIdentifierValidatorTest extends TestCase
{
    private function makeValidator(): BatteryIdentifierValidator
    {
        return app()->make(BatteryIdentifierValidator::class);
    }

    public function test_the_validator_correctly_validates_that_the_identifier_is_exactly_12_characters_long()
    {
        $v = $this->makeValidator();
        $t = BATTERY::_2_6_KWH();

        $this->assertNotNull($v->validate($t, 'BE264567899'));
        $this->assertNull($v->validate($t, 'BE2645678999'));
        $this->assertNotNull($v->validate($t, 'BE26456789990'));
    }

    public function test_the_validator_correctly_validates_that_the_identifier_starts_with_the_correct_prefix()
    {
        $v = $this->makeValidator();
        $t = BATTERY::_2_6_KWH();

        $this->assertNotNull($v->validate($t, 'BA2345678999'));
        $this->assertNull($v->validate($t, 'BE2645678999'));
        $this->assertNull($v->validate($t, 'BB2645678999'));
        $this->assertNull($v->validate($t, 'BG2645678999'));
    }

    public function test_the_validator_correctly_validates_that_the_identifier_contains_the_battery_capacity()
    {
        $v = $this->makeValidator();
        $t = BATTERY::_2_6_KWH();
        $t2 = BATTERY::_5_2_KWH();
        $t3 = BATTERY::_9_2_KWH();

        $this->assertNotNull($v->validate($t, 'BEXX45678999'));
        $this->assertNotNull($v->validate($t, 'BE0045678999'));
        $this->assertNull($v->validate($t, 'BE2645678999'));
        $this->assertNull($v->validate($t2, 'BB5245678999'));
        $this->assertNull($v->validate($t3, 'BB9245678999'));
    }

    public function test_the_validator_correctly_validates_that_the_identifier_is_otherwise_made_up_of_numbers()
    {
        $v = $this->makeValidator();
        $t = BATTERY::_2_6_KWH();

        $this->assertNotNull($v->validate($t, 'BE261234567a'));
        $this->assertNull($v->validate($t, 'BE2612345678'));
    }
}
