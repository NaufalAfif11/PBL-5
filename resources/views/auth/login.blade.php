<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vaccine Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: url('{{ asset('images/bg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-box .register {
    margin-top: 15px;
    font-size: 14px;
    color: #000; /* Tambahkan ini supaya tulisan jadi hitam */
}


        .login-box img {
            width: 100px;
            margin-bottom: 15px;
        }

        .login-box h2 {
            color: #ff1f4b;
            margin-bottom: 10px;
        }

        .login-box h3 {
            color: #cc0033;
            margin-bottom: 20px;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .login-box button {
            background-color: #ff5a5f;
            border: none;
            padding: 10px;
            color: white;
            font-weight: bold;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
        }

        .login-box button:hover {
            background-color: #e6484f;
        }

        .login-box .register {
            margin-top: 15px;
            font-size: 14px;
        }

        .login-box .register a {
            color: #007bff;
            text-decoration: none;
        }

        .login-box .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h2>Vaccine Schedule</h2>
        <h3>Masuk</h3>

        <!-- Arahkan ke dashboard -->
        <form method="GET" action="{{ route('dashboard') }}">
            <input type="text" name="email" placeholder="Nama Pengguna" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <button type="submit">Masuk</button>
        </form>

        <div class="register" background=red>
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
</div>
</body>
</html>
