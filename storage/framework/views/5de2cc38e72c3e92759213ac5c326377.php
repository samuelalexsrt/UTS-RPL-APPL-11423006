<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack</title>
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f6f8; color:#1f2937; }
        header { background:#1d4ed8; color:white; padding:16px 24px; }
        .container { max-width: 1100px; margin: 24px auto; padding: 0 16px; }
        nav a { color:white; margin-right:16px; text-decoration:none; }
        .card { background:white; border:1px solid #d1d5db; border-radius:10px; padding:20px; margin-bottom:20px; }
        .grid { display:grid; gap:16px; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); }
        .button, button { display:inline-block; padding:10px 16px; border:none; background:#1d4ed8; color:white; border-radius:8px; cursor:pointer; text-decoration:none; }
        .button-secondary { background:#6b7280; }
        form input, form select, form textarea { width:100%; padding:10px; border:1px solid #d1d5db; border-radius:8px; margin-top:6px; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:12px 10px; border-bottom:1px solid #e5e7eb; text-align:left; }
        th { background:#f8fafc; }
        .flash { padding:12px 16px; border-radius:8px; margin-bottom:16px; }
        .flash-success { background:#dcfce7; color:#166534; }
        .flash-error { background:#fee2e2; color:#991b1b; }
        .form-actions { display:flex; gap:12px; flex-wrap:wrap; margin-top:12px; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="/" style="font-weight:bold; font-size:1.1rem; color:white;">MediTrack</a>
            <?php if(auth()->guard()->check()): ?>
                <nav style="display:inline-block; margin-left:32px;">
                    <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    <a href="<?php echo e(route('appointments.index')); ?>">Appointments</a>
                    <a href="<?php echo e(route('ehr.index')); ?>">EHR</a>
                    <a href="<?php echo e(route('pharmacy.index')); ?>">Pharmacy</a>
                    <a href="<?php echo e(route('prescriptions.index')); ?>">Prescriptions</a>
                    <a href="<?php echo e(route('payments.index')); ?>">Payments</a>
                </nav>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline-block; float:right;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="button button-secondary">Logout</button>
                </form>
            <?php else: ?>
                <nav style="display:inline-block; margin-left:32px;">
                    <a href="<?php echo e(route('login')); ?>">Login</a>
                    <a href="<?php echo e(route('register')); ?>">Register</a>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="flash flash-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="flash flash-error">
                <strong>Perbaiki kesalahan berikut:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views/layouts/app.blade.php ENDPATH**/ ?>