@extends('admin.layout')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.groups') }}" class="text-gray-500 hover:text-gray-800 font-bold text-xl">←</a>
    <h1 class="text-2xl font-bold text-gray-800">Edit Grup: {{ $group->name }}</h1>
</div>

<div class="bg-white rounded shadow-sm border border-gray-200 p-6 max-w-2xl">
    <form action="{{ route('admin.groups.update', $group->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Kode Akses</label>
            <input type="text" value="{{ $group->code }}" class="w-full px-4 py-2 border rounded bg-gray-100 text-gray-500 cursor-not-allowed font-mono" disabled>
            <div class="text-xs text-gray-400 mt-1">Kode akses tidak bisa diubah karena digunakan untuk URL undangan.</div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Nama Grup / Perusahaan</label>
            <input type="text" name="name" value="{{ old('name', $group->name) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Industri</label>
            <select name="industry" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Industri --</option>
                @php
                    $industries = ['Teknologi & TI', 'Agensi Digital & Kreatif', 'Keuangan & Perbankan', 'Pendidikan & Pelatihan', 'Kesehatan & Medis', 'Manufaktur & Industri', 'Ritel & E-Commerce', 'Konstruksi & Properti', 'Logistik & Transportasi', 'Pariwisata & Perhotelan', 'F&B (Food & Beverage)', 'Pertambangan & Energi', 'Pelayanan Publik & Pemerintahan', 'Layanan Profesional', 'Lainnya'];
                @endphp
                @foreach($industries as $ind)
                    <option value="{{ $ind }}" {{ old('industry', $group->industry) === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1">Pemilik Grup (Client Admin)</label>
                <select name="user_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Tidak Ada / Kosong --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('user_id', $group->user_id) == $client->id ? 'selected' : '' }}>{{ $client->name }} ({{ $client->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Kuota Peserta</label>
                <input type="number" name="quota" value="{{ old('quota', $group->quota) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Visibilitas</label>
                <select name="report_visibility" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="admin_only" {{ old('report_visibility', $group->report_visibility) == 'admin_only' ? 'selected' : '' }}>Hanya Admin</option>
                    <option value="individual" {{ old('report_visibility', $group->report_visibility) == 'individual' ? 'selected' : '' }}>Individu (Bisa Lihat)</option>
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Upload Logo Perusahaan (Maks 2MB)</label>
            @if($group->logo_path)
                <div class="mb-2">
                    <img src="{{ Storage::url($group->logo_path) }}" alt="Logo" class="h-12 w-auto object-contain rounded border p-1 bg-white">
                    <span class="text-xs text-gray-500 ml-2">Logo saat ini</span>
                </div>
            @endif
            <input type="file" name="logo" accept="image/*" class="w-full px-4 py-1.5 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Waktu Mulai (Opsional)</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time', $group->start_time ? $group->start_time->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Batas Akhir (Opsional)</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time', $group->end_time ? $group->end_time->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="mb-6 space-y-4">
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $group->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Grup Aktif</span>
                </label>
                <div class="text-xs text-gray-400 mt-1 ml-7">Jika dinonaktifkan, peserta tidak bisa mendaftar menggunakan kode grup ini, meskipun batas waktu masih ada.</div>
            </div>
            
            @if(auth()->user()->isSuperAdmin())
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="client_can_view_reports" value="1" {{ old('client_can_view_reports', $group->client_can_view_reports) ? 'checked' : '' }} class="w-5 h-5 text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Berikan Akses Laporan Individu ke Client Admin</span>
                </label>
                <div class="text-xs text-gray-400 mt-1 ml-7">Jika dicentang, Client Admin pemilik grup ini bisa membuka dan membaca hasil laporan psikologi tiap peserta. Jika tidak dicentang, mereka hanya bisa melihat Laporan Grup.</div>
            </div>
            @endif
        </div>

        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Simpan Perubahan</button>
            <a href="{{ route('admin.groups') }}" class="px-6 py-2 border rounded text-gray-600 hover:bg-gray-50 font-semibold">Batal</a>
        </div>
    </form>
</div>
@endsection
