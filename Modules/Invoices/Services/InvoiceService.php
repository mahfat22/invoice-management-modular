<?php

namespace Modules\Invoices\Services;

use Illuminate\Support\Facades\DB;
use Modules\Invoices\DTOs\CreateInvoiceDTO;
use Modules\Invoices\Models\Invoice;
use Modules\Invoices\Models\InvoiceItem;
use Modules\Invoices\Repositories\InvoiceRepositoryInterface;

class InvoiceService
{
    public function __construct(
        protected InvoiceRepositoryInterface $invoiceRepository
    ) {}

    public function getInvoice($id): Invoice
    {
        return $this->invoiceRepository->findOrFail($id);
    }

    public function getInvoices()
    {
        return $this->invoiceRepository->all();
    }

    public function createInvoice(CreateInvoiceDTO $dto): Invoice
    {
        return DB::transaction(function () use ($dto) {

            $subtotal = 0;
            $items = [];
            foreach ($dto->items as $item) {

                $lineTotal = $item['quantity'] * $item['unit_price'];

                $subtotal += $lineTotal;

                $items[] = [
                    'item_name'  => $item['item_name'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'line_total' => $lineTotal,
                ];
            }

            $discountPercentage = $dto->discount  ?? 0;
            $taxPercentage = $dto->tax  ?? 0;
            $discountAmount = ($subtotal * $discountPercentage) / 100;
            $taxAmount = (($subtotal - $discountAmount) * $taxPercentage) / 100;

            $shippingAmount = $dto->shipping_amount ?? 0;

            $invoice = $this->invoiceRepository->create([
                'customer_id'     => $dto->customer_id,
                'invoice_number'  => $this->generateInvoiceNumber(),
                'invoice_date'    => $dto->invoice_date,
                'subtotal'        => $subtotal,
                'discount_amount' => $discountAmount,
                'tax_amount'      => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount'    => (
                    $subtotal
                    - $discountAmount
                    + $taxAmount
                    + $shippingAmount
                ),
                'notes'           => $dto->notes,
            ]);

            $invoice->items()->createMany($items);

            return $invoice->load([
                'customer',
                'items',
            ]);
        });
    }

    private function generateInvoiceNumber(): string
    {
        $lastInvoice = Invoice::latest('id')->first();

        $nextNumber = $lastInvoice
            ? $lastInvoice->id + 1
            : 1;

        return 'INV-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function paginate()
    {
        return $this->invoiceRepository->paginate(
            perPage: request('per_page', 15),
            search: request('search')
        );
    }
}
