@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Bank Soal (Questions)</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No / Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Driver</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Driver</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($questions as $q)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-700">{{ $q->order }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-bold uppercase">{{ $q->driver ? $q->driver->name : 'General' }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md text-xs font-bold">{{ $q->subDriver ? $q->subDriver->name : '-' }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $q->type }}</td>
                <td class="px-6 py-4 text-gray-800">{{ $q->question_text }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($q->is_active)
                        <span class="text-green-600 font-bold text-xs">Aktif</span>
                    @else
                        <span class="text-red-500 font-bold text-xs">Tidak Aktif</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('admin.questions.edit', $q->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
