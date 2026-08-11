<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold text-gray-800 mb-6">Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Assessment</h3>
        <p class="text-4xl font-extrabold text-blue-900"><?php echo e($totalAssessments); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Grup Terdaftar</h3>
        <p class="text-4xl font-extrabold text-indigo-900"><?php echo e($totalGroups); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Bank Soal</h3>
        <p class="text-4xl font-extrabold text-blue-900"><?php echo e($totalQuestions); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Pendapatan</h3>
        <p class="text-4xl font-extrabold text-green-600">Rp <?php echo e(number_format($totalPayments, 0, ',', '.')); ?></p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Selamat datang di Admin Panel IMT Discovery</h2>
    <p class="text-gray-500">Gunakan menu di sebelah kiri untuk mengelola soal, melihat jawaban pengguna, atau memantau transaksi pembayaran.</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>