@extends('layouts.admin')

@section('title', 'Tambah Spirit')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6">Tambah Spirit</h2>

    <form action="{{ route('spirits.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6" id="spiritForm"> {{-- Tambahkan ID pada form --}}
        @csrf

        <div>
            <label class="block font-semibold mb-1">Code</label>
            <input type="text" name="code" class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('code') {{-- Tambahkan ini --}}
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Spirit</label>
            <input type="text" name="spirit" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Julukan</label>
            <input type="text" name="julukan" class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border border-gray-300 px-4 py-2 rounded" rows="3"></textarea>
        </div>

        <!-- Gambar Animal -->
        <div>
            <label class="block font-semibold mb-1">Gambar Animal</label>
            <input type="file" name="gambar_animal" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded file:border-0 file:text-sm file:font-semibold
                file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300" />
        </div>

        <!-- Gambar Logo -->
        <div>
            <label class="block font-semibold mb-1">Gambar Logo</label>
            <input type="file" name="gambar_logo" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded file:border-0 file:text-sm file:font-semibold
                file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300" />
        </div>

        <!-- Gambar Elemen -->
        <div>
            <label class="block font-semibold mb-1">Gambar Elemen</label>
            <input type="file" name="gambar_elemen" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded file:border-0 file:text-sm file:font-semibold
                file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300" />
        </div>

        <!-- Warna -->
        <div>
            <label class="block font-semibold mb-1">Warna</label>
            <div class="flex items-center space-x-4">
                <input type="color" name="warna" id="colorPicker" class="w-10 h-10 rounded border border-gray-300">
                <input type="text" name="warna_text" id="colorCode" class="w-full border border-gray-300 px-4 py-2 rounded" readonly>
            </div>
        </div>

        <div class="md:col-span-2 flex justify-between mt-10">
            <a href="{{ route('spirits.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">KEMBALI</a>
            <button type="submit" id="saveButton" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">SIMPAN</button> {{-- Tambahkan ID pada tombol --}}
        </div>
    </form>
</div>

<script>
    const picker = document.getElementById('colorPicker');
    const code = document.getElementById('colorCode');
    const spiritForm = document.getElementById('spiritForm'); // Dapatkan elemen form
    const saveButton = document.getElementById('saveButton'); // Dapatkan elemen tombol

    picker.addEventListener('input', () => {
        code.value = picker.value.replace('#', '').toUpperCase();
    });

    window.addEventListener('DOMContentLoaded', () => {
        code.value = picker.value.replace('#', '').toUpperCase();
    });

    // Tambahkan event listener untuk submit form
    spiritForm.addEventListener('submit', function() {
        // Disabled tombol setelah form disubmit
        saveButton.disabled = true;
        saveButton.classList.add('opacity-50', 'cursor-not-allowed'); // Tambahkan gaya disabled dengan Tailwind
        saveButton.textContent = 'Menyimpan...'; // Opsional: Ubah teks tombol
    });
</script>
@endsection