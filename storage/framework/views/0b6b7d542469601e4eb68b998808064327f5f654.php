<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-3">قائمة العملاء</h1>

    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary mb-3">➕ إضافة عميل جديد</a>

    <?php if($customers->count() > 0): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التليفون</th>
                <th>العنوان</th>
                <th>الإيميل</th>
                <th>الرصيد الحالي</th>
                <th>خيارات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($customer->name); ?></td>
                <td><?php echo e($customer->phone); ?></td>
                <td><?php echo e($customer->address); ?></td>
                <td><?php echo e($customer->email); ?></td>
                <td>
                    <span class="badge <?php echo e($customer->balance >= 0 ? 'bg-success' : 'bg-danger'); ?>">
                        <?php echo e(number_format($customer->balance, 2)); ?> جنيه
                    </span>
                </td>
                <td>
                    <a href="<?php echo e(route('customers.show', $customer->id)); ?>" class="btn btn-info btn-sm">👁 عرض</a>
                    <a href="<?php echo e(route('customers.edit', $customer->id)); ?>" class="btn btn-warning btn-sm">✏ تعديل</a>
                    <form action="<?php echo e(route('customers.destroy', $customer->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm">🗑 حذف</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>لا يوجد عملاء حتى الآن.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/customers/index.blade.php ENDPATH**/ ?>