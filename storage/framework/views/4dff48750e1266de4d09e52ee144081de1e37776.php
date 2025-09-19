<?php $__env->startSection('content'); ?>
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 text-center text-lg-start">
                <div class="hero-content">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="شعار الرضوان" class="hero-logo mb-4">
                    <h1 class="display-4 fw-bold text-primary mb-3">برنامج الرضوان</h1>
                    <h2 class="h3 text-secondary mb-4">نظام إدارة الفواتير والعملاء</h2>
                    <p class="lead text-muted mb-5">
                        نظام شامل ومتطور لإدارة العملاء والفواتير والتحصيلات بطريقة احترافية وسهلة الاستخدام
                    </p>
                    <div class="hero-buttons">
                        <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-primary btn-lg me-3 mb-2">
                            <i class="fas fa-plus-circle"></i> إنشاء فاتورة جديدة
                        </a>
                        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-outline-primary btn-lg mb-2">
                            <i class="fas fa-users"></i> إدارة العملاء
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center">
                    <div class="dashboard-preview">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title text-center mb-4">لوحة التحكم السريعة</h5>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="stat-card bg-primary text-white p-3 rounded">
                                            <i class="fas fa-users fa-2x mb-2"></i>
                                            <h6>العملاء</h6>
                                            <p class="mb-0">إدارة شاملة</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-card bg-success text-white p-3 rounded">
                                            <i class="fas fa-file-invoice fa-2x mb-2"></i>
                                            <h6>الفواتير</h6>
                                            <p class="mb-0">نظام متقدم</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-card bg-warning text-white p-3 rounded">
                                            <i class="fas fa-money-bill-wave fa-2x mb-2"></i>
                                            <h6>التحصيلات</h6>
                                            <p class="mb-0">متابعة دقيقة</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-card bg-info text-white p-3 rounded">
                                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                                            <h6>التقارير</h6>
                                            <p class="mb-0">تحليل شامل</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold text-primary">الميزات الرئيسية</h2>
                <p class="lead text-muted">كل ما تحتاجه لإدارة أعمالك بكفاءة عالية</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h5 class="card-title">إدارة العملاء</h5>
                        <p class="card-text text-muted">
                            إضافة وتعديل بيانات العملاء مع متابعة الأرصدة وكشوف الحسابات التفصيلية
                        </p>
                        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> إدارة العملاء
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-success text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-file-invoice fa-2x"></i>
                        </div>
                        <h5 class="card-title">نظام الفواتير</h5>
                        <p class="card-text text-muted">
                            إنشاء فواتير احترافية مع حساب تلقائي للإجماليات وطباعة عالية الجودة
                        </p>
                        <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-outline-success">
                            <i class="fas fa-plus"></i> فاتورة جديدة
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-warning text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <h5 class="card-title">التحصيلات</h5>
                        <p class="card-text text-muted">
                            تسجيل المدفوعات وتحديث أرصدة العملاء تلقائياً مع تتبع دقيق للحسابات
                        </p>
                        <a href="<?php echo e(route('payments.create')); ?>" class="btn btn-outline-warning">
                            <i class="fas fa-cash-register"></i> تسجيل تحصيل
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-info text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-boxes fa-2x"></i>
                        </div>
                        <h5 class="card-title">إدارة المنتجات</h5>
                        <p class="card-text text-muted">
                            إضافة وتنظيم المنتجات مع إمكانية استخدامها في الفواتير بسهولة
                        </p>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-info">
                            <i class="fas fa-cog"></i> إدارة المنتجات
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-secondary text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-print fa-2x"></i>
                        </div>
                        <h5 class="card-title">طباعة احترافية</h5>
                        <p class="card-text text-muted">
                            طباعة الفواتير وكشوف الحسابات بتصميم احترافي وجودة عالية
                        </p>
                        <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-list"></i> قائمة الفواتير
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-dark text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-chart-bar fa-2x"></i>
                        </div>
                        <h5 class="card-title">كشوف الحسابات</h5>
                        <p class="card-text text-muted">
                            عرض تفصيلي لحركة كل عميل مع إمكانية الطباعة والمتابعة المستمرة
                        </p>
                        <a href="<?php echo e(route('payments.index')); ?>" class="btn btn-outline-dark">
                            <i class="fas fa-list-alt"></i> التحصيلات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="display-6 fw-bold mb-3">ابدأ الآن في إدارة أعمالك بكفاءة</h3>
                <p class="lead mb-0">
                    نظام الرضوان يوفر لك كل الأدوات اللازمة لإدارة العملاء والفواتير والتحصيلات بطريقة احترافية ومنظمة
                </p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus"></i> إضافة عميل جديد
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.hero-logo {
    max-width: 150px;
    height: auto;
    filter: brightness(0) invert(1);
}

.hero-content h1 {
    color: white !important;
}

.hero-content h2 {
    color: rgba(255, 255, 255, 0.9) !important;
}

.min-vh-75 {
    min-height: 75vh;
}

.dashboard-preview {
    transform: perspective(1000px) rotateY(-15deg);
    transition: transform 0.3s ease;
}

.dashboard-preview:hover {
    transform: perspective(1000px) rotateY(0deg);
}

.stat-card {
    text-align: center;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.cta-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 60vh;
        text-align: center;
    }
    
    .hero-logo {
        max-width: 120px;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
    
    .dashboard-preview {
        transform: none;
        margin-top: 2rem;
    }
    
    .hero-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
}

@media (max-width: 576px) {
    .feature-icon {
        width: 60px;
        height: 60px;
    }
    
    .feature-icon i {
        font-size: 1.5rem !important;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ABDALLA\invoice-app-final-updated\invoice-app\resources\views/welcome.blade.php ENDPATH**/ ?>