<?php

namespace Modules\Invoices\Http\Controllers;

use App\Http\Controllers\Controller;
use Baidouabdellah\LaravelArpdf\Facades\ArPDF;
use Modules\Invoices\DTOs\CreateInvoiceDTO;
use Modules\Invoices\Http\Requests\StoreInvoiceRequest;
use Modules\Invoices\Services\InvoiceService;
use Modules\Invoices\Transformers\InvoiceResource;

class InvoicesController extends Controller
{
    public function __construct(
        protected InvoiceService $invoiceService
    ) {}


    public function index()
    {
        $invoices = $this->invoiceService->paginate();
        return response()->paginated(
            paginator: $invoices,
            data: InvoiceResource::collection($invoices)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreInvoiceRequest $request )
    {
        $dto = new CreateInvoiceDTO(
            ...$request->validated()
        );
        $invoice = $this->invoiceService->createInvoice($dto);

        return response()->success(
            data: new InvoiceResource(
                $invoice->load([
                    'customer',
                    'items',
                ])
            ),
            message: 'Invoice created successfully.',
            status: 201
        );
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $invoice = $this->invoiceService->getInvoice($id);

        return response()->success(
            data: new InvoiceResource(
                $invoice->load([
                    'customer',
                    'items',
                ])
            )
        );
    }


    public function pdf($id)
    {
        $invoice = $this->invoiceService->getInvoice($id);

        return ArPDF::loadView(
            'invoices::pdf.invoice',
            compact('invoice')
        )->stream(
            "invoice-{$invoice->invoice_number}.pdf"
        );
    }
}
