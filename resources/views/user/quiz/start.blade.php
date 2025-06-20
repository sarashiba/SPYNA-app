<!-- @extends('layouts.user') {{-- Asumsi ada layout user --}}

@section('title', 'Mulai Kuis Spirit Animal')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Temukan Spirit Animal Anda!</h1>
        <p class="text-gray-600 mb-6">
            Jawab serangkaian pertanyaan singkat untuk mengungkap spirit animal yang paling sesuai dengan kepribadian Anda.
        </p>
        <a href="{{ route('user.quiz.show') }}" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
            Mulai Kuis Sekarang
        </a>

        @if (session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
@endsection -->