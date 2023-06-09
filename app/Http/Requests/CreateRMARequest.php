<?php

namespace App\Http\Requests;

use App\Models\RMA\RMAItemData;
use App\Models\RMA\Type\RMA_TYPE;
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
        //todo finish validation rules
        return [
            'items' => ['required', 'array'],
            'items.*.type' => ['required', new EnumValue(RMA_TYPE::class)],
            'items.*.value' => ['required'],
            'items.*.identifier' => ['required'],
            'items.*.reason' => ['required'],
        ];
    }

    /**
     * @return RMAItemData[]
     */
    public function getItems(): array
    {
        return array_map(fn($data) => new RMAItemData($data), $this->items);
    }

    protected function passedValidation()
    {
//        Check identifier validations here
        $this->checkIdentifierValidation();
    }


    /**
     * @return void
     * @throws ValidationException
     */
    public function checkIdentifierValidation(): void
    {
        $messages = [];

        foreach ($this->getItems() as $index => $item) {
            $message = RMA_TYPE::fromValue($item->type)->validate($item->value, $item->identifier);

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
        //TODO::Add more for if no rules have been added
        return [
            'items.*.type.required' => 'Type field is required',
            'items.*.value.required' => 'Value field is required',
            'items.*.identifier.required' => 'Identifier field is required',
            'items.*.reason.required' => 'Reason field is required',
        ];
    }
}
