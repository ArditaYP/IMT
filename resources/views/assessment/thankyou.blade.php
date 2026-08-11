<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Asesmen Selesai - IMT Discovery™</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg text-center border border-slate-100">
        <div class="mb-6 flex justify-center">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-slate-800 mb-3">Terima Kasih, {{ $assessment->name }}!</h2>
        <p class="text-slate-600 mb-6 text-sm leading-relaxed">
            Hasil asesmen Anda telah berhasil disimpan dan dikirimkan secara aman ke Admin grup Anda (<strong>{{ $group->name }}</strong>).
        </p>
        
        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl mb-8">
            <p class="text-slate-500 text-xs text-left flex items-start gap-3">
                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span>Berdasarkan pengaturan privasi dari pembuat grup, akses penayangan laporan Anda dibatasi dan hanya dapat dilihat secara eksklusif oleh Admin Grup terkait.</span>
            </p>
        </div>

        <a href="{{ route('home') }}" class="block w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold py-3 px-6 rounded-xl transition duration-200">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
