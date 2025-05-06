<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
    <style>
        body {
            background-color: #ffc0cb;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            background-color: #fff;
            height: 100vh;
            padding: 20px;
        }
        .sidebar img {
            width: 100px;
            margin-bottom: 10px;
        }
        .sidebar a {
            display: block;
            color: #000;
            margin-bottom: 15px;
            text-decoration: none;
            padding: 8px;
            border-radius: 5px;
        }
        .sidebar a.active {
            background-color: #ff4d4d;
            color: white;
        }
        .footer {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar text-center">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <h5><strong>Vaccine Schedule</strong></h5>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'active' : '' }}">Tambah Vaksin</a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
        <a href="{{ route('notifikasi') }}" class="{{ request()->routeIs('notifikasi') ? 'active' : '' }}">Notifikasi</a>
        <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'active' : '' }}">Riwayat</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    
    <div class="flex-grow-1 p-4">
        @yield('content')
        <div class="footer mt-5">
            © 2025 <span style="color:#000">Vaccine Schedule.</span> All rights reserved.
        </div>
    </div>
</div>
</body>
</html>
