<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMT Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
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
<body class="flex">
    
    <!-- Sidebar -->
    <aside class="sidebar w-64 flex-shrink-0 fixed h-full">
        <div class="brand">IMT <span>ADMIN</span></div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.questions') }}" class="{{ request()->routeIs('admin.questions*') ? 'active' : '' }}">Bank Soal</a>
            <a href="{{ route('admin.assessments') }}" class="{{ request()->routeIs('admin.assessments*') ? 'active' : '' }}">Jawaban User</a>
            <a href="{{ route('admin.payments') }}" class="{{ request()->routeIs('admin.payments*') ? 'active' : '' }}">Data Pembayaran</a>
            <a href="{{ route('home') }}" class="mt-8 opacity-75 hover:opacity-100">← Ke Halaman Depan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
