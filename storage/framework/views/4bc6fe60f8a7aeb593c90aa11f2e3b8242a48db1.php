<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.questions')); ?>" class="text-gray-500 hover:text-gray-800 font-medium">← Kembali ke Bank Soal</a>
    <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Soal #<?php echo e($question->order); ?></h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-2xl">
    <form action="<?php echo e(route('admin.questions.update', $question->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Driver Utama</label>
                <input type="text" disabled value="<?php echo e($question->driver ? $question->driver->name : 'General'); ?>" class="w-full bg-gray-100 border border-gray-300 text-gray-600 rounded-lg px-4 py-2 cursor-not-allowed">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Sub Driver</label>
                <input type="text" disabled value="<?php echo e($question->subDriver ? $question->subDriver->name : '-'); ?>" class="w-full bg-gray-100 border border-gray-300 text-gray-600 rounded-lg px-4 py-2 cursor-not-allowed">
            </div>
        </div>
        <p class="text-xs text-gray-400 mb-6 -mt-4">Driver dan Sub Driver tidak dapat diubah agar tidak merusak kalkulasi hasil.</p>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Teks Pertanyaan</label>
            <textarea name="question_text" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required><?php echo e(old('question_text', $question->question_text)); ?></textarea>
            <?php $__errorArgs = ['question_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Soal</label>
            <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="core" <?php echo e(old('type', $question->type) === 'core' ? 'selected' : ''); ?>>Core</option>
                <option value="reverse core" <?php echo e(old('type', $question->type) === 'reverse core' ? 'selected' : ''); ?>>Reverse Core</option>
                <option value="consistency" <?php echo e(old('type', $question->type) === 'consistency' ? 'selected' : ''); ?>>Consistency</option>
                <option value="authenticity" <?php echo e(old('type', $question->type) === 'authenticity' ? 'selected' : ''); ?>>Authenticity</option>
                <option value="module_consistency" <?php echo e(old('type', $question->type) === 'module_consistency' ? 'selected' : ''); ?>>Module Consistency</option>
                <option value="module_authenticity" <?php echo e(old('type', $question->type) === 'module_authenticity' ? 'selected' : ''); ?>>Module Authenticity</option>
            </select>
            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Order (Nomor Urut)</label>
                <input type="number" name="order" value="<?php echo e(old('order', $question->order)); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="is_active" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" <?php echo e(old('is_active', $question->is_active) ? 'selected' : ''); ?>>Aktif</option>
                    <option value="0" <?php echo e(!old('is_active', $question->is_active) ? 'selected' : ''); ?>>Tidak Aktif</option>
                </select>
                <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/questions/edit.blade.php ENDPATH**/ ?>