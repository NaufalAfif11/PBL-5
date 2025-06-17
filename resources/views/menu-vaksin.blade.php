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

        <!-- Main Content -->
        <main class="flex-grow bg-pink-100 p-10">
            <h1 class="text-3xl font-bold mb-4">Daftar Vaksin</h1>

@if (Auth::user()->role === 'pasien')
    <button id="addVaccineBtn" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ Tambah Vaksin</button>
@endif

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
                    <tbody class="bg-white" id="vaccineTableBody">
                        <!-- JS will populate this -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Vaksin -->
    <div id="vaccineModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Vaksin Baru</h2>
            <form id="vaccineForm">
                <div class="mb-4">
                    <label for="vaccineName" class="block text-sm font-medium text-gray-700">Nama Vaksin</label>
                    <select id="vaccineName" class="w-full border rounded px-3 py-2">
                        <option value="">Pilih Vaksin</option>
                        <option value="Vaksin A">Vaksin A</option>
                        <option value="Vaksin B">Vaksin B</option>
                        <option value="Vaksin C">Vaksin C</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="doctorName" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <input type="text" id="doctorName" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label for="vaccineDate" class="block text-sm font-medium text-gray-700">Tanggal Vaksin</label>
                    <input type="date" id="vaccineDate" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalBtn" class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail (untuk dokter dan riwayat) -->
    <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Vaksinasi</h3>
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
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="markAsDoneBtn" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2">Sudah</button>
                    <button id="markAsCanceledBtn" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Dibatalkan</button>
                    <button id="closeDetailModalBtn" class="bg-gray-300 px-4 py-2 rounded-md">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<script>
    const userRole = @json(Auth::user()->role);
</script>

    <script>
        
        // Pasien Simpan
        document.getElementById('vaccineForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            const vaccineName = document.getElementById('vaccineName').value;
            const doctorName = document.getElementById('doctorName').value;
            const vaccineDate = document.getElementById('vaccineDate').value;
            const newData = {
                vaccineName,
                doctorName,
                vaccineDate,
                queue: Math.floor(Math.random() * 100) + 1,
                address: 'Jl. Contoh No.1',
                status: 'Menunggu',
                operationalHours: '08:00 - 15:00'
            };
            let list = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
            list.push(newData);
            localStorage.setItem('vaccineNotifications', JSON.stringify(list));
            document.getElementById('vaccineModal').classList.add('hidden');
            this.reset();
            renderTable();
        });

        // Render Table
        function renderTable() {
    const body = document.getElementById('vaccineTableBody');
    body.innerHTML = '';
    const data = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
    data.forEach((d, i) => {
        const encodedData = JSON.stringify(d).replace(/"/g, '&quot;');
        const detailButton = userRole === 'dokter' 
            ? `<button onclick='showDetail(${encodedData})' class="bg-blue-500 text-white px-2 py-1 rounded">Detail</button>` 
            : '';
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-2">${i + 1}</td>
            <td class="px-4 py-2">${d.vaccineName}</td>
            <td class="px-4 py-2">${d.vaccineDate}</td>
            <td class="px-4 py-2">${d.doctorName}</td>
            <td class="px-4 py-2">${detailButton}</td>
        `;
        body.appendChild(row);
    });
}


        // Detail Modal
        function showDetail(data) {
            document.getElementById('detail-nama-vaksin').textContent = data.vaccineName;
            document.getElementById('detail-tanggal').textContent = data.vaccineDate;
            document.getElementById('detail-antrian').textContent = data.queue;
            document.getElementById('detail-nama-dokter').textContent = data.doctorName;
            document.getElementById('detail-alamat').textContent = data.address;
            document.getElementById('detail-status').textContent = data.status;
            document.getElementById('detail-operational-hours').textContent = data.operationalHours;
            document.getElementById('detailModal').classList.remove('hidden');

            // Tambah aksi tombol konfirmasi
            document.getElementById('markAsDoneBtn').onclick = function () {
                moveToHistory(data, 'Sudah');
            };
            document.getElementById('markAsCanceledBtn').onclick = function () {
                moveToHistory(data, 'Dibatalkan');
            };
        }

        function moveToHistory(data, status) {
            let history = JSON.parse(localStorage.getItem('vaccineHistory')) || [];
            data.status = status;
            history.push(data);
            localStorage.setItem('vaccineHistory', JSON.stringify(history));

            let notifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
            notifications = notifications.filter(n => !(n.vaccineName === data.vaccineName && n.vaccineDate === data.vaccineDate));
            localStorage.setItem('vaccineNotifications', JSON.stringify(notifications));
            document.getElementById('detailModal').classList.add('hidden');
            renderTable();
        }

        document.getElementById('closeDetailModalBtn').onclick = function () {
            document.getElementById('detailModal').classList.add('hidden');
        };

        // Modal control
        document.getElementById('addVaccineBtn')?.addEventListener('click', () => {
            document.getElementById('vaccineModal').classList.remove('hidden');
        });
        document.getElementById('closeModalBtn')?.addEventListener('click', () => {
            document.getElementById('vaccineModal').classList.add('hidden');
        });

        document.addEventListener('DOMContentLoaded', renderTable);
    </script>
</x-app-layout>
