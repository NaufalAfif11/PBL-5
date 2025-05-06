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

        <main class="flex-grow bg-pink-200 p-6">
            <h1 class="text-3xl font-bold text-red-600 mb-8">Riwayat Vaksinasi</h1>
            <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                <table class="min-w-full text-sm text-center border border-pink-300 border-collapse">
                    <thead class="bg-pink-300 text-black">
                        <tr>
                            <th class="px-4 py-2 border border-pink-300">No</th>
                            <th class="px-4 py-2 border border-pink-300">Nama Vaksin</th>
                            <th class="px-4 py-2 border border-pink-300">Tanggal</th>
                            <th class="px-4 py-2 border border-pink-300">Nama Dokter</th>
                            <th class="px-4 py-2 border border-pink-300">Alamat</th>
                            <th class="px-4 py-2 border border-pink-300">Status</th>
                            <th class="px-4 py-2 border border-pink-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100">
                        <tr class="hover:bg-pink-50" data-vaccine-name="Covovax" data-vaccine-date="21 Des 2025" data-doctor-name="Dr. Ivan" data-address="Batam" data-status="Sudah">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Covovax</td>
                            <td class="px-4 py-2">21 Des 2025</td>
                            <td class="px-4 py-2">Dr. Ivan</td>
                            <td class="px-4 py-2">Batam</td>
                            <td class="px-4 py-2 text-green-600 font-semibold">Sudah</td>
                            <td class="px-4 py-2">
                                <button class="detailBtn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-pink-50" data-vaccine-name="Sinovac" data-vaccine-date="15 Jan 2025" data-doctor-name="Dr. Bella" data-address="Jakarta" data-status="Menunggu">
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2">Sinovac</td>
                            <td class="px-4 py-2">15 Jan 2025</td>
                            <td class="px-4 py-2">Dr. Bella</td>
                            <td class="px-4 py-2">Jakarta</td>
                            <td class="px-4 py-2 text-green-600 font-semibold">Sudah</td>
                            <td class="px-4 py-2">
                                <button class="detailBtn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-pink-50" data-vaccine-name="Moderna" data-vaccine-date="10 Mar 2025" data-doctor-name="Dr. Siti" data-address="Surabaya" data-status="Batal">
                            <td class="px-4 py-2">3</td>
                            <td class="px-4 py-2">Moderna</td>
                            <td class="px-4 py-2">10 Mar 2025</td>
                            <td class="px-4 py-2">Dr. Siti</td>
                            <td class="px-4 py-2">Surabaya</td>
                            <td class="px-4 py-2 text-red-600 font-semibold">Batal</td>
                            <td class="px-4 py-2">
                                <button class="detailBtn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                            </td>
                        </tr>
                        {{-- Baris data vaksin lainnya akan ditambahkan di sini --}}
                    </tbody>
                </table>
            </div>

            {{-- Modal Detail --}}
            <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Detail Vaksinasi
                            </h3>
                            <div class="mt-4">
                                <p><span class="font-semibold">No:</span> <span id="detail-no"></span></p>
                                <p><span class="font-semibold">Nama Vaksin:</span> <span id="detail-nama-vaksin"></span></p>
                                <p><span class="font-semibold">Tanggal:</span> <span id="detail-tanggal"></span></p>
                                <p><span class="font-semibold">Nama Dokter:</span> <span id="detail-nama-dokter"></span></p>
                                <p><span class="font-semibold">Alamat:</span> <span id="detail-alamat"></span></p>
                                <p><span class="font-semibold">Status:</span> <span id="detail-status"></span></p>
                                <p><span class="font-semibold">Aksi:</span> -</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button id="closeDetailModalBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center text-red-600 font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </main>
    </div>

    <script>
        const detailModal = document.getElementById('detailModal');
        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const detailNo = document.getElementById('detail-no');
        const detailNamaVaksin = document.getElementById('detail-nama-vaksin');
        const detailTanggal = document.getElementById('detail-tanggal');
        const detailNamaDokter = document.getElementById('detail-nama-dokter');
        const detailAlamat = document.getElementById('detail-alamat');
        const detailStatus = document.getElementById('detail-status');
        const detailButtons = document.querySelectorAll('.detailBtn');
        const tableRows = document.querySelectorAll('table tbody tr');

        detailButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                const row = tableRows[index];
                const no = row.querySelector('td:nth-child(1)').textContent;
                const namaVaksin = row.dataset.vaccineName;
                const tanggal = row.dataset.vaccineDate;
                const namaDokter = row.dataset.doctorName;
                const alamat = row.dataset.address;
                const status = row.dataset.status;

                detailNo.textContent = no;
                detailNamaVaksin.textContent = namaVaksin;
                detailTanggal.textContent = tanggal;
                detailNamaDokter.textContent = namaDokter;
                detailAlamat.textContent = alamat;
                detailStatus.textContent = status;

                detailModal.classList.remove('hidden');
            });
        });

        closeDetailModalBtn.addEventListener('click', function() {
            detailModal.classList.add('hidden');
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == detailModal) {
                detailModal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>