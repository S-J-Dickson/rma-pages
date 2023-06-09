<?php

namespace App\Models\RMA\Type\Validators;

use App\Enums\BatteryIdentifier;
use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\BATTERY;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Validator;

class BatteryIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param BATTERY $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {

        $be = BatteryIdentifier::BE;
        $bb = BatteryIdentifier::BB;
        $bg = BatteryIdentifier::BG;

        $validator = Validator::make(["identifier" => $identifier], [
            'identifier' => ['required', 'string', 'size:12', "starts_with:$be,$bb,$bg", 'uppercase'],
        ]);

        $validator->after(function ($validator) use ($identifier, $type) {

            $numbersOnlyBattery = preg_replace("/[^0-9]/", "", $type->key);
            $numbersOnlyIdentifier = preg_replace("/[^0-9]/", "", $identifier);

            $thirdAndFourthCharacters = substr($identifier, 2, 2);
            $restOfIdentifier = substr($identifier, 4);

            if ($numbersOnlyIdentifier !== $thirdAndFourthCharacters . $restOfIdentifier) {
                $validator->errors()->add('identifier', 'The rest of the identifier must be composed of numbers.');
            }

            if ($numbersOnlyBattery !== $thirdAndFourthCharacters) {
                $validator->errors()->add('identifier', 'The 3rd and 4th characters must be the battery size.');
            }
        });

        if ($validator->fails()) {
            return $validator->errors()->getMessages()["identifier"];
        }

        return null;
    }
}
