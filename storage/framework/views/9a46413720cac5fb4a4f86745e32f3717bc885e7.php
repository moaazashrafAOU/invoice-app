<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            إضافة منتج جديد
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('products.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">اسم المنتج *</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <button type="submit" class="btn btn-success">حفظ المنتج</button>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/products/create.blade.php ENDPATH**/ ?>