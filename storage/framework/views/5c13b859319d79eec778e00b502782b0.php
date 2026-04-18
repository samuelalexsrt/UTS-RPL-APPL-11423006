

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2><?php echo e(isset($prescription) ? 'Edit Pesanan Resep' : 'Buat Pesanan Resep'); ?></h2>
    </div>

    <div class="card">
        <form action="<?php echo e(isset($prescription) ? route('prescriptions.update', $prescription) : route('prescriptions.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($prescription)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label>Patient</label>
            <select name="patient_id" required>
                <option value="">Pilih pasien</option>
                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($patient->id); ?>" <?php echo e(old('patient_id', $prescription->patient_id ?? '') == $patient->id ? 'selected' : ''); ?>><?php echo e($patient->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Medicine</label>
            <select name="pharmacy_stock_id" required>
                <option value="">Pilih obat</option>
                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($stock->id); ?>" <?php echo e(old('pharmacy_stock_id', $prescription->pharmacy_stock_id ?? '') == $stock->id ? 'selected' : ''); ?>><?php echo e($stock->name); ?> (<?php echo e($stock->quantity); ?> available)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Quantity</label>
            <input type="number" name="quantity" min="1" value="<?php echo e(old('quantity', $prescription->quantity ?? 1)); ?>" required>

            <?php if(isset($prescription)): ?>
                <label>Status</label>
                <select name="status" required>
                    <?php $__currentLoopData = ['pending','approved','fulfilled','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php echo e(old('status', $prescription->status ?? '') === $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php endif; ?>

            <label>Instructions</label>
            <textarea name="instructions"><?php echo e(old('instructions', $prescription->instructions ?? '')); ?></textarea>

            <div class="form-actions">
                <button type="submit" class="button"><?php echo e(isset($prescription) ? 'Update' : 'Save'); ?></button>
                <a href="<?php echo e(route('prescriptions.index')); ?>" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\prescription-form.blade.php ENDPATH**/ ?>