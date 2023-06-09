<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\BATTERY;
use Illuminate\Support\Facades\Validator;

class BatteryIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param BATTERY $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {

        $validator = Validator::make(["identifier" => $identifier], [
            'identifier' => ['required', 'string', 'size:12', 'starts_with:BE,BB,BG', 'uppercase'],
        ]);

        $validator->after(function ($validator) use ($identifier, $type) {

            //TODO::Description MAY CHANGE USE KEY INSTEAD!
            $numbersOnlyBattery = preg_replace("/[^0-9]/", "", $type->description);
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
