{{-- resources/views/admin/users/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
        {{-- Jika ingin tombol tambah user, bisa ditambahkan di sini --}}
        {{-- <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Pengguna
        </a> --}}
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto"> {{-- Tambahkan overflow-x-auto untuk tabel lebar --}}
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="p-3">ID</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Terdaftar Sejak</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                @forelse ($users as $user)
                    <tr>
                        <td class="p-3">{{ $user->id }}</td>
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="p-3 text-center">
                            {{-- Tombol Lihat/Detail --}}
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                            
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus user ini?')" class="text-red-600 hover:underline ml-2">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">Belum ada user terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection