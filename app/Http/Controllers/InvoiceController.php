<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Product;

class InvoiceController extends Controller
{
    // صفحة إنشاء الفاتورة
    public function create() {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('customers','products'));
    }

    // عرض فاتورة واحدة
    public function show($id) {
        $invoice = Invoice::with('customer', 'items.product')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    // حفظ الفاتورة
    public function store(Request $request) {
        // 1. التحقق من صحة البيانات
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'products.*' => 'required|exists:products,id',
            'prices.*' => 'required|numeric|min:0',
            'quantities.*' => 'required|numeric|min:1',
            'units.*' => 'required|string',
            'discount' => 'nullable|numeric|min:0',
        ]);

        // 2. حساب إجمالي كل الصفوف
        $total = 0;
        if ($request->products && is_array($request->products)) {
            foreach ($request->products as $index => $productId) {
                $lineTotal = $request->prices[$index] * $request->quantities[$index];
                $total += $lineTotal;
            }
        }

        // 3. خصم إن وجد
        $discount = $request->discount ?? 0;
        $finalTotal = $total - $discount;

        // 4. حفظ بيانات الفاتورة الأساسية
        $invoice = Invoice::create([
            'customer_id'      => $request->customer_id,
            'invoice_date'     => $request->invoice_date,
            'previous_balance' => $request->previous_balance ?? 0,
            'discount'         => $discount,
            'total'            => $finalTotal,
        ]);

        // 5. حفظ المنتجات المرتبطة بالفاتورة
        if ($request->products && is_array($request->products)) {
            foreach ($request->products as $index => $productId) {
                $lineTotal = $request->prices[$index] * $request->quantities[$index];
                
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'price'      => $request->prices[$index],
                    'quantity'   => $request->quantities[$index],
                    'unit'       => $request->units[$index] ?? 'قطعة',
                    'total'      => $lineTotal,
                ]);
            }
        }

        // 6. تحديث رصيد العميل
        $customer = Customer::find($request->customer_id);
        $customer->balance = $customer->balance + $finalTotal;
        $customer->save();

        return redirect()->route('invoices.show', $invoice->id)
                        ->with('success', 'تم إنشاء الفاتورة بنجاح');
    }

    // قائمة كل الفواتير
    public function index() {
        $invoices = Invoice::with('customer')->get();
        return view('invoices.index', compact('invoices'));
    }
}
