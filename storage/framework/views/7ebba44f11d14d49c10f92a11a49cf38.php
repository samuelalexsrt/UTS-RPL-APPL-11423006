

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2>Register</h2>
        <p>Buat akun baru untuk menggunakan MediTrack.</p>
    </div>

    <div class="card">
        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <label>Name</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <label>Role</label>
            <select name="role">
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="pharmacist">Pharmacist</option>
            </select>

            <div class="form-actions">
                <button type="submit" class="button">Register</button>
                <a href="<?php echo e(route('login')); ?>" class="button button-secondary">Login</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views/auth/register.blade.php ENDPATH**/ ?>