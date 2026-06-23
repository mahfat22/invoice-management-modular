<?php

namespace Modules\Invoices\DTOs;

class CreateInvoiceDTO
{
    public function __construct(
        public int $customer_id,
        public string $invoice_date,
        public array $items,
        public ?string $notes = null,
    ) {}
}
