<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f06292, #f8bbd0);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            padding: 20px 40px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            flex-wrap: wrap;
        }

        .left-content {
            max-width: 500px;
        }

        .left-content h1 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .left-content h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #ffffff;
            font-weight: 700;
        }

        .left-content p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #fdfdfd;
        }

        .buttons {
            display: flex;
            gap: 1rem;
        }

        .buttons button {
            background-color: white;
            color: #ff5e6c;
            border: none;
            padding: 12px 32px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .buttons button:hover {
            background-color: #ffe5ea;
        }

        .logo-right {
            max-width: 300px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .left-content, .logo-right {
                max-width: 100%;
            }

            .buttons {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <header>
        <div>VACCINE SCHEDULE</div>
        <nav>
            <span style="margin-right: 20px;">Beranda</span>
            <span style="margin-right: 20px;">Layanan</span>
            <span>Kontak</span>
        </nav>
    </header>

    <div class="container">
        <div class="left-content">
            <h1>Halo, Selamat Datang</h1>
            <h2>AYO JAGA KESEHATAN FISIK ANDA DARI SEKARANG<br>DENGAN VACCINE SCHEDULE</h2>
            <p>Aplikasi berbasis website yang bertujuan memudahkan anda berkonsultasi Vaksin kepada dokter yang terpercaya</p>
            <div class="buttons">
                <button onclick="location.href='{{ route('login') }}'">MASUK</button>
                <button onclick="location.href='{{ route('register') }}'">DAFTAR</button>
            </div>
        </div>

        <img src="{{ asset('images/logo.png') }}" alt="Vaccine Logo" class="logo-center">
    </div>
</body>
</html>
