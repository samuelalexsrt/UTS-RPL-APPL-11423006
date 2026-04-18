

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Prescription Orders</h2>
            <p>Cek status resep dan pengambilan obat.</p>
        </div>
        <a class="button" href="<?php echo e(route('prescriptions.create')); ?>">Buat Pesanan Resep</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($order->patient?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($order->stock?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($order->quantity); ?></td>
                        <td><?php echo e(ucfirst($order->status)); ?></td>
                        <td><?php echo e(Str::limit($order->instructions, 80)); ?></td>
                        <td>
                            <a href="<?php echo e(route('prescriptions.edit', $order)); ?>">Edit</a>
                            <form action="<?php echo e(route('prescriptions.destroy', $order)); ?>" method="POST" style="display:inline-block; margin-left:10px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus pesanan resep ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">Tidak ada pesanan resep.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\prescriptions.blade.php ENDPATH**/ ?>