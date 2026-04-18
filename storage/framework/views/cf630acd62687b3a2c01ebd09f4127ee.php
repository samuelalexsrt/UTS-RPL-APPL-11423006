

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2><?php echo e(isset($payment) ? 'Edit Pembayaran' : 'Tambah Pembayaran'); ?></h2>
    </div>

    <div class="card">
        <form action="<?php echo e(isset($payment) ? route('payments.update', $payment) : route('payments.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($payment)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label>Appointment</label>
            <select name="appointment_id" required>
                <option value="">Pilih appointment</option>
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($appointment->id); ?>" <?php echo e(old('appointment_id', $payment->appointment_id ?? '') == $appointment->id ? 'selected' : ''); ?>><?php echo e($appointment->patient?->name); ?> - <?php echo e($appointment->scheduled_at->format('Y-m-d H:i')); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Amount</label>
            <input type="number" step="0.01" name="amount" value="<?php echo e(old('amount', $payment->amount ?? '')); ?>" min="0" required>

            <label>Status</label>
            <select name="status" required>
                <?php $__currentLoopData = ['pending','paid','failed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php echo e(old('status', $payment->status ?? 'pending') === $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Notes</label>
            <textarea name="notes"><?php echo e(old('notes', $payment->notes ?? '')); ?></textarea>

            <div class="form-actions">
                <button type="submit" class="button"><?php echo e(isset($payment) ? 'Update' : 'Save'); ?></button>
                <a href="<?php echo e(route('payments.index')); ?>" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\payment-form.blade.php ENDPATH**/ ?>