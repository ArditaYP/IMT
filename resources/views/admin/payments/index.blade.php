@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Pembayaran (Transactions)</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Bayar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Tes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($payments as $p)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ \Carbon\Carbon::parse($p->assessment_date)->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $p->user_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-bold">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $p->payment_method ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($p->status === 'success')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Berhasil</span>
                    @elseif($p->status === 'failed')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Gagal</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi pembayaran.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
