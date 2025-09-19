@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center">
            <h2 class="mb-0">فاتورة رقم #{{ $invoice->id }}</h2>
        </div>
        <div class="card-body" id="invoiceContent">
            <div class="mb-3">
                <p><strong>العميل:</strong> {{ $invoice->customer->name }}</p>
                <p><strong>التاريخ:</strong> {{ $invoice->invoice_date }}</p>
                <p><strong>الرصيد السابق:</strong> {{ number_format($invoice->previous_balance, 2) }}</p>
            </div>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>مسلسل</th>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 text-end">
                <p><strong>الخصم:</strong> {{ number_format($invoice->discount, 2) }}</p>
                <p><strong>إجمالي الفاتورة بعد الخصم:</strong> {{ number_format($invoice->total, 2) }}</p>
                <p><strong>الرصيد الجديد للعميل:</strong> {{ number_format($invoice->customer->balance, 2) }}</p>
            </div>
        </div>

        <div class="text-center mt-3 mb-3">
            <button class="btn btn-secondary" id="printInvoice">طباعة الفاتورة</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('printInvoice').addEventListener('click', function() {
    // جمع بيانات الفاتورة
    const invoice = {
        id: {{ $invoice->id }},
        customer: {
            name: "{{ $invoice->customer->name }}",
            phone: "{{ $invoice->customer->phone }}",
            address: "{{ $invoice->customer->address }}"
        },
        invoice_date: "{{ $invoice->invoice_date }}",
        previous_balance: {{ $invoice->previous_balance }},
        discount: {{ $invoice->discount }},
        total: {{ $invoice->total }},
        items: [
            @foreach($invoice->items as $index => $item)
            {
                serial: {{ $index + 1 }},
                product: "{{ $item->product->name }}",
                price: {{ $item->price }},
                quantity: {{ $item->quantity }},
                unit: "{{ $item->unit ?? 'قطعة' }}",
                total: {{ $item->total }}
            }@if(!$loop->last),@endif
            @endforeach
        ]
    };

    const printWindow = window.open('', 'Print-Window');
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
            <title>فاتورة رقم ${invoice.id}</title>
            <style>
                @page { size: A5; margin: 10mm; }
                body { 
                    font-family: Arial, sans-serif; 
                    direction: rtl; 
                    font-size: 10pt; 
                    margin: 0;
                    padding: 0;
                }
                .invoice-header { 
                    text-align: center; 
                    margin-bottom: 10mm; 
                    border-bottom: 2px solid #333;
                    padding-bottom: 5mm;
                }
                .invoice-header img { 
                    max-width: 60mm; 
                    height: auto; 
                    margin-bottom: 3mm;
                }
                .invoice-header h2 { 
                    margin: 3mm 0; 
                    font-size: 16pt; 
                    color: #333;
                }
                .company-info {
                    font-size: 8pt;
                    color: #666;
                    margin-top: 2mm;
                }
                .invoice-details { 
                    margin-bottom: 5mm; 
                    background-color: #f8f9fa;
                    padding: 3mm;
                    border-radius: 2mm;
                }
                .invoice-details p { 
                    margin: 1mm 0; 
                    font-weight: normal; 
                }
                .customer-info {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 3mm;
                }
                .customer-info div {
                    flex: 1;
                }
                table { 
                    border-collapse: collapse; 
                    width: 100%; 
                    margin-bottom: 5mm; 
                    font-size: 9pt;
                }
                th, td { 
                    border: 1px solid #333; 
                    padding: 2mm; 
                    text-align: center; 
                }
                th { 
                    background-color: #333; 
                    color: white;
                    font-weight: bold;
                }
                .total-section { 
                    text-align: left; 
                    margin-top: 5mm; 
                    background-color: #f8f9fa;
                    padding: 3mm;
                    border-radius: 2mm;
                }
                .total-section p { 
                    margin: 1mm 0; 
                    font-weight: bold;
                }
                .footer-details { 
                    text-align: center; 
                    margin-top: 10mm; 
                    font-size: 8pt; 
                    border-top: 1px solid #ccc;
                    padding-top: 3mm;
                    color: #666;
                }
                .signature-section {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 10mm;
                    font-size: 9pt;
                }
                .signature-box {
                    text-align: center;
                    width: 30%;
                }
                .signature-line {
                    border-bottom: 1px solid #333;
                    margin-top: 10mm;
                    margin-bottom: 2mm;
                }
            </style>
        </head>
        <body>
            <div class="invoice-header">
                <img src="/images/logo.png" alt="شعار الشركة">
                <h2>فاتورة رقم #${invoice.id}</h2>
                <div class="company-info">
                    <p>شركة الرضوان للتجارة والتوريدات</p>
                </div>
            </div>
            
            <div class="invoice-details">
                <div class="customer-info">
                    <div>
                        <p><strong>العميل:</strong> ${invoice.customer.name}</p>
                        <p><strong>التليفون:</strong> ${invoice.customer.phone}</p>
                    </div>
                    <div>
                        <p><strong>التاريخ:</strong> ${invoice.invoice_date}</p>
                        <p><strong>الرصيد السابق:</strong> ${invoice.previous_balance.toFixed(2)} جنيه</p>
                    </div>
                </div>
                <p><strong>العنوان:</strong> ${invoice.customer.address}</p>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>م</th>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الوحدة</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    ${invoice.items.map(item => `
                        <tr>
                            <td>${item.serial}</td>
                            <td>${item.product}</td>
                            <td>${item.price.toFixed(2)}</td>
                            <td>${item.quantity}</td>
                            <td>${item.unit}</td>
                            <td>${item.total.toFixed(2)}</td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
            
            <div class="total-section">
                <p><strong>إجمالي الفاتورة:</strong> ${(invoice.total + invoice.discount).toFixed(2)} جنيه</p>
                <p><strong>الخصم:</strong> ${invoice.discount.toFixed(2)} جنيه</p>
                <p><strong>الإجمالي النهائي:</strong> ${invoice.total.toFixed(2)} جنيه</p>
                <p style="border-top: 1px solid #ccc; padding-top: 2mm; margin-top: 2mm;"><strong>الرصيد السابق:</strong> ${invoice.previous_balance.toFixed(2)} جنيه</p>
                <p><strong>الرصيد بعد الفاتورة:</strong> ${(invoice.previous_balance + invoice.total).toFixed(2)} جنيه</p>
            </div>
            
          
            
                    <div class="footer">
                <p><strong>العنوان:</strong> الفيوم - دار الرماد - خلف فيلا المحافظ</p>
                <p><strong>أرقام التليفون:</strong> 01061385755 - 01092153413</p>
                <p>شكراً لتعاملكم معنا</p>
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
});
</script>
@endsection
