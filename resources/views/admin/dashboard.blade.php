@extends('layouts.admin') {{-- Tetap menggunakan layout admin --}}

@section('title', 'Admin Dashboard - SPYNA') {{-- Tetap mengisi title dari layout --}}

@section('content') {{-- Konten utama dibungkus dalam section content --}}

    {{-- Stats cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <img src="{{ asset('storage/images/User.png') }}" alt="Users" class="mx-auto w-20 h-auto mb-3" onerror="this.src='https://via.placeholder.com/80'">
            <h6 class="font-semibold text-lg mb-1">Total Users</h6>
            <p class="text-gray-700 text-xl">2 Users</p> {{-- Hardcode --}}
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <img src="{{ asset('storage/images/Quiz.png') }}" alt="Quiz" class="mx-auto w-16 h-auto mb-3" onerror="this.src='https://via.placeholder.com/80'">
            <h6 class="font-semibold text-lg mb-1">Quizzes Taken</h6>
            <p class="text-gray-700 text-xl">10 Taken</p> {{-- Hardcode --}}
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h6 class="font-semibold text-lg mb-2">Most Popular Spirit Animal</h6>
            <img src="{{ asset('storage/images/Kucing.png') }}" alt="Kucing" class="mx-auto w-20 h-auto mb-2" onerror="this.src='https://via.placeholder.com/80'"> {{-- Hardcode --}}
            <p class="text-gray-700 text-xl">Kucing</p> {{-- Hardcode --}}
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h6 class="font-semibold mb-3">Recent Activities</h6>
            <ul class="text-gray-600 text-sm space-y-1">
                <li>Icis Gemoy - took the quiz</li> {{-- Hardcode --}}
                <li>Kiwi Wibu - took the quiz</li> {{-- Hardcode --}}
                <li>Syahrial Imo - took the quiz</li> {{-- Hardcode --}}
                <li>Otw Immortal - took the quiz</li> {{-- Hardcode --}}
            </ul>
        </div>

    </div>

    {{-- Chart + Active Users --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2 flex flex-col">

            <h6 class="font-semibold mb-4">Spirit Animal Statistic</h6>

            <div class="flex flex-wrap gap-8 justify-center">

                <div class="flex-1 min-w-[220px] max-w-[300px]">
                    <canvas id="spiritChart"></canvas>
                </div>

                <div class="flex-1 min-w-[220px] grid grid-cols-2 gap-2">

                    {{-- Data chart legend --}}
                    @php
                        $stats = [
                            ['label' => 'Kucing', 'color' => '#b3e5fc', 'percent' => 35],
                            ['label' => 'Macan', 'color' => '#ffe082', 'percent' => 15],
                            ['label' => 'Elang', 'color' => '#c5e1a5', 'percent' => 5],
                            ['label' => 'Anjing', 'color' => '#f8bbd0', 'percent' => 5],
                            ['label' => 'Rusa', 'color' => '#d1c4e9', 'percent' => 5],
                            ['label' => 'Singa', 'color' => '#ffccbc', 'percent' => 5],
                            ['label' => 'Koala', 'color' => '#b2dfdb', 'percent' => 5],
                            ['label' => 'Rakun', 'color' => '#dcedc8', 'percent' => 5],
                            ['label' => 'Rubah', 'color' => '#ffab91', 'percent' => 10],
                            ['label' => 'Gajah', 'color' => '#b0bec5', 'percent' => 20],
                        ];
                    @endphp

                    @foreach ($stats as $stat)
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded" style="background-color: {{ $stat['color'] }};"></div>
                            <span class="text-sm font-medium">{{ $stat['label'] }}: {{ $stat['percent'] }}%</span>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h1 class="font-semibold text-lg mb-1">Active Users</h1>
            <img src="{{ asset('storage/images/User.png') }}" alt="Active Users" class="mx-auto w-20 h-auto mb-3" onerror="this.src='https://via.placeholder.com/80'">
            <h2 class="text-gray-700 text-xl">2</h2> {{-- Hardcode --}}
            <p class="text-gray-700 text-xl">users</p>
        </div>

    </div>

@endsection {{-- Akhir section content dari layout --}}

@push('scripts') {{-- Masukkan script Chart.js di sini --}}
<script>
    const ctx = document.getElementById('spiritChart').getContext('2d');
    // Data chart di-hardcode langsung di JavaScript
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Kucing', 'Macan', 'Elang', 'Anjing', 'Rusa', 'Singa', 'Koala', 'Rakun', 'Rubah', 'Gajah'],
            datasets: [{
                data: [35, 15, 5, 5, 5, 5, 5, 5, 10, 20],
                backgroundColor: [
                    '#b3e5fc', '#ffe082', '#c5e1a5', '#f8bbd0', '#d1c4e9', '#ffccbc',
                    '#b2dfdb', '#dcedc8', '#ffab91', '#b0bec5'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ctx.label + ': ' + ctx.parsed + '%'
                    }
                }
            }
        }
    });
</script>
@endpush