<?php

namespace Modules\Invoices\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'invoice_date' => $this->invoice_date?->format('Y-m-d'),
            'customer' => [
                'id' => $this->customer?->id,
                'name' => $this->customer?->name,
            ],
            'subtotal' => (float) $this->subtotal,
            'discount_amount' => (float) $this->discount_amount,
            'shipping_amount' => (float) $this->shipping_amount,
            'tax_amount' => (float) $this->tax_amount,
            'total_amount' => (float) $this->total_amount,
            'notes' => $this->notes,
            'items' => InvoiceItemResource::collection(
                $this->whenLoaded('items')
            ),
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
