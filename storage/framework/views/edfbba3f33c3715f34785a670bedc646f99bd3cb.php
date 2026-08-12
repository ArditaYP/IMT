<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Jawaban User (Assessments)</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Tes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Utama (Sec | Sig | Con | Gro | Cnt)</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?php echo e($a->created_at->format('d M Y, H:i')); ?></td>
                <td class="px-6 py-4 font-semibold text-gray-800"><?php echo e($a->name); ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">
                    <span class="inline-block w-8 text-blue-600 font-bold"><?php echo e($a->security_score); ?></span> | 
                    <span class="inline-block w-8 text-orange-500 font-bold"><?php echo e($a->significance_score); ?></span> | 
                    <span class="inline-block w-8 text-green-500 font-bold"><?php echo e($a->connection_score); ?></span> | 
                    <span class="inline-block w-8 text-indigo-500 font-bold"><?php echo e($a->growth_score); ?></span> | 
                    <span class="inline-block w-8 text-purple-600 font-bold"><?php echo e($a->contribution_score); ?></span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                    <?php if($a->duration_seconds): ?>
                        <?php echo e(floor($a->duration_seconds / 60)); ?>m <?php echo e($a->duration_seconds % 60); ?>s
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="<?php echo e(route('assessment.laporan', $a->id)); ?>" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-medium mr-3">Lihat Laporan ↗</a>
                    <form action="<?php echo e(route('admin.assessments.destroy', $a->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jawaban ini? Tindakan ini tidak dapat dibatalkan.');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada peserta tes.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/assessments/index.blade.php ENDPATH**/ ?>