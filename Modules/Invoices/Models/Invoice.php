<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Customers\Models\Customer;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'invoice_number',
        'invoice_date',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount', 
        'notes',
        'shipping_amount'
    ];

    protected $casts = [
        'invoice_date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
