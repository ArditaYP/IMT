<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Role Akses (Client Admin)</h1>
</div>

<?php if(session('success')): ?>
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah Client Admin -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Buat Akses Client Baru</h2>
        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Instansi / HR</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Login</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">Buat Akses</button>
        </form>
    </div>

    <!-- Tabel Daftar Client Admin -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-700"><?php echo e($user->name); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($user->role === 'super_admin'): ?>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold">Super Admin</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">Client Admin</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <?php if($user->role !== 'super_admin'): ?>
                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="text-indigo-600 hover:text-indigo-900 font-medium mr-3">Edit</a>
                            <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Hapus akses pengguna ini? Grup yang dimiliki tidak akan terhapus namun akan kehilangan pemiliknya.');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/users/index.blade.php ENDPATH**/ ?>