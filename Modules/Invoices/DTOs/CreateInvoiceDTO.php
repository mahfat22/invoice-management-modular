<?php

namespace Modules\Invoices\DTOs;

class CreateInvoiceDTO
{
    public function __construct(
        public int $customer_id,
        public int $shipping_amount,
        public int $tax,
        public int $discount,
        public string $invoice_date,
        public array $items,
        public ?string $notes = null,
    ) {}
}
