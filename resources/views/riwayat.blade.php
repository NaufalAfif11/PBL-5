<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}"
                    class="{{ request()->routeIs('menu-vaksin') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Daftar
                    Vaksin</a>
                <a href="{{ route('riwayat') }}"
                    class="{{ request()->routeIs('riwayat') ? 'bg-pink-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </nav>
        </div>

        <!-- Main content -->
        <main class="flex-grow bg-pink-100 p-6">
            <h1 class="text-3xl font-bold text-black-600 mb-8">Riwayat Vaksinasi</h1>
            <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md mb-10">
                <div class="bg-white overflow-x-auto">
                    <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                        <div class="mb-4">
                            <form method="GET" action="{{ route('riwayat') }}" class="flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari vaksin, dokter, atau status..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:border-pink-400">
                                <button type="submit"
                                    class="bg-pink-500 text-white px-4 rounded-r-md hover:bg-pink-600">Cari</button>
                            </form>
                        </div>
                        <table class="min-w-full text-sm text-center border border-pink-100 border-collapse">
                            <thead class="bg-pink-500 text-white">
                                <tr>
                                    <th class="px-4 py-2 border border-pink-500">No</th>
                                    <th class="px-4 py-2 border border-pink-500">Nama Vaksin</th>
                                    <th class="px-4 py-2 border border-pink-500">Tanggal</th>
                                    <th class="px-4 py-2 border border-pink-500">Jam</th>
                                    <th class="px-4 py-2 border border-pink-500">Nama Dokter</th>
                                    <th class="px-4 py-2 border border-pink-500">Status</th>
                                    <th class="px-4 py-2 border border-pink-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-white-100">
                                @forelse ($riwayat as $index => $item)
                                    <tr class="hover:bg-pink-100">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $item->vaccine_name }}</td>
                                        <td class="px-4 py-2">{{ $item->vaccine_date }}</td>
                                        <td class="px-4 py-2">{{ $item->vaccine_time }}</td>
                                        <td class="px-4 py-2">{{ $item->doctor_name }}</td>
                                        <td class="px-4 py-2 font-semibold {{ $item->status == 'Sudah' ? 'text-pink-600' : 'text-pink-600' }}">
                                            {{ $item->status }}</td>
                                        <td class="px-4 py-2">
                                            <button onclick="showDetail({{ $item->id }})"
                                                class="bg-pink-400 text-white px-4 py-2 rounded-md hover:bg-pink-500">Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-gray-500 italic text-center">
                                            @if(request('search'))
                                                Tidak ditemukan hasil untuk pencarian <strong>"{{ request('search') }}"</strong>.
                                            @else
                                                Tidak ada riwayat vaksinasi.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse 
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Detail -->
                    <div id="detailModal" class="fixed inset-0 z-50 hidden modal-overlay backdrop-blur-sm bg-black/30">
                        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                            <div
                                class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 scale-95 sm:scale-100 sm:align-middle sm:max-w-lg w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Vaksinasi</h3>
                                    <div class="space-y-2">
                                        <p><strong>Nama Vaksin:</strong> <span id="detail-nama-vaksin"></span></p>
                                        <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                                        <p><strong>Jam:</strong> <span id="detail-jam"></span></p>
                                        <p><strong>Nama Dokter:</strong> <span id="detail-nama-dokter"></span></p>
                                        <p><strong>Status:</strong> <span id="detail-status"></span></p>
                                    </div>
                                </div>
                                <div class="bg-pink-150 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button id="closeDetailModalBtn" type="button"
                                        class="w-full sm:w-auto inline-flex justify-center rounded-md border border-pink-300 shadow-sm px-4 py-2 bg-pink text-pink-700 hover:bg-pink-50 font-medium">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-10 text-center text-black-600 font-bold">
                        © 2025 Vaccine Schedule. All rights reserved.
                    </div>
        </main>
    </div>

    <script>
        function showDetail(id) {
            fetch(`/vaksinasi/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-nama-vaksin').textContent = data.vaccine_name;
                    document.getElementById('detail-tanggal').textContent = data.vaccine_date;
                    document.getElementById('detail-jam').textContent = data.vaccine_time;
                    document.getElementById('detail-nama-dokter').textContent = data.doctor_name;
                    document.getElementById('detail-status').textContent = data.status;
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }

        document.getElementById('closeDetailModalBtn').addEventListener('click', () => {
            document.getElementById('detailModal').classList.add('hidden');
        });

        window.addEventListener('click', function (event) {
            if (event.target === document.getElementById('detailModal')) {
                document.getElementById('detailModal').classList.add('hidden');
            }
        });

    </script>
</x-app-layout>
