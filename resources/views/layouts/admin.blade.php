<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Dashboard - SPYNA')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('head')
</head>
<body class="h-full font-sans text-gray-900">

<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="text-white flex flex-col flex-shrink-0" style="background-color: #0b1f4b; width: 280px;"> {{-- Perbaikan: Atur lebar tetap --}}
        <h2 class="text-3xl font-bold px-6 py-6 border-b border-gray-800 select-none">SPYNA</h2>
        <nav class="flex flex-col flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border-l-4 flex items-center space-x-3 hover:bg-[#1f365d] {{ request()->routeIs('admin.dashboard') ? 'bg-[#243b61] border-white' : 'border-transparent' }}">
                <img src="{{ asset('storage/images/icon/dashboard.png') }}" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border-l-4 flex items-center space-x-3 hover:bg-[#1f365d] {{ request()->routeIs('admin.users.index') ? 'bg-[#243b61] border-white' : 'border-transparent' }}">
                <img src="{{ asset('storage/images/icon/users.png') }}" alt="Users" class="w-5 h-5">
                <span>Users</span>
            </a>
            <a href="{{ route('questions.index') }}" class="px-6 py-3 border-l-4 flex items-center space-x-3 hover:bg-[#1f365d] {{ request()->routeIs('questions.index') ? 'bg-[#243b61] border-white' : 'border-transparent' }}">
                <img src="{{ asset('storage/images/icon/quiz.png') }}" alt="Quiz Management" class="w-5 h-5">
                <span>Quiz Management</span>
            </a>
            <a href="{{ route('spirits.index') }}" class="px-6 py-3 border-l-4 flex items-center space-x-3 hover:bg-[#1f365d] {{ request()->routeIs('spirits.index') ? 'bg-[#243b61] border-white' : 'border-transparent' }}">
                <img src="{{ asset('storage/images/icon/spirit.png') }}" alt="Spirit Management" class="w-5 h-5">
                <span>Spirit Management</span>
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="px-6 py-4 border-t border-gray-800">
            @csrf
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 rounded py-2 text-white font-semibold">
                Log Out
            </button>
        </form>
    </aside>

    {{-- Main Content --}}
    <main class="flex-grow p-8 overflow-y-auto"> {{-- Perbaikan: flex-grow dan overflow-y-auto --}}
        {{-- Top bar --}}
        <div class="flex justify-end mb-6">
            <div class="flex items-center bg-white rounded shadow px-4 py-2 space-x-3">
                <img src="{{ asset('storage/images/User.png') }}" alt="Avatar" class="rounded-full w-10 h-10 object-cover" onerror="this.src='https://via.placeholder.com/40'">
                <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
            </div>
        </div>

        {{-- Page Content --}}
        @yield('content')
    </main>
</div>

@stack('scripts')

</body>
</html>