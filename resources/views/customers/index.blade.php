@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">قائمة العملاء</h1>

    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">➕ إضافة عميل جديد</a>

    @if($customers->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التليفون</th>
                <th>العنوان</th>
                <th>الإيميل</th>
                <th>الرصيد الحالي</th>
                <th>خيارات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->email }}</td>
                <td>
                    <span class="badge {{ $customer->balance >= 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ number_format($customer->balance, 2) }} جنيه
                    </span>
                </td>
                <td>
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">👁 عرض</a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">✏ تعديل</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑 حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>لا يوجد عملاء حتى الآن.</p>
    @endif
</div>
@endsection
