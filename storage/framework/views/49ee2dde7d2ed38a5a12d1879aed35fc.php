

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2>Dashboard MediTrack</h2>
        <p>Ringkasan operasi dan data klinis untuk user Anda.</p>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Appointments</h3>
            <p><?php echo e($stats['appointments'] ?? 0); ?> data</p>
        </div>
        <div class="card">
            <h3>Clinical Records</h3>
            <p><?php echo e($stats['records'] ?? $stats['prescriptions'] ?? 0); ?> data</p>
        </div>
        <div class="card">
            <h3>Payments</h3>
            <p><?php echo e($stats['payments'] ?? 0); ?> transaksi</p>
        </div>
        <div class="card">
            <h3>Pharmacy Stock</h3>
            <p><?php echo e($stats['stock_items'] ?? 0); ?> item</p>
        </div>
    </div>

    <div class="card">
        <h3>Mulai</h3>
        <p>Gunakan menu untuk membuat appointment, mencatat EHR, memperbarui stok apotek, atau memproses pembayaran.</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 6 D-IV TRPL\New folder\UTS-RPL-APPL-11423006\resources\views\dashboard.blade.php ENDPATH**/ ?>