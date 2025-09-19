<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// CRUD العملاء
Route::resource('customers', CustomerController::class);

// الفواتير
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::resource('products', ProductController::class);

// التحصيلات
Route::get('/payments/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');

