@extends('layouts.app') {{-- pastikan layout ini ada --}}

@section('content')
<div class="min-h-screen flex">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r text-red-600 font-semibold p-4">
        <div class="text-center text-xl font-bold mb-6">Vaccine Schedule</div>
        <ul class="space-y-4">
            <li><a href="#" class="hover:text-red-400">🏠 Beranda</a></li>
            <li><a href="#" class="hover:text-red-400">📋 Menu Vaksin</a></li>
            <li class="text-white bg-red-500 rounded px-3 py-1">👤 Profil</li>
            <li><a href="#" class="hover:text-red-400">🔔 Notifikasi</a></li>
            <li><a href="#" class="hover:text-red-400">📜 Riwayat</a></li>
            <li><a href="#" class="hover:text-red-400">📤 Keluar</a></li>
        </ul>
    </aside>

    {{-- Content --}}
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold text-center text-red-600 mb-8">Profile</h1>
        
        <div class="max-w-2xl mx-auto bg-white rounded-lg p-8 shadow-md text-center">
            <img src="https://www.svgrepo.com/show/382106/profile-avatar.svg" alt="avatar" class="w-24 h-24 mx-auto rounded-full mb-4">
            <h2 class="text-lg font-bold text-red-600">{{ $user->name }}</h2>

            <div class="text-left mt-6 space-y-4">
                <div>
                    <label class="font-semibold">Nama</label>
                    <input type="text" value="{{ $user->name }}" class="block w-full px-4 py-2 border rounded bg-gray-50" readonly>
                </div>
                <div>
                    <label class="font-semibold">Email</label>
                    <input type="text" value="{{ $user->email }}" class="block w-full px-4 py-2 border rounded bg-gray-50" readonly>
                </div>
                <div>
                    <label class="font-semibold">Tanggal Lahir</label>
                    <input type="date" value="{{ $user->tanggal_lahir ?? '2025-04-05' }}" class="block w-full px-4 py-2 border rounded bg-gray-50" readonly>
                </div>
            </div>

            <div class="mt-6">
                <button class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Pengaturan</button>
            </div>
        </div>

        <footer class="text-center text-sm text-red-600 mt-10">
            © 2025 Vaccine Schedule. All rights reserved.
        </footer>
    </main>
</div>
@endsection
