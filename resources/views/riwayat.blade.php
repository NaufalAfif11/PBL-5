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

        <!-- Main content -->
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
                            <th class="px-4 py-2 border border-pink-300">Status</th>
                            <th class="px-4 py-2 border border-pink-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100" id="historyTableBody">
                        <!-- Diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Modal Detail -->
            <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                    <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Vaksinasi</h3>
                            <div class="space-y-2">
                                <p><strong>No:</strong> <span id="detail-no"></span></p>
                                <p><strong>Nama Vaksin:</strong> <span id="detail-nama-vaksin"></span></p>
                                <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                                <p><strong>Nama Dokter:</strong> <span id="detail-nama-dokter"></span></p>
                                <p><strong>Status:</strong> <span id="detail-status"></span></p>
                                <p><strong>Jam Operasional:</strong> <span id="detail-operational-hours"></span></p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button id="closeDetailModalBtn" type="button" class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 font-medium">
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
        const historyTableBody = document.getElementById('historyTableBody');

        const detailNo = document.getElementById('detail-no');
        const detailNamaVaksin = document.getElementById('detail-nama-vaksin');
        const detailTanggal = document.getElementById('detail-tanggal');
        const detailNamaDokter = document.getElementById('detail-nama-dokter');
        const detailStatus = document.getElementById('detail-status');
        const detailOperationalHours = document.getElementById('detail-operational-hours');

        function loadHistory() {
            const storedHistory = JSON.parse(localStorage.getItem('vaccineHistory')) || [];
            historyTableBody.innerHTML = '';

            storedHistory.forEach((item, index) => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-pink-50');
                for (const key in item) {
                    if (item.hasOwnProperty(key)) {
                        row.dataset[key] = item[key];
                    }
                }

                const statusClass = item.status === 'Sudah' ? 'text-green-600' : 'text-red-600';

                row.innerHTML = `
                    <td class="px-4 py-2">${index + 1}</td>
                    <td class="px-4 py-2">${item.vaccineName}</td>
                    <td class="px-4 py-2">${item.vaccineDate}</td>
                    <td class="px-4 py-2">${item.doctorName}</td>
                    <td class="px-4 py-2 font-semibold ${statusClass}">${item.status}</td>
                    <td class="px-4 py-2">
                        <button class="detailBtn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                    </td>
                `;
                historyTableBody.appendChild(row);
            });

            attachDetailButtonListeners();
        }

        function attachDetailButtonListeners() {
            document.querySelectorAll('.detailBtn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const row = this.closest('tr');
                    detailNo.textContent = row.querySelector('td:nth-child(1)').textContent;
                    detailNamaVaksin.textContent = row.dataset.vaccineName;
                    detailTanggal.textContent = row.dataset.vaccineDate;
                    detailNamaDokter.textContent = row.dataset.doctorName;
                    detailStatus.textContent = row.dataset.status;
                    detailOperationalHours.textContent = row.dataset.operationalHours || '-';

                    detailModal.classList.remove('hidden');
                });
            });
        }

        closeDetailModalBtn.addEventListener('click', () => detailModal.classList.add('hidden'));

        window.addEventListener('click', function(event) {
            if (event.target === detailModal) {
                detailModal.classList.add('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', loadHistory);
    </script>
</x-app-layout>
