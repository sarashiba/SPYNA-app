<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - SPYNA</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  @vite('resources/css/app.css') {{-- Pastikan Tailwind sudah di-compile lewat Vite --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="h-full font-sans text-gray-900">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside class="w-1/5 text-white flex flex-col" style="background-color: #0b1f4b;">

    <h2 class="text-3xl font-bold px-6 py-6 border-b border-gray-800 select-none">SPYNA</h2>

    <nav class="flex flex-col flex-grow">
        <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border-l-4 flex items-center space-x-3 hover:bg-[#1f365d] {{ request()->routeIs('admin.dashboard') ? 'bg-[#243b61] border-white' : 'border-transparent hover:bg-[#1f365d]' }}"><img src="{{ asset('storage/images/icon/dashboard.png') }}" alt="Users" class="w-5 h-5"><span>Dashboard</span></a>
        <a href="#" class="px-6 py-3 flex items-center space-x-3 hover:bg-[#1f365d]"><img src="{{ asset('storage/images/icon/users.png') }}" alt="Users" class="w-5 h-5"><span>Users</span></a>
        <a href="#" class="px-6 py-3 flex items-center space-x-3 hover:bg-[#1f365d]"><img src="{{ asset('storage/images/icon/quiz.png') }}" alt="Users" class="w-5 h-5"><span>Quiz Management</span></a>
        <a href="#" class="px-6 py-3 flex items-center space-x-3 hover:bg-[#1f365d]"><img src="{{ asset('storage/images/icon/spirit.png') }}" alt="Users" class="w-5 h-5"><span>Spirit Management</span></a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="px-6 py-4 border-t border-gray-800">
        @csrf
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 rounded py-2 text-white font-semibold">
        Log Out
        </button>
    </form>

    </aside>



  {{-- Main content --}}
  <main class="flex-grow p-8 overflow-auto">

    {{-- Top bar with user info --}}
    <div class="flex justify-end mb-6">
      <div class="flex items-center bg-white rounded shadow px-4 py-2 space-x-3">
        <img src="{{ asset('storage/images/User.png') }}" alt="Avatar" class="rounded-full w-10 h-10 object-cover" onerror="this.src='https://via.placeholder.com/40'">
        <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
      </div>
    </div>

    {{-- Stats cards --}}
    <div class="grid grid-cols-4 gap-6 mb-8">

      <div class="bg-white rounded-lg shadow p-6 text-center">
        <img src="{{ asset('storage/images/User.png') }}" alt="Users" class="mx-auto w-20 h-auto mb-3" onerror="this.src='https://via.placeholder.com/80'">
        <h6 class="font-semibold text-lg mb-1">Total Users</h6>
        <p class="text-gray-700 text-xl">6666 Users</p>
      </div>

      <div class="bg-white rounded-lg shadow p-6 text-center">
        <img src="{{ asset('storage/images/Quiz.png') }}" alt="Quiz" class="mx-auto w-16 h-auto mb-3" onerror="this.src='https://via.placeholder.com/80'">
        <h6 class="font-semibold text-lg mb-1">Quizzes Taken</h6>
        <p class="text-gray-700 text-xl">9999 Taken</p>
      </div>

      <div class="bg-white rounded-lg shadow p-6 text-center">
        <h6 class="font-semibold text-lg mb-2">Most Popular Spirit Animal</h6>
        <img src="{{ asset('storage/images/Kucing.png') }}" alt="Kucing" class="mx-auto w-20 h-auto mb-2" onerror="this.src='https://via.placeholder.com/80'">
        <p class="text-gray-700 text-xl">Kucing</p>
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <h6 class="font-semibold mb-3">Recent Activities</h6>
        <ul class="text-gray-600 text-sm space-y-1">
          <li>Icis Gemoy - took the quiz</li>
          <li>Kiwi Wibu - took the quiz</li>
          <li>Syahrial Imo - took the quiz</li>
          <li>Otw Immortal - took the quiz</li>
        </ul>
      </div>

    </div>

    {{-- Chart + Active Users --}}
    <div class="grid grid-cols-3 gap-6">

      <div class="bg-white rounded-lg shadow p-6 col-span-2 flex flex-col">

        <h6 class="font-semibold mb-4">Spirit Animal Statistic</h6>

        <div class="flex flex-wrap gap-8">

          <div class="flex-1 min-w-[220px]">
            <canvas id="spiritChart"></canvas>
          </div>

          <div class="flex-1 min-w-[220px] grid grid-cols-2 gap-2">

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
        <h2 class="text-gray-700 text-xl">15</h2>
        <p class="text-gray-700 text-xl">users</p>
      </div>

    </div>

  </main>
</div>

<script>
  const ctx = document.getElementById('spiritChart').getContext('2d');
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

</body>
</html>
