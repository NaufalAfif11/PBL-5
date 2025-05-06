<x-app-layout>
    <div class="flex">
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Tambah Vaksin</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Profil</a>
                <a href="{{ route('notifikasi') }}" class="{{ request()->routeIs('notifikasi') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Notifikasi</a>
                <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        <div class="flex-grow bg-pink-200 p-6 flex flex-col items-center justify-center">
            <h2 class="text-2xl font-semibold text-red-600 mb-5">Selamat Datang di Dashboard Vaccine Schedule!</h2>
            <div class="rounded-lg shadow-lg overflow-hidden">
                <video controls autoplay loop class="w-auto h-90">
                    <source src="{{ asset('videos/vaksinvid.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="mt-10 text-center text-red-600 font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </div>
    </div>
</x-app-layout>
