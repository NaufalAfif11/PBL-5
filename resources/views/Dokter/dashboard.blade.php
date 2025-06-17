<x-app-layout>
    <div class="flex">
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Daftar Vaksin</a>
                <a href="{{ route('notifikasi') }}" class="{{ request()->routeIs('notifikasi') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Notifikasi</a>
                <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        <div class="flex-grow bg-pink-200 p-6 flex flex-col items-center justify-start relative">
            {{-- Welcome Notification --}}
            <div id="welcomeNotification" class="absolute top-4 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500 ease-in-out z-50">
                Selamat Datang di Dashboard Vaccine Schedule!
            </div>

            <h2 class="text-2xl font-semibold text-red-600 mb-5">Selamat Datang di Dashboard Vaccine Schedule !</h2>

            {{-- Video Section --}}
            <div class="rounded-lg shadow-lg overflow-hidden mb-10">
                <video controls autoplay loop class="w-auto h-90">
                    <source src="{{ asset('videos/vaksinvid.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            {{-- Timeline Vaksinasi Section --}}
            <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Timeline Vaksinasi</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-pink-100 text-left text-sm text-red-600">
                                <th class="py-2 px-4 border-b">Tanggal</th>
                                <th class="py-2 px-4 border-b">Nama Vaksin</th>
                                <th class="py-2 px-4 border-b">Dokter</th>
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notifications as $notif)
                                <tr class="hover:bg-pink-50">
                                    <td class="py-2 px-4 border-b">{{ $notif->vaccine_date }}</td>
                                    <td class="py-2 px-4 border-b">{{ $notif->vaccine_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $notif->doctor_name }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <span class="inline-block px-2 py-1 text-xs rounded 
                                            {{ $notif->status == 'Menunggu' ? 'bg-yellow-200 text-yellow-800' : 
                                                ($notif->status == 'Sudah' ? 'bg-green-200 text-green-800' : 
                                                'bg-red-200 text-red-800') }}">
                                            {{ $notif->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <button onclick='showDetailModal(@json($notif))' class="bg-pink-500 hover:bg-pink-700 text-white px-3 py-1 rounded-md text-sm">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data vaksinasi.</td>
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

    {{-- JS for Modal --}}
    <script>
        function showDetailModal(data) {
            document.getElementById('detail-nama-vaksin').textContent = data.vaccine_name;
            document.getElementById('detail-tanggal').textContent = data.vaccine_date;
            document.getElementById('detail-antrian').textContent = data.queue;
            document.getElementById('detail-nama-dokter').textContent = data.doctor_name;
            document.getElementById('detail-alamat').textContent = data.address;
            document.getElementById('detail-status').textContent = data.status;
            document.getElementById('detail-operational-hours').textContent = data.operational_hours ?? '-';
            
            document.getElementById('detailModal').classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('welcomeNotification');
            notification.classList.remove('opacity-0');
            notification.classList.add('opacity-100');
            setTimeout(() => {
                notification.classList.remove('opacity-100');
                notification.classList.add('opacity-0');
            }, 3000);
        });
    </script>
</x-app-layout>
