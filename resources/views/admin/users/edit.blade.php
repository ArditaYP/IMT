@extends('admin.layout')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users') }}" class="text-gray-500 hover:text-gray-800 font-medium">← Kembali ke Daftar Role Akses</a>
    <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Akses Client: {{ $user->name }}</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-xl">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Instansi / HR</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Login</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Biarkan kosong jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            @error('password')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
