{{-- resources/views/dokter/notifikasi.blade.php --}}
<x-app-layout>
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white h-auto md:h-screen p-4 shadow">
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
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold">Notifikasi Vaksinasi</h1>
                @if(Auth::user()->role === 'pasien')
                    <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Vaksin</button>
                @endif
            </div>

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-pink-300 text-black">
    <tr>
        <th class="px-4 py-2">No</th>
        <th class="px-4 py-2">Nama Vaksin</th>
        <th class="px-4 py-2">Tanggal</th>
        <th class="px-4 py-2">
            @if(Auth::user()->role === 'dokter')
                Nama Pasien
            @else
                Nama Dokter
            @endif
        </th>
        <th class="px-4 py-2">Aksi</th>
    </tr>
</thead>

                    <tbody class="bg-white" id="notifTableBody"></tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Tambah Vaksin</h2>
                <div class="space-y-3">
                    <input type="text" id="vaccineName" placeholder="Nama Vaksin" class="w-full border p-2 rounded">
                    <input type="date" id="vaccineDate" class="w-full border p-2 rounded">
                    <input type="text" id="doctorName" placeholder="Nama Dokter" class="w-full border p-2 rounded">
                    <input type="text" id="address" placeholder="Alamat" class="w-full border p-2 rounded">
                </div>
                <div class="mt-4 text-right">
                    <button onclick="saveNotification()" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    <button onclick="closeAddModal()" class="ml-2 bg-gray-300 px-4 py-2 rounded">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Detail Vaksinasi</h3>
                    <div class="mt-4 space-y-2">
                        <p><strong>Nama Vaksin:</strong> <span id="detail-nama-vaksin"></span></p>
                        <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                        <p><strong>Nama Dokter:</strong> <span id="detail-nama-dokter"></span></p>
                        <p><strong>Nama Pasien:</strong> <span id="detail-nama-pasien"></span></p>
                        <p><strong>Alamat:</strong> <span id="detail-alamat"></span></p>
                        <p><strong>Status:</strong> <span id="detail-status"></span></p>
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
        const notifBody = document.getElementById('notifTableBody');
        const userRole = "{{ Auth::user()->role }}";

        function renderNotifTable() {
    notifBody.innerHTML = '';
    const data = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
    const currentEmail = "{{ Auth::user()->email }}";
    const isDokter = userRole === 'dokter';

    let filtered = [];
    if (isDokter) {
        filtered = data;
    } else {
        filtered = data.filter(item => item.patientEmail === currentEmail);
    }

    if (filtered.length === 0) {
        notifBody.innerHTML = `<tr><td colspan="6" class="px-4 py-2 text-gray-500">Tidak ada data vaksinasi.</td></tr>`;
        return;
    }

    filtered.forEach((d, i) => {
        const encodedData = JSON.stringify(d).replace(/"/g, '&quot;');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-2">${i + 1}</td>
            <td class="px-4 py-2">${d.vaccineName}</td>
            <td class="px-4 py-2">${d.vaccineDate}</td>
            <td class="px-4 py-2">${isDokter ? (d.patientEmail || '-') : (d.doctorName || '-')}</td>
            <td class="px-4 py-2">
                ${isDokter ? `<button onclick='showDetail(${encodedData})' class="bg-blue-500 text-white px-2 py-1 rounded">Detail</button>` : ''}
            </td>
        `;
        notifBody.appendChild(row);
    });
}


        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function saveNotification() {
            const vaccineName = document.getElementById('vaccineName').value;
            const vaccineDate = document.getElementById('vaccineDate').value;
            const doctorName = document.getElementById('doctorName').value;
            const address = document.getElementById('address').value;

            const newData = {
                vaccineName,
                vaccineDate,
                doctorName,
                address,
                patientEmail: "{{ Auth::user()->email }}",
                status: "Belum",
                timestamp: Date.now()
            };

            let data = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
            data.push(newData);
            localStorage.setItem('vaccineNotifications', JSON.stringify(data));

            closeAddModal();
            renderNotifTable();
        }

        function showDetail(data) {
            document.getElementById('detail-nama-vaksin').textContent = data.vaccineName;
            document.getElementById('detail-tanggal').textContent = data.vaccineDate;
            document.getElementById('detail-nama-dokter').textContent = data.doctorName;
            document.getElementById('detail-nama-pasien').textContent = data.patientEmail || '-';
            document.getElementById('detail-alamat').textContent = data.address;
            document.getElementById('detail-status').textContent = data.status;
            document.getElementById('detailModal').classList.remove('hidden');

            document.getElementById('markAsDoneBtn').onclick = () => moveToHistory(data, 'Sudah');
            document.getElementById('markAsCanceledBtn').onclick = () => moveToHistory(data, 'Dibatalkan');
        }

        function moveToHistory(data, status) {
            let history = JSON.parse(localStorage.getItem('vaccineHistory')) || [];
            data.status = status;
            history.push(data);
            localStorage.setItem('vaccineHistory', JSON.stringify(history));

            let notifications = JSON.parse(localStorage.getItem('vaccineNotifications')) || [];
            notifications = notifications.filter(n => n.timestamp !== data.timestamp);
            localStorage.setItem('vaccineNotifications', JSON.stringify(notifications));

            document.getElementById('detailModal').classList.add('hidden');
            renderNotifTable();
        }

        document.getElementById('closeDetailModalBtn').onclick = function () {
            document.getElementById('detailModal').classList.add('hidden');
        };

        document.addEventListener('DOMContentLoaded', renderNotifTable);
    </script>
</x-app-layout>
