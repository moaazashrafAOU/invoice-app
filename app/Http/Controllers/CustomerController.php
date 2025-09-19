<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * عرض كل العملاء
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * فورم إضافة عميل جديد
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * تخزين العميل الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
        
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'initial_balance' => 'nullable|numeric|min:0',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
        
            'phone' => $request->phone,
            'address' => $request->address,
            'initial_balance' => $request->initial_balance ?? 0,
            'balance' => $request->initial_balance ?? 0, // الرصيد الحالي يبدأ بنفس الرصيد الأولي
        ]);

        return redirect()->route('customers.index')
                         ->with('success', 'تم إضافة العميل بنجاح');
    }

    /**
     * عرض تفاصيل عميل محدد
     */
    public function show($id)
    {
        $customer = Customer::with(['invoices.invoiceItems.product', 'payments'])->findOrFail($id);

        // جمع كل الحركات (فواتير وتحصيلات)
        $transactions = collect();

        // إضافة الفواتير كحركات خصم
        foreach ($customer->invoices as $invoice) {
            $transactions->push([
                'date' => $invoice->invoice_date,
                'type' => 'فاتورة',
                'description' => 'فاتورة رقم ' . $invoice->id,
                'invoice_id' => $invoice->id,
                'amount' => $invoice->total,
                'is_debit' => true, // الفاتورة تزيد الرصيد المستحق على العميل
            ]);
        }

        // إضافة التحصيلات كحركات إضافة
        foreach ($customer->payments as $payment) {
            $transactions->push([
                'date' => $payment->payment_date,
                'type' => 'تحصيل',
                'description' => 'تحصيل نقدي',
                'amount' => $payment->amount,
                'is_debit' => false, // التحصيل يقلل الرصيد المستحق على العميل
            ]);
        }

        // ترتيب الحركات حسب التاريخ
        $transactions = $transactions->sortBy('date');

        // حساب الرصيد المتراكم
        $currentBalance = $customer->initial_balance;
        $accountStatement = $transactions->map(function ($transaction) use (&$currentBalance) {
            if ($transaction['is_debit']) {
                $currentBalance += $transaction['amount'];
            } else {
                $currentBalance -= $transaction['amount'];
            }
            $transaction['running_balance'] = $currentBalance;
            return $transaction;
        });

        return view('customers.show', compact('customer', 'accountStatement'));
    }

    /**
     * فورم تعديل بيانات العميل
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * تحديث بيانات العميل
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,'.$id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'initial_balance' => 'nullable|numeric|min:0',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'initial_balance' => $request->initial_balance ?? 0,
        ]);

        return redirect()->route('customers.index')
                         ->with('success', 'تم تحديث بيانات العميل بنجاح');
    }

    /**
     * حذف عميل
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'تم حذف العميل بنجاح');
    }
}
