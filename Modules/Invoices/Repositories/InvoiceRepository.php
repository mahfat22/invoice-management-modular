<?php

namespace Modules\Invoices\Repositories;

use Modules\Invoices\Models\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function create(array $data): Invoice
    {
        return Invoice::create($data);
    }

    public function findOrFail($id): Invoice
    {
        return Invoice::findOrFail($id);
    }

    public function all()
    {
        return Invoice::query()
            ->with(['customer', 'items'])
            ->latest('id')
            ->get();
    }
}
