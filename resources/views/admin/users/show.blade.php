{{-- resources/views/admin/users/show.blade.php --}}

@extends('layouts.admin')

@section('title', 'Detail Pengguna: ' . ($user->name ?? ''))

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Pengguna</h2>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">ID:</label>
        <p class="text-gray-900">{{ $user->id }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
        <p class="text-gray-900">{{ $user->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
        <p class="text-gray-900">{{ $user->email }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Terdaftar Sejak:</label>
        <p class="text-gray-900">{{ $user->created_at->format('d M Y H:i:s') }}</p>
    </div>

    <div class="flex justify-end mt-6">
        <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali ke Daftar</a>
        {{-- Jika ingin tombol edit, bisa ditambahkan di sini --}}
        {{-- <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ml-2">Edit</a> --}}
    </div>
</div>
@endsection