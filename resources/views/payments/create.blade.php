@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-cash-coin"></i> تسجيل تحصيل جديد</h3>
            <a href="{{ route('payments.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-list-ul"></i> قائمة التحصيلات
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('payments.store') }}" id="paymentForm">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">العميل:</label>
                        <select class="form-select" name="customer_id" id="customer_id" required>
                            <option value="">-- اختر عميل --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                        data-balance="{{ $customer->balance }}"
                                        data-initial-balance="{{ $customer->initial_balance }}"
                                        {{ $selectedCustomer && $selectedCustomer->id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} - الرصيد: {{ number_format($customer->balance, 2) }} جنيه
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">الرصيد الحالي:</label>
                        <input type="number" class="form-control text-end fw-bold bg-light" 
                               id="current_balance" readonly step="0.01">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">رصيد أول المدة:</label>
                        <input type="number" class="form-control text-end fw-bold bg-secondary text-white" 
                               id="initial_balance" readonly step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">إجمالي الفواتير:</label>
                        <input type="number" class="form-control text-end fw-bold bg-warning text-dark" 
                               id="total_invoices" readonly step="0.01">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">المبلغ المحصل:</label>
                        <input type="number" class="form-control text-end" name="amount" 
                               step="0.01" min="0.01" required id="amount">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">تاريخ التحصيل:</label>
                        <input type="date" class="form-control" name="payment_date" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">ملاحظات (اختياري):</label>
                    <textarea class="form-control" name="notes" rows="3" 
                              placeholder="أي ملاحظات إضافية حول التحصيل..."></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">الرصيد بعد التحصيل:</label>
                        <input type="number" class="form-control text-end fw-bold bg-info text-white" 
                               id="balance_after" readonly step="0.01">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> تسجيل التحصيل
                    </button>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> رجوع للعملاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const customerSelect = document.getElementById('customer_id');
const currentBalance = document.getElementById('current_balance');
const initialBalance = document.getElementById('initial_balance');
const totalInvoices = document.getElementById('total_invoices');
const amountInput = document.getElementById('amount');
const balanceAfter = document.getElementById('balance_after');

// تحديث الرصيد الحالي عند اختيار العميل
function updateCurrentBalance() {
    let selected = customerSelect.options[customerSelect.selectedIndex];
    let balance = parseFloat(selected?.dataset.balance) || 0;
    let initial = parseFloat(selected?.dataset.initialBalance) || 0;
    
    currentBalance.value = balance.toFixed(2);
    initialBalance.value = initial.toFixed(2);
    
    // حساب إجمالي الفواتير (الرصيد الحالي - رصيد أول المدة)
    let invoicesTotal = balance - initial;
    totalInvoices.value = invoicesTotal.toFixed(2);
    
    updateBalanceAfter();
}

// تحديث الرصيد بعد التحصيل
function updateBalanceAfter() {
    let balance = parseFloat(currentBalance.value) || 0;
    let amount = parseFloat(amountInput.value) || 0;
    let newBalance = balance - amount;
    balanceAfter.value = newBalance.toFixed(2);
    
    // تغيير لون الحقل حسب الرصيد
    if (newBalance >= 0) {
        balanceAfter.className = 'form-control text-end fw-bold bg-success text-white';
    } else {
        balanceAfter.className = 'form-control text-end fw-bold bg-danger text-white';
    }
}

// أحداث التحديث
customerSelect.addEventListener('change', updateCurrentBalance);
amountInput.addEventListener('input', updateBalanceAfter);

// تحديث البيانات عند تحميل الصفحة إذا كان هناك عميل محدد مسبقاً
document.addEventListener('DOMContentLoaded', function() {
    if (customerSelect.value) {
        updateCurrentBalance();
    }
});
</script>
@endsection

