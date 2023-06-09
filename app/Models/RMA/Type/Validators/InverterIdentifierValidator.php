<?php

namespace App\Models\RMA\Type\Validators;

use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\INVERTER;
use Illuminate\Support\Facades\Validator;

class InverterIdentifierValidator implements ValidatesIdentifiers
{
    /**
     * @param INVERTER $type
     * @inheritDoc
     */
    public function validate(BaseIdentifiableEnum $type, string $identifier): string|array|null
    {
        $key = $type->key;

        $sharedRules = ['required', 'string', 'size:10', 'uppercase', 'regex:/^.{6}G[0-9]+$/'];

        if (strpos($key, 'AC') !== false) {
            $validator = Validator::make(["identifier" => $identifier], [
                'identifier' => array_merge(['starts_with:CE'], $sharedRules),
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }

            return null;
        } elseif (strpos($key, 'HYBRID') !== false) {
            $validator = Validator::make(["identifier" => $identifier], [
                'identifier' => array_merge(['starts_with:SA,SD'], $sharedRules),
            ]);


            if ($validator->fails()) {
                return $validator->errors();
            }

            return null;
        }

        return "Select Hybrid or AC type.";
    }
}
