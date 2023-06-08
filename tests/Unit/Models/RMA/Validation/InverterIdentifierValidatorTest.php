<?php

namespace Tests\Unit\Models\RMA\Validation;

use App\Models\RMA\Type\INVERTER;
use App\Models\RMA\Type\Validators\InverterIdentifierValidator;
use Tests\TestCase;

class InverterIdentifierValidatorTest extends TestCase
{
    private function makeValidator(): InverterIdentifierValidator
    {
        return app()->make(InverterIdentifierValidator::class);
    }

    public function test_the_validator_correctly_validates_that_the_identifier_is_exactly_10_characters_long()
    {
        $v = $this->makeValidator();
        $t = INVERTER::_3_KW_AC_COUPLED();

        $this->assertNotNull($v->validate($t, 'CE2145G0011'));
        $this->assertNull($v->validate($t, 'CE2145G001'));
        $this->assertNotNull($v->validate($t, 'CE2145G00111'));
    }

    public function test_the_validator_correctly_validates_that_the_identifier_starts_with_the_correct_prefix()
    {
        $v = $this->makeValidator();
        $t = INVERTER::_3_KW_AC_COUPLED();
        $t2 = INVERTER::_3_6_KW_AC_COUPLED();
        $t3 = INVERTER::_5_KW_HYBRID();

        $this->assertNotNull($v->validate($t, 'SA2145G001'));
        $this->assertNull($v->validate($t, 'CE2145G001'));

        $this->assertNotNull($v->validate($t2, 'SA2145G001'));
        $this->assertNull($v->validate($t2, 'CE2145G001'));

        $this->assertNotNull($v->validate($t3, 'CE2145G001'));
        $this->assertNull($v->validate($t3, 'SA2145G001'));
    }

    public function test_the_validator_correctly_validates_that_7th_character_is_the_letter_g()
    {
        $v = $this->makeValidator();
        $t = INVERTER::_3_KW_AC_COUPLED();

        $this->assertNull($v->validate($t, 'CE2145G001'));
        $this->assertNotNull($v->validate($t, 'CE2145H001'));
    }

    public function test_the_validator_correctly_validates_that_the_identifier_is_otherwise_made_up_of_numbers()
    {
        $v = $this->makeValidator();
        $t = INVERTER::_3_KW_AC_COUPLED();

        $this->assertNull($v->validate($t, 'CE2145G001'));
        $this->assertNotNull($v->validate($t, 'CE2145G00A'));
    }
}
