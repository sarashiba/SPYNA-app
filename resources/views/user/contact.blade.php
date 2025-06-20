<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact - SPYNA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            color: white;
            background: url('{{ asset('storage/images/Gambar 2.png') }}') no-repeat center center fixed; /* Menggunakan asset() untuk background */
            background-size: cover;
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

        .contact-section {
            padding: 100px 40px 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            flex-wrap: wrap;
        }

        .contact-form, .contact-info {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .contact-form h2 {
            margin-bottom: 20px;
            font-size: 22px;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            color: black; /* Pastikan teks input terlihat */
        }

        .contact-form button {
            width: 100%;
            padding: 10px;
            background: orange;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .contact-info h3 {
            margin-bottom: 15px;
            font-size: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
            line-height: 1.4;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            background: rgba(0,0,0,0.8);
            margin-top: 40px;
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
            .nav-auth .user-name {
                flex-direction: column;
                gap: 5px;
                padding: 6px 10px;
            }
            .nav-auth .logout-btn {
                margin-left: 0;
            }
            .contact-section {
                flex-direction: column;
                align-items: center;
                padding-top: 20px; /* Kurangi padding atas di mobile */
            }
            .contact-form, .contact-info {
                width: 90%; /* Ambil lebih banyak lebar di mobile */
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

    <div class="contact-section">
        <div class="contact-form">
            <h2>Send Us Message</h2>
            {{-- Form ini perlu atribut action, method, dan name untuk input --}}
            <form action="#" method="POST"> {{-- Ganti # dengan route POST untuk menyimpan pesan --}}
                @csrf
                <input type="text" name="name" placeholder="Your name" required>
                <input type="email" name="email" placeholder="Your email address" required>
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" rows="5" placeholder="Write your question here..."></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Let's Meet Us</h3>
            <p>Alamat: 194 MT Haryono Street, Cilacap, 53221</p>
            <h3>Give us a Call</h3>
            <p>0857-2710-1355<br>Senin–Jumat, 09:00–17:00</p>
            <h3>Email Us</h3>
            <p>Spyna@support.com<br>Respon 24 jam</p>
        </div>
    </div>

    <div class="footer">
        © All Right Reserved by <strong>SPYNA.Pro</strong>
    </div>
</body>
</html>