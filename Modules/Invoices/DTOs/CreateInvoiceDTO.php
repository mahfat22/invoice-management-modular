<?php

namespace Modules\Invoices\DTOs;

class CreateInvoiceDTO
{
    public function __construct(
        public int $customer_id,
        public string $invoice_date,
        public array $items,
        public ?string $notes = null,
        public int $shipping_amount= 0,
        public int $tax = 0,
        public int $discount = 0,
    ) {}
}
