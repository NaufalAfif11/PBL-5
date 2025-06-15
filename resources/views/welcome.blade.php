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
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            position: relative;
            overflow: hidden; /* Ensure no scrollbar appears */
        }
        /* Background video style */
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Make sure it's behind the content */
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 15px;
            max-width: 650px;
            width: 100%;
        }
        .logo {
            width: 150px; /* Change from 100px to 150px */
            margin-bottom: 30px;
        }
        h1 {
            font-size: 2.7rem;
            margin: 0;
        }
        p {
            margin-top: 10px;
            font-size: 1.1rem;
        }
        .cta {
            font-weight: bold;
            margin: 30px 0;
            font-size: 1.4rem;
        }
        .buttons button {
            background-color: #ff5e6c;
            border: none;
            padding: 12px 28px;
            margin: 10px;
            font-size: 1.05rem;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
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
    <!-- Background Video -->
    <video class="background-video" autoplay muted loop>
        <source src="{{ asset('videos/VaksinOpen.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="overlay">
        <img src="{{ asset('images/ss.png') }}" alt="Logo" class="logo">
        <h1>Vaccine Schedule</h1>
        <p>Aplikasi berbasis website yang bertujuan memudahkan anda mendapatkan vaksinasi dan imunisasi</p>
        <div class="cta">AYO JAGA KESEHATAN FISIK ANDA DARI SEKARANG DI VACCINE SCHEDULE</div>
        <div class="buttons">
            <button onclick="location.href='{{ route('login') }}'">Login</button>
            <button onclick="location.href='{{ route('register') }}'">Sign-Up</button>
        </div>
        <div class="note">Silakan Masuk / Daftar Untuk Masuk Ke Website Vaccine Schedule</div>
    </div>
</body>
</html>
