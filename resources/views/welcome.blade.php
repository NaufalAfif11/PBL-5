<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #fdd;
            text-align: center;
            padding: 50px;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2rem;
            margin: 0;
        }
        p {
            margin-top: 10px;
            font-size: 1rem;
        }
        .cta {
            font-weight: bold;
            margin: 30px 0;
            font-size: 1.2rem;
        }
        .buttons button {
            background-color: #ff5e6c;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            font-size: 1rem;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #e14c5b;
        }
        .note {
            font-size: 0.9rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <h1>Vaccine Schedule</h1>
    <p>Aplikasi berbasis website yang bertujuan memudahkan anda mendapatkan vaksinasi dan imunisasi</p>
    <div class="cta">AYO JAGA KESEHATAN FISIK ANDA DARI SEKARANG DI VACCINE SCHEDULE</div>
    <div class="buttons">
        <button onclick="location.href='{{ route('login') }}'">Login</button>
        <button onclick="location.href='{{ route('register') }}'">Sign-Up</button>
    </div>
    <div class="note">Silakan Masuk / Daftar Untuk Masuk Ke Website Vaccine Schedule</div>
</body>
</html>
