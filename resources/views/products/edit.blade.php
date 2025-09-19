@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            تعديل المنتج
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">الاسم *</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">السعر</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}">
                </div>
                <button type="submit" class="btn btn-success">تحديث المنتج</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
