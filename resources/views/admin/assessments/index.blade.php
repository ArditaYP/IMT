@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Jawaban User (Assessments)</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Tes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Utama (Sec | Sig | Con | Gro | Cnt)</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($assessments as $a)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $a->created_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $a->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">
                    <span class="inline-block w-8 text-blue-600 font-bold">{{ $a->security_score }}</span> | 
                    <span class="inline-block w-8 text-orange-500 font-bold">{{ $a->significance_score }}</span> | 
                    <span class="inline-block w-8 text-green-500 font-bold">{{ $a->connection_score }}</span> | 
                    <span class="inline-block w-8 text-indigo-500 font-bold">{{ $a->growth_score }}</span> | 
                    <span class="inline-block w-8 text-purple-600 font-bold">{{ $a->contribution_score }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('assessment.laporan', $a->id) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat Laporan ↗</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada peserta tes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
