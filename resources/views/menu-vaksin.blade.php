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

        <main class="flex-grow bg-pink-100 p-10">
            <h1 class="text-3xl font-bold mb-4">Daftar Vaksin</h1>
            <button id="addVaccineBtn" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ Tambah Vaksin</button>

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-pink-300 text-black">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama Vaksin</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Nama Dokter</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {{-- Data vaksin akan ditambahkan via JavaScript --}}
                    </tbody>
                </table>
            </div>

            <div class="mt-10 text-center text-red-600 font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </main>
    </div>

    {{-- Modal Tambah/Detail Vaksin --}}
    <div id="vaccineModal" class="fixed z-20 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah Vaksin Baru</h2>
            <form id="vaccineForm" action="#" method="POST">
                <div id="addFormFields">
                    <div class="mb-4">
                        <label for="vaccineName" class="block text-sm font-medium text-gray-700">Nama Vaksin</label>
                        <select id="vaccineName" name="vaccineName" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
                            <option value="">Pilih Vaksin</option>
                            <option value="Vaksin A">Vaksin A</option>
                            <option value="Vaksin B">Vaksin B</option>
                            <option value="Vaksin C">Vaksin C</option>
                            <option value="Vaksin D">Vaksin D</option>
                            <option value="Vaksin E">Vaksin E</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="doctorName" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                        <input type="text" id="doctorName" name="doctorName" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Nama Dokter">
                    </div>
                    <div class="mb-4">
                        <label for="vaccineDate" class="block text-sm font-medium text-gray-700">Tanggal Vaksin</label>
                        <input type="date" id="vaccineDate" name="vaccineDate" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>
                    {{-- Removed Alamat field --}}
                </div>

                <div id="detailFormFields" class="hidden">
                    <div id="vaccineDetailContent">
                        {{-- Informasi detail vaksin akan ditampilkan di sini --}}
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" id="closeModalBtn" class="bg-gray-300 text-black px-4 py-2 rounded mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Batal</button>
                    <button type="submit" id="saveModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addVaccineBtn = document.getElementById('addVaccineBtn');
        const vaccineModal = document.getElementById('vaccineModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const saveModalBtn = document.getElementById('saveModalBtn');
        const vaccineForm = document.getElementById('vaccineForm');
        const tbody = document.querySelector('table tbody');
        const modalTitle = document.getElementById('modalTitle');
        const addFormFields = document.getElementById('addFormFields');
        const detailFormFields = document.getElementById('detailFormFields');
        const vaccineDetailContent = document.getElementById('vaccineDetailContent');
        let currentVaccineData = null;

        addVaccineBtn.addEventListener('click', function () {
            modalTitle.textContent = 'Tambah Vaksin Baru';
            addFormFields.classList.remove('hidden');
            detailFormFields.classList.add('hidden');
            saveModalBtn.classList.remove('hidden'); // Show save button for add form
            closeModalBtn.textContent = 'Batal'; // Ensure button text is 'Batal' for add
            vaccineForm.removeEventListener('submit', handleDetailSubmit); // Ensure detail listener is off
            vaccineForm.addEventListener('submit', handleAddSubmit);
            vaccineModal.classList.remove('hidden');
            vaccineForm.reset(); // Clear form fields when opening for add
        });

        function handleAddSubmit(e) {
            e.preventDefault();
            const vaccineName = document.getElementById('vaccineName').value;
            const doctorName = document.getElementById('doctorName').value;
            const vaccineDate = document.getElementById('vaccineDate').value;
            // patientAddress is no longer needed

            // Simpan ke localStorage
            let vaccines = JSON.parse(localStorage.getItem('vaccineList')) || [];
            const newVaccine = {
                vaccineName,
                doctorName,
                vaccineDate,
                // patientAddress is no longer needed
            };
            vaccines.push(newVaccine);
            localStorage.setItem('vaccineList', JSON.stringify(vaccines));

            // Render ulang tabel
            renderVaccineTable();

            vaccineModal.classList.add('hidden');
            vaccineForm.reset();
            vaccineForm.removeEventListener('submit', handleAddSubmit);
        }

        function showVaccineDetail(data) {
            modalTitle.textContent = 'Detail Vaksin';
            addFormFields.classList.add('hidden');
            detailFormFields.classList.remove('hidden');
            saveModalBtn.classList.add('hidden'); // Hide save button for detail view
            closeModalBtn.textContent = 'Tutup'; // Change button text to 'Tutup' for detail view
            vaccineDetailContent.innerHTML = `
                <p><strong>No:</strong> ${data.no}</p>
                <p><strong>Nama Vaksin:</strong> ${data.namaVaksin}</p>
                <p><strong>Tanggal:</strong> ${data.tanggal}</p>
                <p><strong>Nama Dokter:</strong> ${data.namaDokter}</p>
                {{-- Removed Alamat from detail content --}}
            `;
            vaccineForm.removeEventListener('submit', handleAddSubmit); // Ensure add listener is off
            // Removed adding handleDetailSubmit as there's no save action in detail view
            vaccineModal.classList.remove('hidden');
        }

        function renderVaccineTable() {
            tbody.innerHTML = '';
            const vaccines = JSON.parse(localStorage.getItem('vaccineList')) || [];

            vaccines.forEach((vaccine, index) => {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="px-4 py-2">${index + 1}</td>
                    <td class="px-4 py-2">${vaccine.vaccineName}</td>
                    <td class="px-4 py-2">${vaccine.vaccineDate}</td>
                    <td class="px-4 py-2">${vaccine.doctorName}</td>
                    {{-- Removed Alamat from table row --}}
                    <td class="px-4 py-2">
                        <button class="detailBtn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Detail</button>
                    </td>
                `;

                // Tambahkan event listener untuk tombol detail
                newRow.querySelector('.detailBtn').addEventListener('click', function () {
                    currentVaccineData = {
                        no: index + 1,
                        namaVaksin: vaccine.vaccineName,
                        tanggal: vaccine.vaccineDate,
                        namaDokter: vaccine.doctorName,
                        // alamat is no longer needed
                    };
                    showVaccineDetail(currentVaccineData);
                });

                tbody.appendChild(newRow);
            });
        }

        // Removed handleDetailSubmit function entirely as there's no save action in detail view
        /*
        function handleDetailSubmit(e) {
            e.preventDefault();
            if (currentVaccineData) {
                const notificationData = {
                    vaccineName: currentVaccineData.namaVaksin,
                    vaccineDate: currentVaccineData.tanggal,
                    doctorName: currentVaccineData.namaDokter,
                    // address is no longer needed
                };

                let existingNotifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
                existingNotifications.push(notificationData);
                localStorage.setItem('vaccineNotifications', JSON.stringify(existingNotifications));

                let vaccines = JSON.parse(localStorage.getItem('vaccineList')) || [];
                vaccines = vaccines.filter(v => !(v.vaccineName === currentVaccineData.namaVaksin && v.vaccineDate === currentVaccineData.tanggal));
                localStorage.setItem('vaccineList', JSON.stringify(vaccines));

                alert(`Notifikasi untuk vaksin ${currentVaccineData.namaVaksin} telah disimpan!`);
                vaccineModal.classList.add('hidden');
                currentVaccineData = null;
                vaccineForm.removeEventListener('submit', handleDetailSubmit);

                renderVaccineTable();
            }
        }
        */

        closeModalBtn.addEventListener('click', function () {
            vaccineModal.classList.add('hidden');
            vaccineForm.reset();
            vaccineForm.removeEventListener('submit', handleAddSubmit);
            // Removed removing handleDetailSubmit listener as the function is gone
            modalTitle.textContent = 'Tambah Vaksin Baru'; // Reset modal title
            addFormFields.classList.remove('hidden');
            detailFormFields.classList.add('hidden');
            saveModalBtn.classList.remove('hidden'); // Ensure save button is visible for next add
            closeModalBtn.textContent = 'Batal'; // Reset button text to 'Batal'
            currentVaccineData = null;
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == vaccineModal) {
                vaccineModal.classList.add('hidden');
                vaccineForm.reset();
                vaccineForm.removeEventListener('submit', handleAddSubmit);
                // Removed removing handleDetailSubmit listener as the function is gone
                modalTitle.textContent = 'Tambah Vaksin Baru'; // Reset modal title
                addFormFields.classList.remove('hidden');
                detailFormFields.classList.add('hidden');
                saveModalBtn.classList.remove('hidden'); // Ensure save button is visible for next add
                closeModalBtn.textContent = 'Batal'; // Reset button text to 'Batal'
                currentVaccineData = null;
            }
        });

        // Muat data saat pertama kali halaman dibuka
        document.addEventListener('DOMContentLoaded', function () {
            renderVaccineTable();
        });
    </script>
</x-app-layout>