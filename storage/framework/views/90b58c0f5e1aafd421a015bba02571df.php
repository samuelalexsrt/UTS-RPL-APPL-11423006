

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h2>Electronic Health Records</h2>
            <p>Catat riwayat medis pasien dan kunjungan dokter.</p>
        </div>
        <a class="button" href="<?php echo e(route('ehr.create')); ?>">Tambah EHR</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Type</th>
                    <th>Visit Date</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($record->patient?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($record->doctor?->name ?? 'Unknown'); ?></td>
                        <td><?php echo e(ucfirst($record->record_type)); ?></td>
                        <td><?php echo e($record->visit_date->format('Y-m-d')); ?></td>
                        <td><?php echo e(Str::limit($record->details, 80)); ?></td>
                        <td>
                            <a href="<?php echo e(route('ehr.edit', $record)); ?>">Edit</a>
                            <form action="<?php echo e(route('ehr.destroy', $record)); ?>" method="POST" style="display:inline-block; margin-left:10px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" onclick="return confirm('Hapus catatan kesehatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">Tidak ada data EHR.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\ehr.blade.php ENDPATH**/ ?>