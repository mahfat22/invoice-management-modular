<?php

return [

    'required' => 'حقل :attribute مطلوب.',
    'numeric' => 'حقل :attribute يجب أن يكون رقمًا.',
    'date' => 'حقل :attribute يجب أن يكون تاريخًا صحيحًا.',
    'exists' => ':attribute المحدد غير موجود.',
    'array' => 'حقل :attribute يجب أن يكون مصفوفة.',
    'min' => [
        'numeric' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :min.',
        'array' => 'يجب أن يحتوي :attribute على :min عنصر على الأقل.',
        'string' => 'يجب ألا يقل :attribute عن :min أحرف.',
    ],

    'attributes' => [
        'customer_id' => 'العميل',
        'invoice_date' => 'تاريخ الفاتورة',
        'items' => 'الأصناف',
        'item_name' => 'اسم الصنف',
        'quantity' => 'الكمية',
        'unit_price' => 'سعر الوحدة',
        'tax' => 'الضريبة',
        'discount' => 'الخصم',
        'shipping_amount' => 'الشحن',

        'name' => 'اسم العميل',
        'phone' => 'رقم الهاتف',
        'address' => 'العنوان',
    ],
];
