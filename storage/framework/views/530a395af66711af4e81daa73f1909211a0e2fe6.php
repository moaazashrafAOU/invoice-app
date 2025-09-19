<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>➕ إضافة عميل جديد</h1>

    <form action="<?php echo e(route('customers.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رقم التليفون</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">رصيد أول المدة</label>
            <input type="number" name="initial_balance" class="form-control" step="0.01" min="0" value="0">
            <div class="form-text">الرصيد الذي سيبدأ به العميل في النظام</div>
        </div>

        <button type="submit" class="btn btn-success">💾 حفظ</button>
        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-secondary">↩ رجوع</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/customers/create.blade.php ENDPATH**/ ?>