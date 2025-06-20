<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spirit Animal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    {{-- Jika Anda menggunakan Vite untuk CSS --}}
    {{-- @vite('resources/css/app.css') --}}

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
        }

        .hero {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background-image: url('{{ asset('storage/images/Gambar 1.png') }}'); /* Menggunakan asset() untuk gambar background */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: black;
            display: flex; /* Untuk memposisikan overlay-bottom */
            flex-direction: column;
            justify-content: flex-end; /* Mendorong konten utama ke bawah */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            position: absolute; /* Tetap absolute agar di atas hero */
            top: 0;
            width: 100%;
            z-index: 2;
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
            height: 70px;
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

        .nav-auth a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid transparent; /* Tambahkan border transparan untuk konsistensi ukuran */
        }

        .nav-auth a.signin-btn {
            border-color: white; /* Border untuk Sign In */
        }

        .nav-auth a.signup-btn {
            background-color: rgba(19, 1, 1, 0.897);
        }

        /* Gaya untuk nama pengguna yang login */
        .nav-auth .user-name {
            color: white;
            font-weight: 500;
            padding: 6px 16px; /* Padding agar konsisten dengan tombol */
            border-radius: 20px;
            border: 1px solid white; /* Border untuk nama pengguna */
            display: flex;
            align-items: center;
            gap: 8px; /* Jarak antara nama dan ikon (jika ada) */
        }
        .nav-auth .user-name img {
            height: 20px; /* Ukuran ikon user */
        }
        .nav-auth .logout-btn {
            background-color: rgba(19, 1, 1, 0.897);
            border: none;
            cursor: pointer;
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 20px;
            margin-left: 10px; /* Jarak dari nama pengguna */
        }


        .overlay-bottom {
            position: relative; /* Diubah dari absolute agar flexbox bekerja */
            bottom: 0;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent); /* Sedikit lebih transparan */
            padding: 60px 40px;
            z-index: 1; /* Di bawah navbar */
        }

        .main-text {
            width: max-content;
            max-width: 1000px;
            margin: 0 auto;
        }

        .main-text h1 {
            font-size: 100px;
            font-weight: 1000;
            text-align: center;
            margin-bottom: 20px;
        }

        .main-text p {
            font-size: 18px;
            line-height: 1.5;
            text-align: left;
            margin-bottom: 30px;
        }

        .main-text a.start-quiz-btn { /* Kelas spesifik untuk tombol start quiz */
            display: block;
            text-align: right;
            text-decoration: none;
            font-weight: bold;
            color: white;
            font-size: 20px;
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap; /* Biarkan navbar wrap */
                justify-content: center; /* Pusatkan item di mobile */
            }
            .navbar-left {
                width: 100%; /* Ambil lebar penuh */
                justify-content: center;
                margin-bottom: 10px;
            }
            .nav-main {
                display: none; /* Sembunyikan menu utama di mobile kecil, bisa diganti dengan burger menu */
            }
            .nav-auth {
                width: 100%;
                justify-content: center;
                display: flex;
                gap: 10px;
            }
            .nav-auth .user-name {
                flex-direction: column;
                gap: 5px;
                padding: 6px 10px;
            }
            .nav-auth .logout-btn {
                margin-left: 0; /* Hapus margin kiri */
            }

            .main-text h1 {
                font-size: 50px;
                text-align: center; /* Pastikan tetap di tengah */
            }

            .main-text p {
                font-size: 14px;
                text-align: center; /* Pastikan tetap di tengah */
                padding: 0 10px; /* Tambahkan padding agar teks tidak terlalu lebar */
            }

            .main-text a.start-quiz-btn {
                font-size: 16px;
                text-align: center; /* Pusatkan tombol Start Quiz */
            }

            .overlay-bottom {
                padding: 40px 20px; /* Kurangi padding di mobile */
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="navbar">
            <div class="navbar-left">
                <div class="logo">
                    {{-- Logo SPYNA (static asset from storage/images/Vector.png) --}}
                    <img src="{{ asset('storage/images/Vector.png') }}" alt="Logo" /> SPYNA
                </div>
                <div class="nav-main">
                    <a href="{{ url('/') }}">Home</a> {{-- Link ke halaman beranda --}}
                    <span class="nav-divider">-</span>
                    <a href="{{ url('/about') }}">About</a>
                    <span class="nav-divider">-</span>
                    <a href="{{ url('/contact') }}">Contact</a>
                </div>
            </div>

            <div class="nav-auth">
                @auth {{-- Jika pengguna sudah login --}}
                    <span class="user-name">
                        {{-- Contoh icon user, pastikan ada di public/storage/images/user-icon.png --}}
                        <img src="{{ asset('storage/images/user.png') }}" alt="User Icon">
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

        <div class="overlay-bottom">
            <div class="main-text">
                <h1>SPIRIT ANIMAL</h1>
                <p>Apakah kamu seekor rubah cerdik, singa pemberani, atau kucing yang cuek? <br/> Yuk cari tahu hanya dalam beberapa menit!</p>
                {{-- Link ke halaman start quiz --}}
                <a href="{{ route('user.quiz.show') }}" class="start-quiz-btn">START QUIZ →</a>
            </div>
        </div>
    </div>
</body>
</html>