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
        background: url('storage/images/Gambar 2.png') no-repeat center center fixed;
        background-size: cover;
        color: white;
        overflow-x: hidden;
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
        border: 1px solid white;
        }

        .nav-auth a.signup {
        background-color: rgba(19, 1, 1, 0.897);
        border: none;
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
            .contact-section {
                flex-direction: column;
                align-items: center;
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
        <a href="{{ url('/') }}">Home</a>
        <span class="nav-divider">-</span>
        <a href="{{ url('/about') }}">About</a>
        <span class="nav-divider">-</span>
        <a href="{{ url('/contact') }}">Contact</a>
      </div>
    </div>
    <div class="nav-auth">
      <a href="{{ url('/login') }}">Sign In</a>
      <a href="{{ url('/register') }}" class="signup">Sign Up</a>
    </div>
  </div>

  <div class="about-container" style="display: flex; padding: 60px 80px; align-items: center; gap: 50px;">
    <div class="about-image" style="flex: 1; text-align: center;">
      <img src="{{ asset('storage/images/Char.png') }}" alt="About Illustration" style="max-width: 100%; border-radius: 50%; border: 4px solid #ff914d;">
      <div class="socials" style="margin-top: 20px;">
        <img src="{{ asset('storage/images/link icon.jpeg') }}" alt="LinkedIn" style="width: 32px; margin-right: 15px;">
        <img src="{{ asset('storage/images/ig icon.jpeg') }}" alt="Instagram" style="width: 32px; margin-right: 15px;">
        <img src="{{ asset('storage/images/fc icon.jpeg') }}" alt="Facebook" style="width: 32px;">
      </div>
    </div>
    <div class="about-content" style="flex: 2;">
      <h1 style="font-size: 40px; font-weight: 800; margin-bottom: 20px;">About Us.</h1>
      <p style="font-size: 16px; line-height: 1.8; margin-bottom: 30px;">
        Kami percaya bahwa setiap orang memiliki kepribadian unik yang bisa digambarkan lewat hewan-hewan ajaib! Spirit Animal adalah sebuah platform seru untuk menemukan hewan yang mewakili dirimu...
      </p>
      <ul style="list-style: none;">
        <li style="margin-bottom: 15px; position: relative; padding-left: 25px;">
          <strong>Our Mission</strong><br>
          Membuat pengalaman seru, menyenangkan, dan penuh warna...
        </li>
        <li style="margin-bottom: 15px; position: relative; padding-left: 25px;">
          <strong>Who We Are</strong><br>
          Kami adalah tim kecil kreatif yang mencintai desain lucu...
        </li>
      </ul>
    </div>
  </div>
</body>
</html>
