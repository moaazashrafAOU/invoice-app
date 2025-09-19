<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-cash-stack"></i> قائمة التحصيلات</h2>
        <a href="<?php echo e(route('payments.create')); ?>" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> تسجيل تحصيل جديد
        </a>
    </div>

    <?php if($payments->count() > 0): ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>العميل</th>
                            <th>المبلغ المحصل</th>
                            <th>تاريخ التحصيل</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <a href="<?php echo e(route('customers.show', $payment->customer->id)); ?>" 
                                   class="text-decoration-none">
                                    <?php echo e($payment->customer->name); ?>

                                </a>
                            </td>
                            <td>
                                <span class="badge bg-success fs-6">
                                    <?php echo e(number_format($payment->amount, 2)); ?> جنيه
                                </span>
                            </td>
                            <td><?php echo e($payment->payment_date); ?></td>
                            <td><?php echo e($payment->notes ?? '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i>
            لا توجد تحصيلات مسجلة حتى الآن.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/payments/index.blade.php ENDPATH**/ ?>