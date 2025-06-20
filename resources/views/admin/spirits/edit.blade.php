@extends('layouts.admin')

@section('title', 'Edit Spirit')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Spirit</h2>
    <form action="{{ route('spirits.update', $spirit->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Code</label>
            <input type="text" name="code" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('code') {{-- Tambahkan ini --}}
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Spirit</label>
            <input type="text" name="spirit" value="{{ $spirit->spirit }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Julukan</label>
            <input type="text" name="julukan" value="{{ $spirit->julukan }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-4 py-2 rounded">{{ $spirit->deskripsi }}</textarea>
        </div>

        @foreach (['gambar_animal' => 'Gambar Animal', 'gambar_logo' => 'Gambar Logo', 'gambar_elemen' => 'Gambar Elemen'] as $field => $label)
            <div>
                <label class="block font-semibold mb-1">{{ $label }}</label>
                @if ($spirit->$field)
                    <img src="{{ Storage::url($spirit->$field) }}" class="w-20 h-20 rounded mb-2" alt="Gambar {{ $label }}">
                @endif
                <input type="file" name="{{ $field }}" class="w-full">
            </div>
        @endforeach

        <div>
            <label class="block font-semibold mb-1">Warna</label>
            <input type="color" name="warna" value="{{ $spirit->warna }}" class="w-10 h-10 rounded border">
        </div>

        <div class="md:col-span-2 flex justify-between mt-6">
            <a href="{{ route('spirits.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
