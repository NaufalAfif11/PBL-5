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

        <main class="flex-grow bg-pink-100 p-10">
            <h1 class="text-3xl font-bold mb-4">Tambah Vaksin</h1>
            <button id="addVaccineBtn" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ Tambah Vaksin</button>

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-pink-300 text-black">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama Vaksin</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Nama Dokter</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Status</th>
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

    <div id="vaccineModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-9 rounded shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Vaksin Baru</h2>
            <form action="#" method="POST" id="vaccineForm">
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

                <div class="mb-4">
                    <label for="patientAddress" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="patientAddress" name="patientAddress" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Alamat Pasien">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                        <option value="scheduled">Scheduled</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="closeModalBtn" class="bg-gray-300 text-black px-4 py-2 rounded mr-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addVaccineBtn = document.getElementById('addVaccineBtn');
        const vaccineModal = document.getElementById('vaccineModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const vaccineForm = document.getElementById('vaccineForm');
        const tbody = document.querySelector('table tbody');

        addVaccineBtn.addEventListener('click', function () {
            vaccineModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function () {
            vaccineModal.classList.add('hidden');
            vaccineForm.reset(); // Reset form ketika modal ditutup
        });

        vaccineForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const vaccineName = document.getElementById('vaccineName').value;
            const doctorName = document.getElementById('doctorName').value;
            const vaccineDate = document.getElementById('vaccineDate').value;
            const patientAddress = document.getElementById('patientAddress').value;
            const status = document.getElementById('status').value;

            const newRow = document.createElement('tr');
            const rowNumber = tbody.rows.length + 1;

            newRow.innerHTML = `
                <td class="px-4 py-2">${rowNumber}</td>
                <td class="px-4 py-2">${vaccineName}</td>
                <td class="px-4 py-2">${vaccineDate}</td>
                <td class="px-4 py-2">${doctorName}</td>
                <td class="px-4 py-2">${patientAddress}</td>
                <td class="px-4 py-2">${status}</td>
                <td class="px-4 py-2">
                    <button class="deleteBtn bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Hapus</button>
                </td>
            `;

            tbody.appendChild(newRow);
            vaccineModal.classList.add('hidden');
            vaccineForm.reset();

            // Event listener for delete button in the new row
            newRow.querySelector('.deleteBtn').addEventListener('click', function () {
                newRow.remove();
                // Re-number the table rows
                const rows = tbody.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == vaccineModal) {
                vaccineModal.classList.add('hidden');
                vaccineForm.reset();
            }
        });
    </script>
</x-app-layout>