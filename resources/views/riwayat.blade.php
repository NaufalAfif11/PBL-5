<x-app-layout>
    <div class="flex">
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Daftar Vaksin</a>
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
                            {{-- <th class="px-4 py-2 border border-pink-300">Alamat</th> Removed Alamat from table header --}}
                            <th class="px-4 py-2 border border-pink-300">Status</th>
                            <th class="px-4 py-2 border border-pink-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100" id="historyTableBody">
                        {{-- Initial hardcoded data removed to be consistent with dynamic loading --}}
                    </tbody>
                </table>
            </div>

            {{-- Modal Detail (similar to notifikasi, but without action buttons) --}}
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
                                {{-- <p><span class="font-semibold">Alamat:</span> <span id="detail-alamat"></span></p> Removed Alamat from detail content --}}
                                <p><span class="font-semibold">Status:</span> <span id="detail-status"></span></p>
                                <p><span class="font-semibold">Jam Operasional:</span> <span id="detail-operational-hours"></span></p>
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
        // const detailAlamat = document.getElementById('detail-alamat'); // Removed
        const detailStatus = document.getElementById('detail-status');
        const detailOperationalHours = document.getElementById('detail-operational-hours'); // Added for Riwayat
        const historyTableBody = document.getElementById('historyTableBody');
        let currentHistoryData = null; // To store data of the row being detailed

        // Function to load history from localStorage
        function loadHistory() {
            const storedHistory = JSON.parse(localStorage.getItem('vaccineHistory')) || [];
            historyTableBody.innerHTML = ''; // Clear existing rows

            storedHistory.forEach((item, index) => {
                const newRow = document.createElement('tr');
                newRow.classList.add('hover:bg-pink-50');

                // Store all history data as a dataset on the row
                for (const key in item) {
                    if (item.hasOwnProperty(key)) {
                        newRow.dataset[key] = item[key];
                    }
                }

                const statusClass = item.status === 'Sudah' ? 'text-green-600' : 'text-red-600';

                newRow.innerHTML = `
                    <td class="px-4 py-2">${index + 1}</td>
                    <td class="px-4 py-2">${item.vaccineName}</td>
                    <td class="px-4 py-2">${item.vaccineDate}</td>
                    <td class="px-4 py-2">${item.doctorName}</td>
                    {{-- <td class="px-4 py-2">${item.address}</td> Removed Alamat from table row HTML --}}
                    <td class="px-4 py-2 font-semibold ${statusClass}">${item.status}</td>
                    <td class="px-4 py-2">
                        <button class="detailBtn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                    </td>
                `;
                historyTableBody.appendChild(newRow);
            });

            attachDetailButtonListeners();
        }

        function attachDetailButtonListeners() {
            const detailButtons = document.querySelectorAll('.detailBtn');
            detailButtons.forEach(button => {
                button.removeEventListener('click', handleDetailButtonClick);
                button.addEventListener('click', handleDetailButtonClick);
            });
        }

        function handleDetailButtonClick() {
            const row = this.closest('tr');
            currentHistoryData = {};
            for (const key in row.dataset) {
                currentHistoryData[key] = row.dataset[key];
            }

            detailNo.textContent = row.querySelector('td:nth-child(1)').textContent; // Get 'No' from the displayed cell
            detailNamaVaksin.textContent = currentHistoryData.vaccineName;
            detailTanggal.textContent = currentHistoryData.vaccineDate;
            detailNamaDokter.textContent = currentHistoryData.doctorName;
            // detailAlamat.textContent = currentHistoryData.address; // Removed
            detailStatus.textContent = currentHistoryData.status;
            detailOperationalHours.textContent = currentHistoryData.operationalHours || '-'; // Display operational hours or '-' if not set

            detailModal.classList.remove('hidden');
        }

        closeDetailModalBtn.addEventListener('click', function() {
            detailModal.classList.add('hidden');
            currentHistoryData = null;
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == detailModal) {
                detailModal.classList.add('hidden');
                currentHistoryData = null;
            }
        });

        // Load history when the page loads
        document.addEventListener('DOMContentLoaded', loadHistory);
    </script>
</x-app-layout>