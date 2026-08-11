<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Grup</h1>
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700">Buat Grup Baru</h2>
        <form action="<?php echo e(route('admin.groups.store')); ?>" method="POST" class="mt-4 flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Grup / Perusahaan</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: PT. Maju Jaya" required>
                </div>
                <div style="width: 100px;">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kuota</label>
                    <input type="number" name="quota" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="1" min="1" required>
                </div>
                <div style="width: 200px;">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Visibilitas Laporan</label>
                    <select name="report_visibility" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="admin_only">Hanya Admin</option>
                        <option value="individual">Individu (Bisa Lihat)</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Waktu Mulai (Opsional)</label>
                    <input type="datetime-local" name="start_time" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Batas Akhir (Opsional)</label>
                    <input type="datetime-local" name="end_time" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold h-[42px] leading-[26px]">Buat</button>
            </div>
        </form>
        <?php if($errors->any()): ?>
            <div class="mt-3 text-red-500 text-sm">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>- <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                <th class="p-4 border-b">Nama Grup</th>
                <th class="p-4 border-b">Kode Akses</th>
                <th class="p-4 border-b">Waktu Akses</th>
                <th class="p-4 border-b">Kuota / Peserta</th>
                <th class="p-4 border-b">Visibilitas</th>
                <th class="p-4 border-b">Status</th>
                <th class="p-4 border-b text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800"><?php echo e($group->name); ?></td>
                    <td class="p-4">
                        <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded inline-block font-mono tracking-wider font-bold">
                            <?php echo e($group->code); ?>

                        </div>
                    </td>
                    <td class="p-4 text-xs text-gray-600">
                        <?php if($group->start_time || $group->end_time): ?>
                            <div>Mulai: <?php echo e($group->start_time ? $group->start_time->format('d M Y, H:i') : '-'); ?></div>
                            <div>Batas: <span class="<?php echo e($group->end_time && now()->gt($group->end_time) ? 'text-red-600 font-bold' : ''); ?>"><?php echo e($group->end_time ? $group->end_time->format('d M Y, H:i') : '-'); ?></span></div>
                        <?php else: ?>
                            <span class="text-gray-400 italic">Tanpa batas waktu</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <?php $isFull = $group->assessments_count >= $group->quota; ?>
                        <span class="font-bold <?php echo e($isFull ? 'text-red-600' : 'text-green-600'); ?>"><?php echo e($group->assessments_count); ?></span> 
                        <span class="text-gray-500">/ <?php echo e($group->quota); ?></span>
                    </td>
                    <td class="p-4">
                        <?php if($group->report_visibility === 'admin_only'): ?>
                            <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-semibold">Admin Saja</span>
                        <?php else: ?>
                            <span class="bg-teal-100 text-teal-700 px-2 py-1 rounded text-xs font-semibold">Individu (Publik)</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <?php if($group->is_active): ?>
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Aktif</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-right space-x-2">
                        <?php if($group->assessments_count > 0): ?>
                            <a href="<?php echo e(route('admin.groups.report', $group->id)); ?>" target="_blank" class="text-indigo-600 hover:underline">Lihat Laporan Grup</a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('admin.groups.edit', $group->id)); ?>" class="text-blue-500 hover:underline">Edit</a>
                        
                        <form action="<?php echo e(route('admin.groups.destroy', $group->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus grup ini? Laporan individu tidak akan terhapus, tapi laporan grup ini akan hilang.')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Belum ada grup yang dibuat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/groups/index.blade.php ENDPATH**/ ?>