<?php

namespace App\Models\RMA\Type\Validators;

use App\Enums\InventorIdentifier;
use App\Enums\InventorType;
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
        $ce = InventorIdentifier::CE;
        $sa = InventorIdentifier::SA;
        $sd = InventorIdentifier::SD;


        if (str_contains($key, InventorType::AC)) {

            $validator = Validator::make(["identifier" => $identifier], [
                'identifier' => array_merge(["starts_with:$ce"], $sharedRules),
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }

            return null;
        } elseif (str_contains($key, InventorType::HYBRID)) {
            $validator = Validator::make(["identifier" => $identifier], [
                'identifier' => array_merge(["starts_with:$sa,$sd"], $sharedRules),
            ]);

            if ($validator->fails()) {
                return $validator->errors()->getMessages()["identifier"];
            }

            return null;
        }

        return "Select Hybrid or AC type.";
    }
}
