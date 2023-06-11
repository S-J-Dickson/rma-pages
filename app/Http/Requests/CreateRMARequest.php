<?php

namespace App\Http\Requests;

use App\Models\RMA\RMAItemData;
use App\Models\RMA\Type\RMA_TYPE;
use App\Rules\CheckRMAValue;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

/**
 * @property-read array $items
 */
class CreateRMARequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validTypes = RMA_TYPE::getValues();

        return [
            'items' => ['required', 'array'],
            'items.*.type' => [
                'required',
                'in:' . implode(',', $validTypes),
                new EnumValue(RMA_TYPE::class),
            ],
            'items.*.value' => [
                'required',
            ],
            'items.*.identifier' => ['required'],
            'items.*.reason' => ['required', 'max:500'],
        ];
    }

    /**
     * @return RMAItemData[]
     */
    public function getItems(): array
    {
        return array_map(fn($data) => new RMAItemData($data), $this->items);
    }

    protected function passedValidation(): void
    {
        $this->checkValueValidation();
        $this->checkIdentifierValidation();
    }


    /**
     * @return void
     * @throws ValidationException
     */
    public function checkValueValidation(): void
    {
        $messages = [];

        foreach ($this->getItems() as $index => $item) {

            $type = RMA_TYPE::fromValue($item->type);

            $values = array_flip($type->getAssociatedInstanceMembers()->toArray());

            $isValid = array_key_exists($item->value, $values);

            if(!$isValid){
                $messages["items.{$index}.value"] = "Value does not belong to type.";
            }
        }

        if (sizeof($messages) > 0) {
            throw ValidationException::withMessages($messages);
        }
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function checkIdentifierValidation(): void
    {
        $messages = [];

        foreach ($this->getItems() as $index => $item) {

            $type = RMA_TYPE::fromValue($item->type);

             array_search($item->value, $type->getAssociatedInstanceMembers()->toArray());

            $message = $type->validate($item->value, $item->identifier);

            if ($message !== null) {
                $messages["items.{$index}.identifier"] = $message;
            }
        }

        if (sizeof($messages) > 0) {
            throw ValidationException::withMessages($messages);
        }
    }

    /**
     * @return string[]
     * @created 09-06-2023
     */
    public function messages()
    {
        return [
            'items.*.type.required' => 'Type field is required',
            'items.*.value.required' => 'Value field is required',
            'items.*.identifier.required' => 'Identifier field is required',
            'items.*.reason.required' => 'Reason field is required',
        ];
    }
}
