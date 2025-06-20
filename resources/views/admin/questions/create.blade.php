@extends('layouts.admin')

@section('title', 'Tambah Pertanyaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pertanyaan</h2>

    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

{{-- Di create.blade.php, setelah @csrf dan sebelum input pertama --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Oops! Ada beberapa masalah:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Anda juga bisa menambahkan error spesifik di bawah setiap input --}}
<div class="mb-4">
    <label for="number" class="block font-medium text-gray-700 mb-1">Nomor Pertanyaan</label>
    <input type="number" name="number" id="number" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('number') }}">
    @error('number')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Ulangi untuk 'question', 'background', dan 'answers' --}}

        

        {{-- Teks Pertanyaan --}}
        <div class="mb-4">
            <label for="question" class="block font-medium text-gray-700 mb-1">Teks Pertanyaan</label>
            <textarea name="question" id="question" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        {{-- Upload Background --}}
        <div class="mb-4">
            <label for="background" class="block font-medium text-gray-700 mb-1">Gambar Background (opsional)</label>
            <input type="file" name="background" id="background" class="w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700">
        </div>

        {{-- Jawaban per Spirit --}}
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-2">Jawaban untuk masing-masing Spirit</label>
            @foreach($spirits as $spirit)
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 font-semibold mb-1">
                        {{ $spirit->spirit }} <span class="text-xs text-gray-400">({{ $spirit->code }})</span>
                    </label>
                    <input type="text" name="answers[{{ $spirit->id }}]" placeholder="Jawaban untuk {{ $spirit->spirit }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            @endforeach
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
            <a href="{{ route('questions.index') }}" class="bg-gray-400 text-white font-semibold px-4 py-2 rounded hover:bg-gray-500 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
