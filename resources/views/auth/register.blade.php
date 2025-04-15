<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Vaccine Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #ffc9d1;
            font-family: 'Inter', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 4px 6px 8px rgba(0,0,0,0.1);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #ff5a5f;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e6484f;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Registrasi</h2>
        <form action="{{ route('login') }}" method="GET">
            <div class="form-group">
                <input type="text" name="name" placeholder="Nama Pengguna" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="date" name="birthdate" placeholder="Tanggal Lahir" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Kata Sandi" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</div>
</body>
</html>
