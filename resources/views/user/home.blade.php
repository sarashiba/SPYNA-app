<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Spirit Animal</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
  
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
      background-image: url('storage/images/Gambar 1.png');
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-color: black;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      position: absolute;
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
    }

    .nav-auth a.signup {
      background-color: rgba(19, 1, 1, 0.897);
    }

    .overlay-bottom {
      position: absolute;
      bottom: 0;
      width: 100%;
      background: linear-gradient(to top, rgba(0, 0, 0, 3), transparent);
      padding: 60px 40px;
    }

    .main-text {
      width:max-content;
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

    .main-text a {
      display: block;
      text-align: right;
      text-decoration: none;
      font-weight: bold;
      color: white;
      font-size: 20px;
    }

    @media screen and (max-width: 768px) {
      .main-text h1 {
        font-size: 50px;
      }

      .main-text p {
        font-size: 14px;
      }

      .nav-main {
        flex-direction: column;
        gap: 10px;
      }

      .main-text {
        padding: 0 20px;
      }
    }
  </style>
</head>
<body>
  <div class="hero">
    <div class="navbar">
      <div class="navbar-left">
        <div class="logo">
          <img src="{{ asset('storage/images/Vector.png') }}" alt="Logo" /> SPYNA
        </div>
        <div class="nav-main">
          <a href="#">Home</a>
          <span class="nav-divider">-</span>
          <a href="#">About</a>
          <span class="nav-divider">-</span>
          <a href="#">Contact</a>
        </div>
      </div>

      <div class="nav-auth">
        @auth
          <span>{{ Auth::user()->name }}</span>
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="signup" style="background-color: rgba(19, 1, 1, 0.897); border: none; cursor: pointer;">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}">Sign In</a>
          <a href="{{ route('register') }}" class="signup">Sign Up</a>
        @endauth
      </div>
    </div>

    <div class="overlay-bottom">
      <div class="main-text">
        <h1>SPIRIT ANIMAL</h1>
        <p>Apakah kamu seekor rubah cerdik, singa pemberani, atau kucing yang cuek? <br/> Yuk cari tahu hanya dalam beberapa menit!</p>
        <a href="{{ url('/quiz') }}">START QUIZ →</a>
      </div>
    </div>
  </div>
</body>
</html>
