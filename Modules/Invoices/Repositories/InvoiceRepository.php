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

    public function paginate(
        int $perPage = 15,
        ?string $search = null
    ) {
        return Invoice::query()
            ->with([
                'customer',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where('invoice_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);
    }
}
