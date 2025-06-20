<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Spirit Animal')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS (pastikan sudah terkonfigurasi dengan Vite/Mix) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Atau jika menggunakan Laravel Mix:
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    --}}

    {{-- Custom CSS untuk halaman ini (opsional) --}}
    @yield('styles')
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    {{-- Navbar (opsional, tergantung desain UI Anda) --}}
    <nav class="bg-white shadow-sm p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Spirit Animal</a>
            <div>
                {{-- Contoh navigasi untuk user --}}
                <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-blue-600 mx-3">Dashboard</a>
                <a href="{{ route('user.quiz.start') }}" class="text-gray-700 hover:text-blue-600 mx-3">Mulai Kuis</a>
                <a href="{{ url('/about') }}" class="text-gray-700 hover:text-blue-600 mx-3">Tentang Kami</a>
                <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-blue-600 mx-3">Kontak</a>

                @auth
                    {{-- Dropdown untuk user yang sudah login --}}
                    <div class="relative inline-block text-left ml-4">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            {{ Auth::user()->name }}
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown menu, bisa diatur dengan Alpine.js atau JS biasa --}}
                        <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none;"> {{-- Hapus display: none; dan gunakan JS untuk toggle --}}
                            <div class="py-1" role="none">
                                <a href="{{ route('user.dashboard') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Profil</a>
                                <form method="POST" action="{{ route('logout') }}" role="none">
                                    @csrf
                                    <button type="submit" class="text-gray-700 block w-full px-4 py-2 text-left text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-2">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 mx-3">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 ml-3">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main content area --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (opsional) --}}
    <footer class="bg-white shadow-inner p-4 mt-8 text-center text-gray-600">
        <div class="container mx-auto">
            &copy; {{ date('Y') }} Spirit Animal. All rights reserved.
        </div>
    </footer>

    {{-- Custom JavaScript untuk halaman ini (opsional) --}}
    @yield('scripts')

    {{-- Script untuk dropdown menu (jika tidak pakai Alpine.js) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menu-button');
            const dropdownMenu = menuButton.nextElementSibling; // Asumsi dropdown adalah elemen setelah button

            if (menuButton && dropdownMenu) {
                menuButton.addEventListener('click', function() {
                    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
                });

                // Close the dropdown if the user clicks outside of it
                window.addEventListener('click', function(event) {
                    if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>