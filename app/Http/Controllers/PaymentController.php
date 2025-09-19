<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * عرض صفحة التحصيل
     */
    public function create(Request $request)
    {
        $customers = Customer::all();
        $selectedCustomer = null;
        
        // إذا تم تمرير customer_id في الرابط
        if ($request->has('customer_id')) {
            $selectedCustomer = Customer::find($request->customer_id);
        }
        
        return view('payments.create', compact('customers', 'selectedCustomer'));
    }

    /**
     * حفظ التحصيل
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        // إنشاء سجل التحصيل
        $payment = Payment::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
        ]);

        // تحديث رصيد العميل (خصم المبلغ المحصل)
        $customer = Customer::find($request->customer_id);
        if ($customer) {
            $customer->balance = $customer->balance - $request->amount;
            $customer->save();
        }

        return redirect()->route('payments.create')
                         ->with('success', 'تم تسجيل التحصيل بنجاح وتم تحديث رصيد العميل');
    }

    /**
     * عرض كل التحصيلات
     */
    public function index()
    {
        $payments = Payment::with('customer')->orderBy('payment_date', 'desc')->get();
        return view('payments.index', compact('payments'));
    }
}
