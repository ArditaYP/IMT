@extends('admin.layout')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <a href="{{ route('admin.groups') }}" class="text-blue-600 hover:underline text-sm font-semibold mb-2 inline-block">← Kembali ke Grup</a>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Anggota: {{ $group->name }}</h1>
        <p class="text-gray-600">Kode Akses: <span class="font-mono font-bold">{{ $group->code }}</span> | Total Peserta: {{ $members->count() }}</p>
    </div>
    @if($members->count() > 0)
        <a href="{{ route('admin.groups.report', $group->id) }}" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-semibold shadow-sm">Lihat Laporan Agregat Grup</a>
    @endif
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                <th class="p-4 border-b">Nama Peserta</th>
                <th class="p-4 border-b">Email / Kontak</th>
                <th class="p-4 border-b">Waktu Submit</th>
                <th class="p-4 border-b">Durasi</th>
                <th class="p-4 border-b">Skor (Top Driver)</th>
                <th class="p-4 border-b text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($members as $m)
                @php
                    $scores = [
                        'Security' => $m->security_score,
                        'Significance' => $m->significance_score,
                        'Connection' => $m->connection_score,
                        'Growth' => $m->growth_score,
                        'Contribution' => $m->contribution_score,
                    ];
                    arsort($scores);
                    $topDriver = array_key_first($scores);
                    $topScore = $scores[$topDriver];
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800">{{ $m->name }}</td>
                    <td class="p-4 text-gray-600">{{ $m->email ?? '-' }} <br> <span class="text-xs text-gray-400">{{ $m->whatsapp ?? '' }}</span></td>
                    <td class="p-4 text-gray-600">{{ $m->created_at->format('d M Y, H:i') }}</td>
                    <td class="p-4 text-gray-600">
                        @if($m->duration_seconds)
                            {{ floor($m->duration_seconds / 60) }}m {{ $m->duration_seconds % 60 }}s
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-4">
                        <span class="font-bold text-gray-800">{{ $topDriver }}</span> <span class="text-gray-500">({{ $topScore }})</span>
                    </td>
                    <td class="p-4 text-right">
                        @if(auth()->user()->role === 'super_admin' || $group->client_can_view_reports)
                            <a href="{{ route('assessment.laporan', $m->id) }}" target="_blank" class="bg-teal-50 text-teal-700 border border-teal-200 px-3 py-1 rounded hover:bg-teal-100 font-semibold text-xs">Lihat Laporan Individu</a>
                        @else
                            <button disabled title="Hubungi Super Admin untuk membuka akses laporan individu" class="bg-gray-100 text-gray-400 border border-gray-200 px-3 py-1 rounded font-semibold text-xs cursor-not-allowed">
                                🔒 Laporan Terkunci
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Belum ada peserta yang mengisi menggunakan kode grup ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
