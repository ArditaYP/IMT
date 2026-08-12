@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Grup</h1>
</div>

@if(auth()->user()->isSuperAdmin())
<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-700">Buat Grup Baru</h2>
        <form action="{{ route('admin.groups.store') }}" method="POST" class="mt-4 flex flex-col gap-4">
            @csrf
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Grup / Perusahaan</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: PT. Maju Jaya" required>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Pemilik (Client Admin)</label>
                    <select name="user_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Tidak Ada / Kosong --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="width: 100px;">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kuota</label>
                    <input type="number" name="quota" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="1" min="1" required>
                </div>
                <div style="width: 200px;">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Visibilitas Laporan</label>
                    <select name="report_visibility" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="admin_only">Hanya Admin</option>
                        <option value="individual">Individu (Bisa Lihat)</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Waktu Mulai (Opsional)</label>
                    <input type="datetime-local" name="start_time" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Batas Akhir (Opsional)</label>
                    <input type="datetime-local" name="end_time" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold h-[42px] leading-[26px]">Buat</button>
            </div>
        </form>
        @if ($errors->any())
            <div class="mt-3 text-red-500 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endif

<div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                <th class="p-4 border-b">Nama Grup</th>
                <th class="p-4 border-b">Kode Akses</th>
                <th class="p-4 border-b">Waktu Akses</th>
                <th class="p-4 border-b">Kuota / Peserta</th>
                <th class="p-4 border-b">Visibilitas</th>
                @if(auth()->user()->isSuperAdmin())
                <th class="p-4 border-b">Pemilik (Client)</th>
                @endif
                <th class="p-4 border-b">Status</th>
                <th class="p-4 border-b text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($groups as $group)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800">{{ $group->name }}</td>
                    <td class="p-4">
                        <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded inline-block font-mono tracking-wider font-bold">
                            {{ $group->code }}
                        </div>
                    </td>
                    <td class="p-4 text-xs text-gray-600">
                        @if($group->start_time || $group->end_time)
                            <div>Mulai: {{ $group->start_time ? $group->start_time->format('d M Y, H:i') : '-' }}</div>
                            <div>Batas: <span class="{{ $group->end_time && now()->gt($group->end_time) ? 'text-red-600 font-bold' : '' }}">{{ $group->end_time ? $group->end_time->format('d M Y, H:i') : '-' }}</span></div>
                        @else
                            <span class="text-gray-400 italic">Tanpa batas waktu</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @php $isFull = $group->assessments_count >= $group->quota; @endphp
                        <span class="font-bold {{ $isFull ? 'text-red-600' : 'text-green-600' }}">{{ $group->assessments_count }}</span> 
                        <span class="text-gray-500">/ {{ $group->quota }}</span>
                    </td>
                    <td class="p-4">
                        @if($group->report_visibility === 'admin_only')
                            <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-semibold">Admin Saja</span>
                        @else
                            <span class="bg-teal-100 text-teal-700 px-2 py-1 rounded text-xs font-semibold">Individu (Publik)</span>
                        @endif
                    </td>
                    @if(auth()->user()->isSuperAdmin())
                    <td class="p-4 text-xs font-semibold text-gray-700">
                        {{ $group->user ? $group->user->name : '-' }}
                    </td>
                    @endif
                    <td class="p-4">
                        @if($group->is_active)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Aktif</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold">Nonaktif</span>
                        @endif
                    </td>
                    <td class="p-4 text-right space-x-2">
                        @if($group->assessments_count > 0)
                            <a href="{{ route('admin.groups.members', $group->id) }}" class="text-teal-600 hover:underline">Lihat Anggota ({{ $group->assessments_count }})</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('admin.groups.report', $group->id) }}" target="_blank" class="text-indigo-600 hover:underline">Laporan Grup</a>
                        @endif
                        @if(auth()->user()->isSuperAdmin())
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('admin.groups.edit', $group->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        
                        <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus grup ini? Laporan individu tidak akan terhapus, tapi laporan grup ini akan hilang.')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">Belum ada grup yang dibuat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
