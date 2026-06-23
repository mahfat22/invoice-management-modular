<?php

namespace Modules\Invoices\DTOs;

class InvoiceItemDTO
{
    public function __construct(
        public string $item_name,
        public float $quantity,
        public float $unit_price,
        public float $discount_amount = 0,
        public float $tax_amount = 0,
    ) {}
}
