<?php $__env->startSection('content'); ?>
<div class="mb-6 flex items-center gap-4">
    <a href="<?php echo e(route('admin.groups')); ?>" class="text-gray-500 hover:text-gray-800 font-bold text-xl">←</a>
    <h1 class="text-2xl font-bold text-gray-800">Edit Grup: <?php echo e($group->name); ?></h1>
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 p-6 max-w-2xl">
    <form action="<?php echo e(route('admin.groups.update', $group->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Kode Akses</label>
            <input type="text" value="<?php echo e($group->code); ?>" class="w-full px-4 py-2 border rounded bg-gray-100 text-gray-500 cursor-not-allowed font-mono" disabled>
            <div class="text-xs text-gray-400 mt-1">Kode akses tidak bisa diubah karena digunakan untuk URL undangan.</div>
        </div>
        
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Grup / Perusahaan</label>
                <input type="text" name="name" value="<?php echo e(old('name', $group->name)); ?>" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Kuota Peserta</label>
                <input type="number" name="quota" value="<?php echo e(old('quota', $group->quota)); ?>" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Visibilitas</label>
                <select name="report_visibility" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="admin_only" <?php echo e(old('report_visibility', $group->report_visibility) == 'admin_only' ? 'selected' : ''); ?>>Hanya Admin</option>
                    <option value="individual" <?php echo e(old('report_visibility', $group->report_visibility) == 'individual' ? 'selected' : ''); ?>>Individu (Bisa Lihat)</option>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Waktu Mulai (Opsional)</label>
                <input type="datetime-local" name="start_time" value="<?php echo e(old('start_time', $group->start_time ? $group->start_time->format('Y-m-d\TH:i') : '')); ?>" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Batas Akhir (Opsional)</label>
                <input type="datetime-local" name="end_time" value="<?php echo e(old('end_time', $group->end_time ? $group->end_time->format('Y-m-d\TH:i') : '')); ?>" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $group->is_active) ? 'checked' : ''); ?> class="w-5 h-5 text-blue-600 rounded">
                <span class="text-sm font-medium text-gray-700">Grup Aktif</span>
            </label>
            <div class="text-xs text-gray-400 mt-1 ml-7">Jika dinonaktifkan, peserta tidak bisa mendaftar menggunakan kode grup ini, meskipun batas waktu masih ada.</div>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-4 text-red-500 text-sm">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>- <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Simpan Perubahan</button>
            <a href="<?php echo e(route('admin.groups')); ?>" class="px-6 py-2 border rounded text-gray-600 hover:bg-gray-50 font-semibold">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/groups/edit.blade.php ENDPATH**/ ?>