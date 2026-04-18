

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Pharmacy Stock</h2>
            <p>Kelola stok obat, harga, dan ketersediaan.</p>
        </div>
        <a class="button" href="<?php echo e(route('pharmacy.create')); ?>">Tambah Stok Obat</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e(Str::limit($item->description, 80)); ?></td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td>Rp <?php echo e(number_format($item->price, 2, ',', '.')); ?></td>
                        <td>
                            <a href="<?php echo e(route('pharmacy.edit', $item)); ?>">Edit</a>
                            <form action="<?php echo e(route('pharmacy.destroy', $item)); ?>" method="POST" style="display:inline-block; margin-left:10px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus item stok ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5">Tidak ada stok obat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\pharmacy.blade.php ENDPATH**/ ?>