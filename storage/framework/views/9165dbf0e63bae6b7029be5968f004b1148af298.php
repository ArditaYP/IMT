<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.users')); ?>" class="text-gray-500 hover:text-gray-800 font-medium">← Kembali ke Daftar Role Akses</a>
    <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Akses Client: <?php echo e($user->name); ?></h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-xl">
    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Instansi / HR</label>
            <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Login</label>
            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Biarkan kosong jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>