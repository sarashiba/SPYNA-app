@extends('layouts.admin')

@section('title', 'Manajemen Pertanyaan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pertanyaan</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-sm font-semibold">Gambar BG</th>
                        <th class="px-4 py-3 text-sm font-semibold">Pertanyaan</th>
                        <th class="px-4 py-3 text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($questions as $index => $question)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">
                                @if($question->background)
                                    <img src="{{ asset('storage/' . $question->background) }}" alt="Background" class="w-24 h-auto rounded">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $question->question }}</td>
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('questions.edit', $question->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada pertanyaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('questions.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                + Tambah Pertanyaan
            </a>
        </div>
    </div>
@endsection
