

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2><?php echo e(isset($appointment) ? 'Edit Appointment' : 'Buat Appointment Baru'); ?></h2>
    </div>

    <div class="card">
        <form action="<?php echo e(isset($appointment) ? route('appointments.update', $appointment) : route('appointments.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($appointment)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($patient->id); ?>" <?php echo e(old('patient_id', $appointment->patient_id ?? '') == $patient->id ? 'selected' : ''); ?>><?php echo e($patient->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">Pilih dokter</option>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($doctor->id); ?>" <?php echo e(old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id ? 'selected' : ''); ?>><?php echo e($doctor->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" value="<?php echo e(old('scheduled_at', isset($appointment) ? $appointment->scheduled_at->format('Y-m-d\TH:i') : '')); ?>" required>

            <label>Status</label>
            <select name="status" required>
                <?php $__currentLoopData = ['pending','confirmed','cancelled','completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php echo e(old('status', $appointment->status ?? 'pending') === $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Notes</label>
            <textarea name="notes"><?php echo e(old('notes', $appointment->notes ?? '')); ?></textarea>

            <div class="form-actions">
                <button type="submit" class="button"><?php echo e(isset($appointment) ? 'Update' : 'Save'); ?></button>
                <a href="<?php echo e(route('appointments.index')); ?>" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\appointment-form.blade.php ENDPATH**/ ?>