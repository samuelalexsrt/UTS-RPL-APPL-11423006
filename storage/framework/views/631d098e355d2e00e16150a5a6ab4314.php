

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2><?php echo e(isset($record) ? 'Edit EHR' : 'Tambah Catatan Kesehatan'); ?></h2>
    </div>

    <div class="card">
        <form action="<?php echo e(isset($record) ? route('ehr.update', $record) : route('ehr.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($record)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($patient->id); ?>" <?php echo e(old('patient_id', $record->patient_id ?? '') == $patient->id ? 'selected' : ''); ?>><?php echo e($patient->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">Pilih dokter</option>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($doctor->id); ?>" <?php echo e(old('doctor_id', $record->doctor_id ?? '') == $doctor->id ? 'selected' : ''); ?>><?php echo e($doctor->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Record Type</label>
            <input type="text" name="record_type" value="<?php echo e(old('record_type', $record->record_type ?? '')); ?>" required>

            <label>Visit Date</label>
            <input type="date" name="visit_date" value="<?php echo e(old('visit_date', isset($record) ? $record->visit_date->format('Y-m-d') : '')); ?>" required>

            <label>Details</label>
            <textarea name="details" required><?php echo e(old('details', $record->details ?? '')); ?></textarea>

            <div class="form-actions">
                <button type="submit" class="button"><?php echo e(isset($record) ? 'Update' : 'Save'); ?></button>
                <a href="<?php echo e(route('ehr.index')); ?>" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\ehr-form.blade.php ENDPATH**/ ?>