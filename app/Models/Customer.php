<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // الحقول المسموح تعبئتها
    protected $fillable = [
        'name',
        'phone',
        'address',
    
        'balance',
        'initial_balance',
    ];

    // العلاقة مع الفواتير
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // العلاقة مع الدفعات
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

