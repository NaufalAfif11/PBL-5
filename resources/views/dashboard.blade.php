<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Daftar Vaksin</a>
                <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-grow bg-pink-100 p-10 relative">
            <div id="welcomeNotification" class="absolute top-4 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500 ease-in-out z-50">
                Selamat Datang di Dashboard Vaccine Schedule!
            </div>

            <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
            <h2 class="text-2xl font-semibold text-red-600 mb-5">Selamat Datang, {{ Auth::user()->name }}</h2>

            <!-- Timeline Vaksinasi -->
            <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md mb-10">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Timeline Vaksinasi</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-pink-100 text-left text-sm text-red-600">
                                <th class="py-2 px-4 border-b">Tanggal</th>
                                <th class="py-2 px-4 border-b">Nama Vaksin</th>
                                <th class="py-2 px-4 border-b">Nama Dokter</th>
                                <th class="py-2 px-4 border-b">Nama Pasien</th>
                                <th class="py-2 px-4 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($timeline as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->vaccine_date }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->vaccine_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->doctor_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->patient_email }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded">{{ $item->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-2 px-4 text-center text-gray-600">Belum ada vaksin yang dijadwalkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-10 text-center text-red-600 font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </div>
    </div>
</x-app-layout>
