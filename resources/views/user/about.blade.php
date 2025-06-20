<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About - SPYNA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: url('{{ asset('storage/images/Gambar 2.png') }}') no-repeat center center fixed; /* Menggunakan asset() untuk background */
            background-size: cover;
            color: white;
            overflow-x: hidden;
            min-height: 100vh; /* Pastikan tinggi penuh */
            display: flex; /* Menggunakan flexbox untuk layout keseluruhan */
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 30px;
            font-weight: 900;
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 70px;
            margin-right: 20px;
        }

        .nav-main {
            display: flex;
            align-items: center;
            border: 1px solid white;
            border-radius: 30px;
            padding: 6px 20px;
            gap: 15px;
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

        /* Gaya untuk Navigasi Autentikasi (Sign In/Up atau Nama User/Logout) */
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
            border: 1px solid transparent; /* Tambahkan border transparan untuk konsistensi ukuran */
        }

        .nav-auth a.signin-btn { /* Kelas spesifik untuk tombol Sign In */
            border-color: white; /* Border untuk Sign In */
        }

        .nav-auth a.signup-btn { /* Kelas spesifik untuk tombol Sign Up */
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

        .about-container {
            flex-grow: 1; /* Agar mengisi sisa ruang vertikal */
            display: flex;
            padding: 60px 80px;
            align-items: center;
            justify-content: center; /* Pusatkan horizontal */
            gap: 50px;
            flex-wrap: wrap;
            max-width: 1200px; /* Batasi lebar container */
            margin: 0 auto; /* Pusatkan horizontal */
        }

        .about-image {
            flex: 1;
            text-align: center;
            min-width: 250px; /* Agar tidak terlalu kecil di mobile */
            max-width: 400px;
        }

        .about-image img {
            max-width: 100%;
            height: auto; /* Penting untuk responsif */
            border-radius: 50%;
            border: 4px solid #ff914d;
        }

        .socials {
            margin-top: 20px;
            display: flex;
            justify-content: center; /* Pusatkan ikon sosial */
            gap: 15px; /* Jarak antar ikon */
        }
        .socials img {
            width: 32px;
            height: 32px; /* Pastikan tinggi sama dengan lebar */
            margin-right: 0 !important; /* Hapus margin-right bawaan jika ada */
        }

        .about-content {
            flex: 2;
            max-width: 700px; /* Batasi lebar teks konten */
            text-align: left;
        }

        .about-content h1 {
            font-size: 40px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .about-content p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .about-content ul {
            list-style: none;
        }
        .about-content li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 0; /* Hapus padding-left dari contoh, karena tidak ada ikon list */
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            background: rgba(0,0,0,0.8);
            margin-top: auto; /* Mendorong footer ke bawah */
        }

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
                display: none; /* Sembunyikan di mobile, bisa diganti burger menu */
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
            .about-container {
                flex-direction: column;
                padding: 40px 20px; /* Kurangi padding di mobile */
                gap: 30px;
            }
            .about-image, .about-content {
                max-width: 90%;
                text-align: center; /* Pusatkan teks di mobile */
            }
            .about-content h1 {
                font-size: 32px;
            }
            .about-content p, .about-content li {
                font-size: 14px;
            }
            .socials {
                margin-top: 15px;
            }
            .footer {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
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
                    <img src="{{ asset('storage/images/user.png') }}" alt="User Icon"> {{-- Pastikan icon ini ada --}}
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

    <div class="about-container">
        <div class="about-image">
            <img src="{{ asset('storage/images/Char.png') }}" alt="About Illustration">
            <div class="socials">
                <img src="{{ asset('storage/images/link icon.jpeg') }}" alt="LinkedIn">
                <img src="{{ asset('storage/images/ig icon.jpeg') }}" alt="Instagram">
                <img src="{{ asset('storage/images/fc icon.jpeg') }}" alt="Facebook">
            </div>
        </div>
        <div class="about-content">
            <h1>About Us.</h1>
            <p>
                Kami percaya bahwa setiap orang memiliki kepribadian unik yang bisa digambarkan lewat hewan-hewan ajaib! Spirit Animal adalah sebuah platform seru untuk menemukan hewan yang mewakili dirimu...
            </p>
            <ul>
                <li>
                    <strong>Our Mission</strong><br>
                    Membuat pengalaman seru, menyenangkan, dan penuh warna...
                </li>
                <li>
                    <strong>Who We Are</strong><br>
                    Kami adalah tim kecil kreatif yang mencintai desain lucu...
                </li>
            </ul>
        </div>
    </div>

    <div class="footer">
        © All Right Reserved by <strong>SPYNA.Pro</strong>
    </div>
</body>
</html>