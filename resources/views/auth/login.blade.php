<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPYNA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css') {{-- Pastikan ini mengarah ke CSS Anda --}}

    {{-- Gaya CSS yang sama dengan home/about/contact untuk konsistensi --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            color: white;
            background-image: url('{{ asset('storage/images/login.png') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: black; /* Fallback color */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            position: absolute; /* Tetap absolute di halaman login */
            top: 0;
            width: 100%;
            z-index: 50; /* Pastikan di atas konten lain */
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar .logo {
            font-size: 30px;
            font-weight: 900;
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 70px; /* Ukuran logo agar konsisten */
            margin-right: 20px;
        }

        .nav-main {
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid white;
            border-radius: 30px;
            padding: 6px 20px;
            font-size: 14px;
        }

        .nav-main a {
            text-decoration: none;
            color: white;
            font-weight: 500;
        }

        .nav-divider {
            color: white;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-auth a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid transparent;
        }

        .nav-auth a.signin-btn {
            border-color: white;
        }

        .nav-auth a.signup-btn {
            background-color: rgba(19, 1, 1, 0.897);
        }

        /* Gaya untuk nama pengguna yang login */
        .nav-auth .user-name {
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid white;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-auth .user-name img {
            height: 20px;
        }
        .nav-auth .logout-btn {
            background-color: rgba(19, 1, 1, 0.897);
            border: none;
            cursor: pointer;
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 20px;
            margin-left: 10px;
        }

        /* Gaya khusus untuk form login/register */
        .login-form-container { /* Kontainer di mana form login berada */
            flex-grow: 1; /* Agar mengisi ruang vertikal */
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 100px; /* Tambahkan padding atas agar tidak tumpang tindih navbar */
        }

        .login-box { /* Kotak form login */
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 1rem; /* 16px */
            padding: 2.5rem; /* 40px */
            width: 400px;
            display: flex;
            flex-direction: column;
            gap: 1rem; /* 16px */
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1); /* Tailwind shadow-md */
        }
        .login-box h2 {
            font-size: 1.5rem; /* 24px */
            font-weight: bold;
            margin-bottom: 1rem; /* 16px */
        }
        .login-box input {
            width: 100%;
            padding: 0.5rem 1rem; /* 8px 16px */
            border-radius: 0.5rem; /* 8px */
            color: black;
            background-color: rgb(243 244 246); /* gray-100 */
            font-size: 0.875rem; /* 14px */
            border: none; /* Hapus border default */
        }
        .login-box button {
            width: 100%;
            background-color: rgb(249 115 22); /* orange-500 */
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            border: none; /* Hapus border default */
        }
        .login-box p {
            font-size: 0.75rem; /* 12px */
            margin-top: 0.5rem; /* 8px */
        }
        .login-box p a {
            color: rgb(249 115 22); /* orange-500 */
            font-weight: bold;
            text-decoration: none;
        }

        /* Responsive Media Queries */
        @media screen and (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap;
                justify-content: center;
            }
            .navbar-left {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }
            .nav-main {
                display: none; /* Sembunyikan di mobile */
            }
            .nav-auth {
                width: 100%;
                justify-content: center;
                display: flex;
                gap: 10px;
            }
            .nav-auth .user-name, .nav-auth .logout-btn {
                margin-left: 0;
            }
            .login-form-container {
                padding-top: 80px; /* Sesuaikan padding di mobile */
            }
            .login-box {
                width: 90%;
                padding: 20px;
            }
            .login-box h2 {
                font-size: 1.25rem;
            }
            .login-box input, .login-box button {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body class="min-h-screen"> {{-- Hapus kelas Tailwind yang bentrok jika sudah ada di style --}}
    <div class="navbar">
        <div class="navbar-left">
            <div class="logo">
                <img src="{{ asset('storage/images/Vector.png') }}" alt="Logo" /> SPYNA
            </div>
            <div class="nav-main">
                <a href="{{ route('home') }}">Home</a>
                <span class="nav-divider">-</span>
                <a href="{{ route('about') }}">About</a>
                <span class="nav-divider">-</span>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
        <div class="nav-auth">
            @auth {{-- Jika pengguna sudah login --}}
                <span class="user-name">
                    <img src="{{ asset('storage/images/user-icon.png') }}" alt="User Icon"> {{-- Pastikan icon ini ada --}}
                    {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @else {{-- Jika pengguna belum login --}}
                <a href="{{ route('login') }}" class="signin-btn">Sign In</a>
                <a href="{{ route('register') }}" class="signup-btn">Sign Up</a>
            @endauth
        </div>
    </div>

    <div class="login-form-container"> {{-- Kontainer baru untuk form login --}}
        <div class="login-box"> {{-- Menggantikan div bg-black/70 --}}
            <h2 class="text-2xl font-bold mb-4">Sign In</h2>

            <form method="POST" action="{{ route('login.post') }}" class="w-full flex flex-col gap-4">
                @csrf

                {{-- Email Input --}}
                <input type="email" name="email" placeholder="Email" required
                    class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm"
                    value="{{ old('email') }}" /> {{-- old() untuk mempertahankan input --}}
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                {{-- Password Input --}}
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-orange-500 text-white font-bold py-2 rounded-lg">
                    Sign In
                </button>
            </form>

            <p class="text-xs mt-2">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-orange-500 font-bold">Sign Up</a>
            </p>
        </div>
    </div>
</body>
</html>