<?php

namespace App\Http\Resources;

use App\Models\RMA\RMAItem;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class RMAResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'created_by' => $this->user->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'items' => $this->items->map(fn(RMAItem $item) => [
                'type' => $item->type->description,
                'value' => $item->getValue()->description,
                'reason' => $item->reason,
                'identifier' => $item->identifier
            ])
        ];
    }
}
