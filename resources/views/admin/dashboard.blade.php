@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Assessment</h3>
        <p class="text-4xl font-extrabold text-blue-900">{{ $totalAssessments }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Pertanyaan (Bank Soal)</h3>
        <p class="text-4xl font-extrabold text-blue-900">{{ $totalQuestions }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Pendapatan (IDR)</h3>
        <p class="text-4xl font-extrabold text-green-600">Rp {{ number_format($totalPayments, 0, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Selamat datang di Admin Panel IMT Discovery</h2>
    <p class="text-gray-500">Gunakan menu di sebelah kiri untuk mengelola soal, melihat jawaban pengguna, atau memantau transaksi pembayaran.</p>
</div>
@endsection
