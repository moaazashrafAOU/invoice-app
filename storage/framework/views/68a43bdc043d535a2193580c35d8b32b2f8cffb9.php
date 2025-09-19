<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-receipt"></i> إنشاء فاتورة جديدة</h3>
            <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-light btn-sm">
                <i class="bi bi-list-ul"></i> قائمة الفواتير
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('invoices.store')); ?>" id="invoiceForm">
                <?php echo csrf_field(); ?>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">رقم الفاتورة:</label>
                        <input type="text" class="form-control bg-light" value="تلقائي" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">التاريخ:</label>
                        <input type="date" class="form-control" name="invoice_date" 
                               value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">العميل:</label>
                        <select class="form-select" name="customer_id" id="customer_id" required>
                            <option value="">-- اختر عميل --</option>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($customer->id); ?>" data-balance="<?php echo e($customer->balance); ?>">
                                    <?php echo e($customer->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">الرصيد السابق:</label>
                        <input type="number" class="form-control text-end fw-bold bg-light" 
                               name="previous_balance" id="previous_balance" readonly step="0.01">
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table table-striped table-bordered text-center align-middle" id="invoice_items">
                        <thead class="table-dark">
                            <tr>
                                <th width="8%">مسلسل</th>
                                <th width="25%">اسم المنتج</th>
                                <th width="15%">السعر</th>
                                <th width="12%">الكمية</th>
                                <th width="15%">الوحدة</th>
                                <th width="15%">الإجمالي</th>
                                <th width="10%">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="invoice-row">
                                <td class="row-number">1</td>
                                <td>
                                    <select class="form-select product-select" name="products[]" required>
                                        <option value="">-- اختر منتج --</option>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control price-input" name="prices[]" 
                                           step="0.01" min="0" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control quantity-input" name="quantities[]" 
                                           step="0.01" min="0" required>
                                </td>
                                <td>
                                    <select class="form-select unit-select" name="units[]" required>
                                        <option value="قطعة">قطعة</option>
                                        <option value="كرتونة">كرتونة</option>
                                        <option value="صفيحة">صفيحة</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control total-input bg-light" 
                                           name="totals[]" readonly step="0.01">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 ms-auto">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label class="form-label fw-bold">إجمالي الفاتورة:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-end fw-bold bg-white" 
                                               name="subtotal" id="subtotal" readonly step="0.01">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label class="form-label fw-bold">الخصم:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-end" 
                                               name="discount" id="discount" step="0.01" min="0" value="0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold">الإجمالي النهائي:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-end fw-bold bg-success text-white" 
                                               name="total" id="total" readonly step="0.01">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-save"></i> حفظ الفاتورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let rowCounter = 1;

    // تحديث الرصيد السابق عند اختيار العميل
    document.getElementById('customer_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const balance = selectedOption.getAttribute('data-balance') || 0;
        document.getElementById('previous_balance').value = parseFloat(balance).toFixed(2);
    });

    // حساب الإجمالي عند تغيير السعر أو الكمية
    function calculateRowTotal(row) {
        const priceInput = row.querySelector('.price-input');
        const quantityInput = row.querySelector('.quantity-input');
        const totalInput = row.querySelector('.total-input');
        
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseFloat(quantityInput.value) || 0;
        const total = price * quantity;
        
        totalInput.value = total.toFixed(2);
        calculateGrandTotal();
    }

    // حساب الإجمالي العام
    function calculateGrandTotal() {
        let subtotal = 0;
        document.querySelectorAll('.total-input').forEach(function(input) {
            subtotal += parseFloat(input.value) || 0;
        });
        
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const total = subtotal - discount;
        document.getElementById('total').value = total.toFixed(2);
    }

    // إضافة صف جديد عند الضغط على Enter في حقل الكمية
    function addNewRowOnEnter(currentRow) {
        const newRow = currentRow.cloneNode(true);
        rowCounter++;
        
        // تحديث رقم المسلسل
        newRow.querySelector('.row-number').textContent = rowCounter;
        
        // مسح القيم
        newRow.querySelectorAll('input').forEach(input => {
            if (!input.readOnly) input.value = '';
        });
        newRow.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });
        
        // إضافة الصف الجديد
        document.querySelector('#invoice_items tbody').appendChild(newRow);
        
        // التركيز على المنتج في الصف الجديد
        newRow.querySelector('.product-select').focus();
        
        // إضافة event listeners للصف الجديد
        attachRowEvents(newRow);
    }

    // إضافة event listeners لصف معين
    function attachRowEvents(row) {
        const priceInput = row.querySelector('.price-input');
        const quantityInput = row.querySelector('.quantity-input');
        const removeBtn = row.querySelector('.remove-row');

        priceInput.addEventListener('input', function() {
            calculateRowTotal(row);
        });

        quantityInput.addEventListener('input', function() {
            calculateRowTotal(row);
        });

        quantityInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (this.value && priceInput.value) {
                    addNewRowOnEnter(row);
                }
            }
        });

        removeBtn.addEventListener('click', function() {
            if (document.querySelectorAll('.invoice-row').length > 1) {
                row.remove();
                updateRowNumbers();
                calculateGrandTotal();
            }
        });
    }

    // تحديث أرقام المسلسل
    function updateRowNumbers() {
        document.querySelectorAll('.row-number').forEach(function(cell, index) {
            cell.textContent = index + 1;
        });
        rowCounter = document.querySelectorAll('.invoice-row').length;
    }

    // إضافة event listeners للصف الأول
    attachRowEvents(document.querySelector('.invoice-row'));

    // حساب الإجمالي عند تغيير الخصم
    document.getElementById('discount').addEventListener('input', calculateGrandTotal);
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/invoices/create.blade.php ENDPATH**/ ?>