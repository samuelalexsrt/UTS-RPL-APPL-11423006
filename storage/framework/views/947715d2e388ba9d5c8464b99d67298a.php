

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Appointment Scheduling</h2>
            <p>Kelola jadwal pasien dan dokter secara terpusat.</p>
        </div>
        <a class="button" href="<?php echo e(route('appointments.create')); ?>">Buat Janji Baru</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Scheduled</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($appointment->patient?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($appointment->doctor?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($appointment->scheduled_at->format('Y-m-d H:i')); ?></td>
                        <td><?php echo e(ucfirst($appointment->status)); ?></td>
                        <td><?php echo e(Str::limit($appointment->notes, 80)); ?></td>
                        <td>
                            <a href="<?php echo e(route('appointments.edit', $appointment)); ?>">Edit</a>
                            <form action="<?php echo e(route('appointments.destroy', $appointment)); ?>" method="POST" style="display:inline-block; margin-left:10px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus janji temu ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">Tidak ada janji temu tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\appointments.blade.php ENDPATH**/ ?>