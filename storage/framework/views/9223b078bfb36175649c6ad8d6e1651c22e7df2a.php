<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <div>
        <a href="<?php echo e(route('admin.groups')); ?>" class="text-blue-600 hover:underline text-sm font-semibold mb-2 inline-block">← Kembali ke Grup</a>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Anggota: <?php echo e($group->name); ?></h1>
        <p class="text-gray-600">Kode Akses: <span class="font-mono font-bold"><?php echo e($group->code); ?></span> | Total Peserta: <?php echo e($members->count()); ?></p>
    </div>
    <?php if($members->count() > 0): ?>
        <a href="<?php echo e(route('admin.groups.report', $group->id)); ?>" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-semibold shadow-sm">Lihat Laporan Agregat Grup</a>
    <?php endif; ?>
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                <th class="p-4 border-b">Nama Peserta</th>
                <th class="p-4 border-b">Email / Kontak</th>
                <th class="p-4 border-b">Waktu Submit</th>
                <th class="p-4 border-b">Durasi</th>
                <th class="p-4 border-b">Skor (Top Driver)</th>
                <th class="p-4 border-b text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $scores = [
                        'Security' => $m->security_score,
                        'Significance' => $m->significance_score,
                        'Connection' => $m->connection_score,
                        'Growth' => $m->growth_score,
                        'Contribution' => $m->contribution_score,
                    ];
                    arsort($scores);
                    $topDriver = array_key_first($scores);
                    $topScore = $scores[$topDriver];
                ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800"><?php echo e($m->name); ?></td>
                    <td class="p-4 text-gray-600"><?php echo e($m->email ?? '-'); ?> <br> <span class="text-xs text-gray-400"><?php echo e($m->whatsapp ?? ''); ?></span></td>
                    <td class="p-4 text-gray-600"><?php echo e($m->created_at->format('d M Y, H:i')); ?></td>
                    <td class="p-4 text-gray-600">
                        <?php if($m->duration_seconds): ?>
                            <?php echo e(floor($m->duration_seconds / 60)); ?>m <?php echo e($m->duration_seconds % 60); ?>s
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <span class="font-bold text-gray-800"><?php echo e($topDriver); ?></span> <span class="text-gray-500">(<?php echo e($topScore); ?>)</span>
                    </td>
                    <td class="p-4 text-right">
                        <?php if(auth()->user()->role === 'super_admin' || $group->client_can_view_reports): ?>
                            <a href="<?php echo e(route('assessment.laporan', $m->id)); ?>" target="_blank" class="bg-teal-50 text-teal-700 border border-teal-200 px-3 py-1 rounded hover:bg-teal-100 font-semibold text-xs">Lihat Laporan Individu</a>
                        <?php else: ?>
                            <button disabled title="Hubungi Super Admin untuk membuka akses laporan individu" class="bg-gray-100 text-gray-400 border border-gray-200 px-3 py-1 rounded font-semibold text-xs cursor-not-allowed">
                                🔒 Laporan Terkunci
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Belum ada peserta yang mengisi menggunakan kode grup ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/groups/members.blade.php ENDPATH**/ ?>