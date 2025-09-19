<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>تفاصيل العميل: <?php echo e($customer->name); ?></h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>البيانات الأساسية</h5>
                <p><strong>الاسم:</strong> <?php echo e($customer->name); ?></p>
                <p><strong>الإيميل:</strong> <?php echo e($customer->email); ?></p>
                <p><strong>الموبايل:</strong> <?php echo e($customer->phone); ?></p>
                <p><strong>العنوان:</strong> <?php echo e($customer->address); ?></p>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card p-3">
                <h5>الأرصدة</h5>
                <p><strong>رصيد أول المدة:</strong> 
                    <span class="badge bg-info"><?php echo e(number_format($customer->initial_balance, 2)); ?> جنيه</span>
                </p>
                <p><strong>الرصيد الحالي:</strong> 
                    <span class="badge <?php echo e($customer->balance >= 0 ? 'bg-success' : 'bg-danger'); ?>">
                        <?php echo e(number_format($customer->balance, 2)); ?> جنيه
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>كشف حساب العميل</h5>
            <button class="btn btn-info" onclick="printAccountStatement()">🖨 طباعة كشف الحساب</button>
        </div>
        <div class="card-body">
            <p><strong>رصيد أول المدة:</strong> <?php echo e(number_format($customer->initial_balance, 2)); ?> جنيه</p>
            <?php if($accountStatement->count() > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>البيان</th>
                            <th>مدين</th>
                            <th>دائن</th>
                            <th>الرصيد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $accountStatement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($transaction['date']); ?></td>
                            <td>
                                <?php echo e($transaction['description']); ?>

                                <?php if($transaction['type'] == 'فاتورة'): ?>
                                    <a href="<?php echo e(route('invoices.show', $transaction['invoice_id'])); ?>" class="btn btn-sm btn-outline-primary ms-2">عرض الفاتورة</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($transaction['is_debit']): ?>
                                    <?php echo e(number_format($transaction['amount'], 2)); ?> جنيه
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(!$transaction['is_debit']): ?>
                                    <?php echo e(number_format($transaction['amount'], 2)); ?> جنيه
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(number_format($transaction['running_balance'], 2)); ?> جنيه</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">لا توجد حركات مالية لهذا العميل حتى الآن.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-secondary">↩ رجوع لقائمة العملاء</a>
        <a href="<?php echo e(route('customers.edit', $customer->id)); ?>" class="btn btn-warning">✏ تعديل البيانات</a>
        <a href="<?php echo e(route('payments.create')); ?>?customer_id=<?php echo e($customer->id); ?>" class="btn btn-success">💰 تسجيل تحصيل</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function printAccountStatement() {
    const customer = {
        name: "<?php echo e($customer->name); ?>",
        phone: "<?php echo e($customer->phone); ?>",
        address: "<?php echo e($customer->address); ?>",
        initial_balance: <?php echo e($customer->initial_balance); ?>

    };
    
    const transactions = [
        <?php $__currentLoopData = $accountStatement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        {
            date: "<?php echo e($transaction['date']); ?>",
            description: "<?php echo e($transaction['description']); ?>",
            amount: <?php echo e($transaction['amount']); ?>,
            is_debit: <?php echo e($transaction['is_debit'] ? 'true' : 'false'); ?>,
            running_balance: <?php echo e($transaction['running_balance']); ?>

        }<?php if(!$loop->last): ?>,<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ];

    const printWindow = window.open('', 'Print-Window');
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
            <title>كشف حساب - ${customer.name}</title>
            <style>
                @page { size: A4; margin: 15mm; }
                body { 
                    font-family: Arial, sans-serif; 
                    direction: rtl; 
                    font-size: 11pt; 
                    margin: 0;
                    padding: 0;
                }
                .header { 
                    display: flex; 
                    justify-content: space-between; 
                    align-items: center;
                    border-bottom: 2px solid #333;
                    padding-bottom: 10px;
                    margin-bottom: 15px;
                }
                .header img { 
                    max-width: 80mm; 
                    height: auto;
                }
                .header .company-info {
                    text-align: right;
                    font-size: 10pt;
                    color: #333;
                }
                .header h1 {
                    text-align: center;
                    width: 100%;
                    font-size: 20pt;
                    margin: 0;
                    color: #333;
                }
                .customer-details { 
                    margin-bottom: 15px; 
                    background-color: #f8f9fa;
                    padding: 10px;
                    border-radius: 5px;
                }
                .customer-details h3 { margin-top: 0; color: #333; }
                .customer-details p { margin: 3px 0; }
                .balance-info {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 15px;
                    background-color: #e9ecef;
                    padding: 8px;
                    border-radius: 5px;
                }
                table { 
                    border-collapse: collapse; 
                    width: 100%; 
                    margin-bottom: 15px; 
                    font-size: 10pt;
                }
                th, td { 
                    border: 1px solid #333; 
                    padding: 5px; 
                    text-align: center; 
                }
                th { 
                    background-color: #333; 
                    color: white;
                    font-weight: bold;
                }
                .debit { color: #dc3545; }
                .credit { color: #28a745; }
                .footer { 
                    text-align: center; 
                    margin-top: 15px; 
                    font-size: 9pt; 
                    border-top: 1px solid #ccc;
                    padding-top: 5px;
                    color: #333;
                }
                .print-date {
                    text-align: left;
                    font-size: 8pt;
                    color: #555;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="شعار الشركة">
                <div class="company-info">
                    <strong>شركة الرضوان للتجارة والتوريدات</strong><br>
                    الفيوم - دار الرماد - خلف فيلا المحافظ<br>
                    01061385755 | 01092153413
                </div>
            </div>
            
            <h1>كشف حساب العميل</h1>
            
            <div class="customer-details">
                <h3>بيانات العميل</h3>
                <p><strong>الاسم:</strong> ${customer.name}</p>
                <p><strong>التليفون:</strong> ${customer.phone}</p>
                <p><strong>العنوان:</strong> ${customer.address}</p>
            </div>
            
            <div class="balance-info">
                <div><strong>رصيد أول المدة:</strong> ${customer.initial_balance.toFixed(2)} جنيه</div>
                <div><strong>الرصيد الحالي:</strong> ${transactions.length > 0 ? transactions[transactions.length - 1].running_balance.toFixed(2) : customer.initial_balance.toFixed(2)} جنيه</div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>البيان</th>
                        <th>مدين</th>
                        <th>دائن</th>
                        <th>الرصيد</th>
                    </tr>
                </thead>
                <tbody>
                    ${transactions.map(transaction => `
                        <tr>
                            <td>${transaction.date}</td>
                            <td>${transaction.description}</td>
                            <td class="debit">${transaction.is_debit ? transaction.amount.toFixed(2) + ' جنيه' : '-'}</td>
                            <td class="credit">${!transaction.is_debit ? transaction.amount.toFixed(2) + ' جنيه' : '-'}</td>
                            <td><strong>${transaction.running_balance.toFixed(2)} جنيه</strong></td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
            
            <div class="footer">
                <p>شكراً لتعاملكم معنا</p>
            </div>
            
            <div class="print-date">
                <p>تاريخ الطباعة: ${new Date().toLocaleDateString('ar-EG')}</p>
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/customers/show.blade.php ENDPATH**/ ?>