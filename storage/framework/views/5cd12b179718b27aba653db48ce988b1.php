

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2><?php echo e(isset($item) ? 'Edit Stock Item' : 'Tambah Stock Item'); ?></h2>
    </div>

    <div class="card">
        <form action="<?php echo e(isset($item) ? route('pharmacy.update', $item) : route('pharmacy.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($item)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label>Name</label>
            <input type="text" name="name" value="<?php echo e(old('name', $item->name ?? '')); ?>" required>

            <label>Description</label>
            <textarea name="description"><?php echo e(old('description', $item->description ?? '')); ?></textarea>

            <label>Quantity</label>
            <input type="number" name="quantity" value="<?php echo e(old('quantity', $item->quantity ?? 0)); ?>" min="0" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $item->price ?? 0)); ?>" min="0" required>

            <div class="form-actions">
                <button type="submit" class="button"><?php echo e(isset($item) ? 'Update' : 'Save'); ?></button>
                <a href="<?php echo e(route('pharmacy.index')); ?>" class="button button-secondary">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\pharmacy-form.blade.php ENDPATH**/ ?>