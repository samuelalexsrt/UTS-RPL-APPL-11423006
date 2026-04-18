

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2>Login</h2>
        <p>Masuk untuk mengakses MediTrack.</p>
    </div>

    <div class="card">
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

            <label>Password</label>
            <input type="password" name="password" required>

            <label><input type="checkbox" name="remember"> Remember me</label>

            <div class="form-actions">
                <button type="submit" class="button">Login</button>
                <a href="<?php echo e(route('register')); ?>" class="button button-secondary">Register</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\auth\login.blade.php ENDPATH**/ ?>