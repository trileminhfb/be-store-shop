<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemInvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_product,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'description' => $this->product->description,
            'image' => $this->product->image,
            'quantity' => $this->quantity,
        ];
    }
}
