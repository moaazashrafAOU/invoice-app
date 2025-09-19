<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-list-ul"></i> قائمة الفواتير</h3>
            <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg"></i> إنشاء فاتورة جديدة
            </a>
        </div>
        <div class="card-body">
            <?php if($invoices->isEmpty()): ?>
                <div class="alert alert-info text-center">
                    لا توجد فواتير حتى الآن.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>العميل</th>
                                <th>تاريخ الفاتورة</th>
                                <th>الإجمالي النهائي</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($invoice->id); ?></td>
                                    <td><?php echo e($invoice->customer->name); ?></td>
                                    <td><?php echo e($invoice->invoice_date); ?></td>
                                    <td><?php echo e(number_format($invoice->total - $invoice->discount, 2)); ?> جنيه</td>
                                    <td>
                                        <a href="<?php echo e(route('invoices.show', $invoice->id)); ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> عرض
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/invoices/index.blade.php ENDPATH**/ ?>