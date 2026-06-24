<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: dejavusans;
            direction: rtl;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
        }
    </style>
</head>
<body>

<h2>فاتورة</h2>

<p>
    رقم الفاتورة:
    {{ $invoice->invoice_number }}
</p>

<p>
    العميل:
    {{ $invoice->customer->name }}
</p>

<p>
    التاريخ:
    {{ $invoice->invoice_date }}
</p>

<table>
    <thead>
        <tr>
            <th>الصنف</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالي</th>
        </tr>
    </thead> 
    <tbody>
        @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->line_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>

<p>الإجمالي الفرعي: {{ $invoice->subtotal }}</p>

<p>الخصم: {{ $invoice->discount_amount }}</p>

<p>الضريبة: {{ $invoice->tax_amount }}</p>

<p>الشحن: {{ $invoice->shipping_amount }}</p>

<h3>
    الإجمالي النهائي:
    {{ $invoice->total_amount }}
</h3>

</body>
</html>
