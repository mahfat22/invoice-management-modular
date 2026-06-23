<?php

namespace Modules\Invoices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'shipping_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'items.*.item_name' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.discount_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'items.*.tax_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'العميل مطلوب.',
            'customer_id.exists' => 'العميل غير موجود.',

            'invoice_date.required' => 'تاريخ الفاتورة مطلوب.',

            'items.required' => 'يجب إضافة صنف واحد على الأقل.',
            'items.min' => 'يجب إضافة صنف واحد على الأقل.',

            'items.*.item_name.required' => 'اسم الصنف مطلوب.',
            'items.*.quantity.required' => 'الكمية مطلوبة.',
            'items.*.unit_price.required' => 'سعر الوحدة مطلوب.',
        ];
    }
}
