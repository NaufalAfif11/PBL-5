<x-app-layout>
    <div class="flex bg-gradient-to-br from-pink-100 to-white min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Daftar Vaksin</a>
                <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-grow p-10 relative">
            <div id="welcomeNotification" class="absolute top-4 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500 ease-in-out z-50">
                Selamat Datang di Dashboard Vaccine Schedule!
            </div>

            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2m0 0l2-2m-2 2v6m-6 4a9 9 0 1118 0H3z" />
                </svg>
                <h1 class="text-3xl font-bold">Dashboard</h1>
            </div>
            <h2 class="text-2xl font-semibold text-white-600 mb-6">Selamat Datang, {{ Auth::user()->name }}</h2>

            <!-- Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-sm text-gray-500">Total Vaksinasi</p>
                    <h3 class="text-xl font-bold text-pink-500">{{ $timeline->count() }}</h3>
                </div>
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-sm text-gray-500">Sudah</p>
                    <h3 class="text-xl font-bold text-green-500">{{ $timeline->where('status', 'Sudah')->count() }}</h3>
                </div>
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-sm text-gray-500">Dibatalkan</p>
                    <h3 class="text-xl font-bold text-red-500">{{ $timeline->where('status', 'Dibatalkan')->count() }}</h3>
                </div>
            </div>

            <!-- Timeline Vaksinasi -->
            <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md mb-10">
                <h3 class="text-lg font-semibold text-black-600 mb-4">Timeline Vaksinasi</h3>
                <div class="bg-white rounded shadow overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-pink-500 text-left text-sm text-white">
                                <th class="py-2 px-4 border-b">Tanggal</th>
                                <th class="py-2 px-4 border-b">Jam</th>
                                <th class="py-2 px-4 border-b">Nama Vaksin</th>
                                @if(Auth::user()->role == 'dokter')
                                    <th class="py-2 px-4 border-b">Nama Pasien</th>
                                @elseif(Auth::user()->role == 'pasien')
                                    <th class="py-2 px-4 border-b">Nama Dokter</th>
                                @endif
                                <th class="py-2 px-4 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($timeline as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->vaccine_date }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->vaccine_time }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->vaccine_name }}</td>
                                    @if(Auth::user()->role == 'dokter')
                                        <td class="py-2 px-4 border-b">{{ $item->patient_name ?? $item->patient_email }}</td>
                                    @elseif(Auth::user()->role == 'pasien')
                                        <td class="py-2 px-4 border-b">{{ $item->doctor_name }}</td>
                                    @endif
                                    <td class="py-2 px-4 border-b">
                                        <span class="inline-block bg-pink-200 text-pink-800 text-xs px-2 py-1 rounded">{{ $item->status }}</span>
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

            <!-- Tips -->
            <div class="bg-white p-4 rounded shadow text-center text-sm text-gray-600 italic mb-6">
                💡 "Jadwal vaksin yang teratur adalah langkah awal menuju hidup sehat dan aman."
            </div>

            <div class="text-center text-black font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </div>
    </div>
</x-app-layout>
