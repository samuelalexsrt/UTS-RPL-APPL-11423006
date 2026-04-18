

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Payment Transactions</h2>
            <p>Catat pembayaran pasien dan klaim asuransi.</p>
        </div>
        <a class="button" href="<?php echo e(route('payments.create')); ?>">Tambah Pembayaran</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($payment->patient?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($payment->appointment?->scheduled_at?->format('Y-m-d') ?? 'N/A'); ?></td>
                        <td>Rp <?php echo e(number_format($payment->amount, 2, ',', '.')); ?></td>
                        <td><?php echo e(ucfirst($payment->status)); ?></td>
                        <td><?php echo e(Str::limit($payment->notes, 80)); ?></td>
                        <td>
                            <a href="<?php echo e(route('payments.edit', $payment)); ?>">Edit</a>
                            <form action="<?php echo e(route('payments.destroy', $payment)); ?>" method="POST" style="display:inline-block; margin-left:10px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus pembayaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">Tidak ada transaksi pembayaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\payments.blade.php ENDPATH**/ ?>