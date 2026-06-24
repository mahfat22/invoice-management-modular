<?php

namespace Modules\Invoices\Repositories;

use Modules\Invoices\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function create(array $data): Invoice;

    public function findOrFail($id): Invoice;

    public function all();

    public function paginate(int $perPage = 15, ?string $search = null);
}
