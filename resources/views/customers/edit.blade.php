@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل بيانات العميل</h2>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">الاسم</label>
            <input type="text" name="name" value="{{ $customer->name }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">الإيميل</label>
            <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="phone">الموبايل</label>
            <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="address">العنوان</label>
            <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
