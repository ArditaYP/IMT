<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMT Admin Dashboard</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fd; font-family: 'Inter', sans-serif; }
        .sidebar { background-color: #0d1b3e; min-height: 100vh; }
        .sidebar a { color: #aab2cc; padding: 12px 24px; display: block; border-left: 4px solid transparent; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: #fff; border-left-color: #e8862e; }
        .brand { font-weight: 800; color: #fff; padding: 24px; font-size: 1.25rem; letter-spacing: 1px; }
        .brand span { color: #e8862e; }
    </style>
</head>
<body class="flex bg-gray-50 h-screen overflow-hidden">
    
    <!-- Mobile Header -->
    <div class="md:hidden fixed w-full bg-blue-900 text-white z-50 flex items-center justify-between p-4 shadow-md">
        <div class="brand p-0">IMT <span>ADMIN</span></div>
        <button id="mobile-menu-btn" class="text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-64 flex-shrink-0 fixed h-full z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto pb-20">
        <div class="brand hidden md:block">IMT <span>ADMIN</span></div>
        <nav class="mt-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">Dashboard</a>
            <?php if(auth()->user()->isSuperAdmin()): ?>
            <a href="<?php echo e(route('admin.questions')); ?>" class="<?php echo e(request()->routeIs('admin.questions*') ? 'active' : ''); ?>">Bank Soal</a>
            <a href="<?php echo e(route('admin.assessments')); ?>" class="<?php echo e(request()->routeIs('admin.assessments*') ? 'active' : ''); ?>">Jawaban User</a>
            <!-- <a href="<?php echo e(route('admin.payments')); ?>" class="<?php echo e(request()->routeIs('admin.payments*') ? 'active' : ''); ?>">Data Pembayaran</a> -->
            <?php endif; ?>
            <a href="<?php echo e(route('admin.groups')); ?>" class="<?php echo e(request()->routeIs('admin.groups*') ? 'active' : ''); ?>">Manajemen Grup</a>
            <?php if(auth()->user()->isSuperAdmin()): ?>
            <a href="<?php echo e(route('admin.users')); ?>" class="<?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">Role Akses</a>
            <?php endif; ?>
            <a href="<?php echo e(route('home')); ?>" class="mt-8 opacity-75 hover:opacity-100">← Ke Halaman Depan</a>
            
            <!-- Tombol Keluar (Logout) -->
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" style="color: #ef4444; padding: 12px 24px; width: 100%; text-align: left; transition: all 0.3s;" class="hover:bg-red-900 hover:text-white mt-4 border-l-4 border-transparent hover:border-red-500">
                    ⎋ Keluar (Logout)
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 md:ml-64 p-4 md:p-8 mt-16 md:mt-0 overflow-y-auto h-full w-full">
        <?php if(session('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        btn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/layout.blade.php ENDPATH**/ ?>