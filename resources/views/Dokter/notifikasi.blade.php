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

        <main class="flex-grow bg-pink-100 p-6">
            <h1 class="text-3xl font-bold text-red-500 mb-8">Notifikasi Vaksinasi</h1>
            <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                <table class="min-w-full text-sm text-center border border-pink-500 border-collapse">
                    <thead class="bg-pink-300 text-black">
                        <tr>
                            <th class="px-4 py-2 border border-pink-300">Nama Vaksin</th>
                            <th class="px-4 py-2 border border-pink-300">Tanggal</th>
                            <th class="px-4 py-2 border border-pink-300">Antrian</th>
                            <th class="px-4 py-2 border border-pink-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100">
    @forelse ($notifications as $notif)
        <tr class="hover:bg-pink-50">
            <td class="px-4 py-2">{{ $notif->vaccine_name }}</td>
            <td class="px-4 py-2">{{ $notif->vaccine_date }}</td>
            <td class="px-4 py-2">{{ $notif->queue }}</td>
            <td class="px-4 py-2">
                <button onclick="showDetailModal(@json($notif))"
                        class="detailBtn bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Detail
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada notifikasi.</td>
        </tr>
    @endforelse
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
                                <p><span class="font-semibold">Nama Vaksin:</span> <span id="detail-nama-vaksin"></span></p>
                                <p><span class="font-semibold">Tanggal:</span> <span id="detail-tanggal"></span></p>
                                <p><span class="font-semibold">Antrian:</span> <span id="detail-antrian"></span></p>
                                <p><span class="font-semibold">Nama Dokter:</span> <span id="detail-nama-dokter"></span></p>
                                <p><span class="font-semibold">Alamat:</span> <span id="detail-alamat"></span></p>
                                <p><span class="font-semibold">Status:</span> <span id="detail-status"></span></p>
                                <p><span class="font-semibold">Jam Operasional:</span> <span id="detail-operational-hours"></span></p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse justify-between">
                            <button id="markAsDoneBtn" type="button" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Sudah
                            </button>
                            <button id="markAsCanceledBtn" type="button" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Dibatalkan
                            </button>
                            <button id="closeDetailModalBtn" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto">
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
        const detailNamaVaksin = document.getElementById('detail-nama-vaksin');
        const detailTanggal = document.getElementById('detail-tanggal');
        const detailAntrian = document.getElementById('detail-antrian');
        const detailNamaDokter = document.getElementById('detail-nama-dokter');
        const detailAlamat = document.getElementById('detail-alamat');
        const detailStatus = document.getElementById('detail-status');
        const detailOperationalHours = document.getElementById('detail-operational-hours');
        const notificationTableBody = document.querySelector('#notificationTableBody');
        let currentRowData = null; // To store the complete data of the row being detailed

        // Function to load notifications from localStorage
        function loadNotifications() {
            const storedNotifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];

            // Clear existing rows to prevent duplicates when reloading
            notificationTableBody.innerHTML = ''; 

            storedNotifications.forEach((notification) => {
                const newRow = document.createElement('tr');
                newRow.classList.add('hover:bg-pink-50');
                
                // Store all notification data as a dataset on the row
                for (const key in notification) {
                    if (notification.hasOwnProperty(key)) {
                        newRow.dataset[key] = notification[key];
                    }
                }

                newRow.innerHTML = `
                    <td class="px-4 py-2">${notification.vaccineName}</td>
                    <td class="px-4 py-2">${notification.vaccineDate}</td>
                    <td class="px-4 py-2">${notification.queue}</td>
                    <td class="px-4 py-2">
                        <button class="detailBtn bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Detail</button>
                    </td>
                `;
                notificationTableBody.appendChild(newRow);
            });

            // Re-attach event listeners to all detail buttons (including newly added ones)
            attachDetailButtonListeners();
        }

        // Function to attach event listeners to detail buttons
        function attachDetailButtonListeners() {
            const detailButtons = document.querySelectorAll('.detailBtn');
            detailButtons.forEach(button => {
                button.removeEventListener('click', handleDetailButtonClick); 
                button.addEventListener('click', handleDetailButtonClick);
            });
        }

        function handleDetailButtonClick() {
            const row = this.closest('tr');
            currentRowData = {};
            for (const key in row.dataset) {
                currentRowData[key] = row.dataset[key];
            }
            
            detailNamaVaksin.textContent = currentRowData.vaccineName;
            detailTanggal.textContent = currentRowData.vaccineDate;
            detailAntrian.textContent = currentRowData.queue;
            detailNamaDokter.textContent = currentRowData.doctorName;
            detailAlamat.textContent = currentRowData.address;
            detailStatus.textContent = currentRowData.status;
            detailOperationalHours.textContent = currentRowData.operationalHours || '-';

            detailModal.classList.remove('hidden');
        }

        closeDetailModalBtn.addEventListener('click', function() {
            detailModal.classList.add('hidden');
            currentRowData = null;
        });

        function addToHistory(vaccineData, status) {
            let history = JSON.parse(localStorage.getItem('vaccineHistory')) || [];
            
            // Add a unique ID if you need to manage entries
            vaccineData.id = vaccineData.vaccineName + '-' + vaccineData.vaccineDate + '-' + Date.now(); 
            vaccineData.status = status; // Set the status to "Sudah" or "Batal"
            history.push(vaccineData);
            localStorage.setItem('vaccineHistory', JSON.stringify(history));
        }

        document.getElementById('markAsDoneBtn').addEventListener('click', function() {
            if (currentRowData) {
                addToHistory(currentRowData, 'Sudah'); // Add to history with status "Sudah"
                
                // Remove from current notifications
                let existingNotifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
                existingNotifications = existingNotifications.filter(notif => 
                    !(notif.vaccineName === currentRowData.vaccineName && notif.vaccineDate === currentRowData.vaccineDate)
                );
                localStorage.setItem('vaccineNotifications', JSON.stringify(existingNotifications));
                
                detailModal.classList.add('hidden');
                currentRowData = null;
                loadNotifications(); // Reload the table to reflect changes

                alert('Vaksinasi ditandai sebagai "Sudah" dan dipindahkan ke riwayat.');
            }
        });

        document.getElementById('markAsCanceledBtn').addEventListener('click', function() {
            if (currentRowData) {
                addToHistory(currentRowData, 'Batal'); // Add to history with status "Batal"

                // Remove from current notifications
                let existingNotifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
                existingNotifications = existingNotifications.filter(notif => 
                    !(notif.vaccineName === currentRowData.vaccineName && notif.vaccineDate === currentRowData.vaccineDate)
                );
                localStorage.setItem('vaccineNotifications', JSON.stringify(existingNotifications));

                detailModal.classList.add('hidden');
                currentRowData = null;
                loadNotifications(); // Reload the table to reflect changes
                
                alert('Vaksinasi ditandai sebagai "Dibatalkan" dan dipindahkan ke riwayat.');
            }
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == detailModal) {
                detailModal.classList.add('hidden');
                currentRowData = null;
            }
        });

        // Load notifications when the page loads
document.addEventListener('DOMContentLoaded', loadNotifications);

function loadNotifications() {
    const notificationTableBody = document.getElementById('notificationTableBody');
    notificationTableBody.innerHTML = ''; // kosongkan

    const storedNotifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];

    storedNotifications.forEach((notification) => {
        const newRow = document.createElement('tr');
        newRow.classList.add('hover:bg-pink-50');

        newRow.innerHTML = `
            <td class="px-4 py-2">${notification.vaccineName}</td>
            <td class="px-4 py-2">${notification.vaccineDate}</td>
            <td class="px-4 py-2">${notification.queue}</td>
            <td class="px-4 py-2">
                <button onclick="showDetailModal(${JSON.stringify(notification).replace(/"/g, '&quot;')})"
                    class="bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Detail
                </button>
            </td>
        `;
        notificationTableBody.appendChild(newRow);
    });
    }    
    </script>
</x-app-layout>