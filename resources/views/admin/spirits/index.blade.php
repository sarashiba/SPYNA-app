@extends('layouts.admin')

@section('title', 'Daftar Spirit')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Spirit</h2>
        <a href="{{ route('spirits.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Spirit
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="p-3">Kode</th>
                    <th class="p-3">Spirit</th>
                    <th class="p-3">Julukan</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3">Gambar Animal</th>
                    <th class="p-3">Logo</th>
                    <th class="p-3">Elemen</th>
                    <th class="p-3">Warna</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                @foreach ($spirits as $spirit)
                    <tr>
                        <td class="p-3">{{ $spirit->code }}</td>
                        <td class="p-3">{{ $spirit->spirit }}</td>
                        <td class="p-3">{{ $spirit->julukan }}</td>
                        <td class="p-3">{{ $spirit->deskripsi }}</td>
                        
                        <td class="p-3">
                            @if ($spirit->gambar_animal)
                                {{-- PERBAIKAN DI SINI: ubah object-cover menjadi object-contain --}}
                                <img src="{{ Storage::url($spirit->gambar_animal) }}" alt="Gambar Animal" class="w-32 h-32 object-contain rounded">
                            @endif
                        </td>
                        <td class="p-3">
                            @if ($spirit->gambar_logo)
                                {{-- PERBAIKAN DI SINI: ubah object-cover menjadi object-contain --}}
                                <img src="{{ Storage::url($spirit->gambar_logo) }}" alt="Gambar Logo" class="w-32 h-32 object-contain rounded">
                            @endif
                        </td>
                        <td class="p-3">
                            @if ($spirit->gambar_elemen)
                                {{-- PERBAIKAN DI SINI: ubah object-cover menjadi object-contain --}}
                                <img src="{{ Storage::url($spirit->gambar_elemen) }}" alt="Gambar Elemen" class="w-32 h-32 object-contain rounded">
                            @endif
                        </td>

                        <td class="p-3">
                            <div class="w-6 h-6 rounded-full border" style="background-color: {{ $spirit->warna }};"></div>
                        </td>
                        <td class="p-3 text-center">
                            <a href="{{ route('spirits.edit', $spirit->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('spirits.destroy', $spirit->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus spirit ini?')" class="text-red-600 hover:underline ml-2">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($spirits->isEmpty())
                    <tr>
                        <td colspan="9" class="p-3 text-center text-gray-500">Belum ada data spirit.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection