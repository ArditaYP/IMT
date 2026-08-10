@extends('admin.layout')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.questions') }}" class="text-gray-500 hover:text-gray-800 font-medium">← Kembali ke Bank Soal</a>
    <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Soal #{{ $question->order }}</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-2xl">
    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Driver Utama</label>
            <input type="text" disabled value="{{ $question->driver ? $question->driver->name : 'General' }}" class="w-full bg-gray-100 border border-gray-300 text-gray-600 rounded-lg px-4 py-2 cursor-not-allowed">
            <p class="text-xs text-gray-400 mt-1">Driver tidak dapat diubah agar tidak merusak kalkulasi hasil.</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Teks Pertanyaan</label>
            <textarea name="question_text" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('question_text', $question->question_text) }}</textarea>
            @error('question_text')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Order (Nomor Urut)</label>
                <input type="number" name="order" value="{{ old('order', $question->order) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('order')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="is_active" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ old('is_active', $question->is_active) ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !old('is_active', $question->is_active) ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('is_active')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
