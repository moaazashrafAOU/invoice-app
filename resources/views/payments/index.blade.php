@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-cash-stack"></i> قائمة التحصيلات</h2>
        <a href="{{ route('payments.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> تسجيل تحصيل جديد
        </a>
    </div>

    @if($payments->count() > 0)
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>العميل</th>
                            <th>المبلغ المحصل</th>
                            <th>تاريخ التحصيل</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('customers.show', $payment->customer->id) }}" 
                                   class="text-decoration-none">
                                    {{ $payment->customer->name }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-success fs-6">
                                    {{ number_format($payment->amount, 2) }} جنيه
                                </span>
                            </td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->notes ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i>
            لا توجد تحصيلات مسجلة حتى الآن.
        </div>
    @endif
</div>
@endsection

