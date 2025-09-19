@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-list-ul"></i> قائمة الفواتير</h3>
            <a href="{{ route('invoices.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg"></i> إنشاء فاتورة جديدة
            </a>
        </div>
        <div class="card-body">
            @if($invoices->isEmpty())
                <div class="alert alert-info text-center">
                    لا توجد فواتير حتى الآن.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>العميل</th>
                                <th>تاريخ الفاتورة</th>
                                <th>الإجمالي النهائي</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ number_format($invoice->total - $invoice->discount, 2) }} جنيه</td>
                                    <td>
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> عرض
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
