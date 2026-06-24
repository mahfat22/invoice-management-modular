<?php

namespace Modules\Invoices\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,

            'item_name' => $this->item_name,
            'quantity' => (float) $this->quantity,
            'unit_price' => (float) $this->unit_price, 
            'line_total' => (float) $this->line_total,
        ];
    }
}
