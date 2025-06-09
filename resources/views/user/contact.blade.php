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
      background: url('storage/images/Gambar 2.png') no-repeat center center fixed;
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

  <div class="contact-section">
    <div class="contact-form">
      <h2>Send Us Message</h2>
      <input type="text" placeholder="Your name">
      <input type="email" placeholder="Your email address">
      <input type="text" placeholder="Subject">
      <textarea rows="5" placeholder="Write your question here..."></textarea>
      <button>Send Message</button>
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
