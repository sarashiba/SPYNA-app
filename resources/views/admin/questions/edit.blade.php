@extends('layouts.admin')

@section('title', 'Edit Pertanyaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Pertanyaan</h2>

    <form action="{{ route('questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nomor Pertanyaan --}}
        <div class="mb-4">
            <label for="number" class="block font-medium text-gray-700 mb-1">Nomor Pertanyaan</label>
            <input type="number" name="number" id="number" value="{{ old('number', $question->number) }}"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Background saat ini --}}
        @if($question->background)
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Background Saat Ini</label>
            <img src="{{ asset('storage/' . $question->background) }}" alt="Background" class="w-48 rounded shadow">
        </div>
        @endif

        {{-- Upload Background Baru --}}
        <div class="mb-4">
            <label for="background" class="block font-medium mb-1">Background Gambar (opsional)</label>
            <input type="file" name="background" id="background" class="w-full border border-gray-300 rounded px-3 py-2">
            @if ($question->background)
                <p class="text-sm mt-2">Gambar saat ini: <strong>{{ $question->background }}</strong></p>
            @endif
        </div>


        {{-- Pertanyaan --}}
        <div class="mb-4">
            <label for="question" class="block font-medium text-gray-700 mb-1">Pertanyaan</label>
            <textarea name="question" id="question" rows="3"
                class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('question', $question->question) }}</textarea>
        </div>

        {{-- Jawaban --}}
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-2">Jawaban untuk masing-masing Spirit:</label>
            @foreach($spirits as $spirit)
                @php
                    $answer = $question->answers->firstWhere('spirit_id', $spirit->id);
                @endphp
                <div class="mb-3">
                    <label class="block text-sm font-semibold mb-1">
                        {{ $spirit->spirit }} ({{ $spirit->code }})
                    </label>
                    <input type="text" name="answers[{{ $spirit->id }}]"
                        value="{{ old('answers.' . $spirit->id, $answer ? $answer->answer_text : '') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
            @endforeach
        </div>


        {{-- Tombol --}}
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('questions.index') }}" class="bg-gray-400 text-white font-semibold px-4 py-2 rounded hover:bg-gray-500 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
