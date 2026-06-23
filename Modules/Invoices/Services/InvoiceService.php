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
            $discountAmount = 0;
            $taxAmount = 0;
            $shippingAmount = $dto->shipping_amount ?? 0;



            foreach ($dto->items as $item) {

                $discount = $item['discount_amount'] ?? 0;
                $tax = $item['tax_amount'] ?? 0;

                $lineTotal =
                    ($item['quantity'] * $item['unit_price'])
                    - $discount
                    + $tax;

                $subtotal += ($item['quantity'] * $item['unit_price']);

                $discountAmount += $discount;

                $taxAmount += $tax;
            }

            $invoice = $this->invoiceRepository->create([
                'customer_id'     => $dto->customer_id,
                'invoice_number'  => $this->generateInvoiceNumber(),
                'invoice_date'    => $dto->invoice_date,
                'subtotal'        => $subtotal,
                'discount_amount' => $discountAmount,
                'shipping_amount' => $shippingAmount,
                'tax_amount'      => $taxAmount,
                'total_amount'    => (
                    $subtotal
                    - $discountAmount
                    + $taxAmount
                    + $shippingAmount
                ),
                'status'          => 'draft',
                'notes'           => $dto->notes,
            ]);

            foreach ($dto->items as $item) {

                $lineTotal =
                    ($item['quantity'] * $item['unit_price'])
                    - $item['discount_amount']
                    + $item['tax_amount'];

                $invoice->items()->create([
                    'invoice_id'      => $invoice->id,
                    'item_name'       => $item['item_name'],
                    'quantity'        => $item['quantity'],
                    'unit_price'      => $item['unit_price'],
                    'discount_amount' => $item['discount_amount'],
                    'tax_amount'      => $item['tax_amount'],
                    'line_total'      => $lineTotal,
                ]);
            }

            return $invoice->load([
                'customer',
                'items',
            ]);;
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
}
