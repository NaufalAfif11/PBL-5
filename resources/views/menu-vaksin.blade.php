{{-- resources/views/menu-vaksin.blade.php --}}
<x-app-layout>
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white h-auto md:h-screen p-4 shadow">
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

        <!-- Main Content -->
        <main class="flex-grow bg-pink-100 p-10">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold">Daftar Vaksinasi</h1>
                @if(Auth::user()->role === 'pasien')
                <button onclick="openAddModal()" class="bg-pink-400 text-white px-4 py-2 rounded">Tambah Vaksin</button>
                @endif
            </div>
            <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md mb-10">
                <div class="bg-white overflow-x-auto">
                    <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                        <table class="min-w-full text-sm text-center border border-pink-100 border-collapse">
                            <thead class="bg-pink-500 text-white">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Nama Vaksin</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Jam</th>
                                    <th class="px-4 py-2">@if(Auth::user()->role === 'dokter') Nama Pasien @else Nama
                                        Dokter @endif</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($data as $index => $item)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $item->vaccine_name }}</td>
                                    <td class="px-4 py-2">{{ $item->vaccine_date }}</td>
                                    <td class="px-4 py-2">{{ $item->vaccine_time }}</td>
                                    <td class="px-4 py-2">@if(Auth::user()->role === 'dokter')
                                        {{ $item->patient_email }} @else {{ $item->doctor_name }} @endif</td>
                                    <td class="px-4 py-2">
                                        <a href="javascript:void(0);" onclick="showDetailModal({{ $item->id }})"
                                            class="bg-pink-400 text-white px-2 py-1 rounded">Detail</a>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-gray-500">Tidak ada data vaksinasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-10 text-center text-black-600 font-bold">
                        © 2025 Vaccine Schedule. All rights reserved.
                    </div>
            </div>

            {{-- === Fitur Tambahan Admin: Edit Jadwal Dokter === --}}
            @if(Auth::user()->role === 'admin')
                <div class="mt-16 w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Kelola Jadwal Dokter</h2>
                    @if(session('success'))
                        <div class="text-green-600 mb-4">{{ session('success') }}</div>
                    @endif
                    <table class="min-w-full text-sm text-center border border-gray-300">
                        <thead class="bg-pink-500 text-white">
                        <tr>
                            <th class="px-4 py-2">Nama Dokter</th>
                            <th class="px-4 py-2">Hari</th>
                            <th class="px-4 py-2">Jam Mulai</th>
                            <th class="px-4 py-2">Jam Selesai</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($jadwal as $j)
                            <tr class="border-t">
                                <form method="POST" action="{{ route('admin.jadwal.update', $j->id) }}">
                                    @csrf @method('PATCH')
                                    <td class="px-4 py-2">{{ $j->doctor->name }}</td>
                                    <td class="px-4 py-2">
                                        <select name="hari" class="border rounded p-1">
                                            @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                                <option value="{{ $hari }}" {{ $j->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="time" name="jam_mulai" value="{{ $j->jam_mulai }}" class="border p-1 rounded">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="time" name="jam_selesai" value="{{ $j->jam_selesai }}" class="border p-1 rounded">
                                    </td>
                                    <td class="px-4 py-2">
                                        <button type="submit" class="bg-pink-500 text-white px-3 py-1 rounded">Simpan</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </main>
    </div>

    <!-- Modal Tambah-->
    <div id="addModal" class="fixed inset-0 z-50 hidden modal-overlay backdrop-blur-sm bg-black/30">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Tambah Vaksin</h2>
                <form method="POST" action="{{ route('vaksinasi.store') }}" class="space-y-3">
                    @csrf
                    <!-- Pilih Vaksin -->
                    <select name="vaccine_name" class="w-full border p-2 rounded" required>
                        <option value="">Pilih Vaksin...</option>
                        <option value="vaksinA">Vaksin A</option>
                        <option value="vaksinB">Vaksin B</option>
                        <option value="vaksinC">Vaksin C</option>
                    </select>

                    <!-- Tampil ke user -->
                    <input type="text" id="doctor_display" class="w-full border p-2 rounded bg-gray-100" readonly
                        placeholder="Pilih Vaksin terlebih dahulu">

                    <!-- Disembunyikan, dikirim ke server -->
                    <input type="hidden" name="doctor_name" id="doctor_name">
                    <input type="hidden" name="doctor_email" id="doctor_email">
                    <input type="date" name="vaccine_date" class="w-full border p-2 rounded" required>
                    <input type="time" name="vaccine_time" class="w-full border p-2 rounded" required>
                    {{-- Tambahan jam --}}
                    <input type="text" name="address" placeholder="Alamat" class="w-full border p-2 rounded" required>
                    <div class="mt-4 text-right">
                        <button type="submit" class="ml-2 bg-pink-300 px-4 py-2 rounded">Simpan</button>
                        <button type="button" onclick="closeAddModal()"
                            class="ml-2 bg-pink-300 px-4 py-2 rounded">Batal</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden modal-overlay backdrop-blur-sm bg-black/30">        
      <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Detail Vaksinasi</h2>
                <div class="space-y-2">
                    <p><strong>Nama Vaksin:</strong> <span id="detail-vaccine-name"></span></p>
                    <p><strong>Tanggal:</strong> <span id="detail-vaccine-date"></span></p>
                    <p><strong>Dokter:</strong> <span id="detail-doctor-name"></span></p>
                    <p><strong>Email Dokter:</strong> <span id="detail-doctor-email"></span></p>
                    <p><strong>Pasien:</strong> <span id="detail-patient-email"></span></p>
                    <p><strong>Alamat:</strong> <span id="detail-address"></span></p>
                    <p><strong>Jam:</strong> <span id="detail-vaccine-time"></span></p>
                    <p><strong>Status:</strong> <span id="detail-status"></span></p>
                </div>
                <div class="mt-4 text-right space-x-2">
                    @if(Auth::user()->role === 'dokter')
                    <form id="form-mark-sudah" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Sudah">
                        <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded">Sudah</button>
                    </form>
                    <form id="form-mark-batal" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Dibatalkan">
                        <button type="submit" class="bg-pink-400 text-white px-4 py-2 rounded">Batal</button>
                    </form>
                    @endif
                    <button type="button" onclick="closeDetailModal()"
                        class="bg-pink-500 text-white px-4 py-2 rounded">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<script>
    const semuaJadwal = @json($semua_jadwal);
</script>

    <script>
        
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        function showDetailModal(id) {
            window.location.href = `/menu-vaksin/${id}/detail`; // arahkan ke route untuk tampilkan modal
        }
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        function showDetailModal(id) {
            fetch(`/vaksinasi/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('detail-vaccine-name').textContent = data.vaccine_name;
                    document.getElementById('detail-vaccine-date').textContent = data.vaccine_date;
                    document.getElementById('detail-doctor-name').textContent = data.doctor_name;
                    document.getElementById('detail-doctor-email').textContent = data.doctor_email;
                    document.getElementById('detail-patient-email').textContent = data.patient_email;
                    document.getElementById('detail-address').textContent = data.address;
                    document.getElementById('detail-vaccine-time').textContent = data.vaccine_time;
                    document.getElementById('detail-status').textContent = data.status;

                    // Set action form PATCH untuk update status
                    document.getElementById('form-mark-sudah')?.setAttribute('action',
                        `/vaksinasi/${data.id}/status`);
                    document.getElementById('form-mark-batal')?.setAttribute('action',
                        `/vaksinasi/${data.id}/status`);
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }
        const vaksinToDokter = {
            'vaksinA': {
                name: 'dr. Andi',
                email: 'andi@example.com'
            },
            'vaksinB': {
                name: 'dr. Budi',
                email: 'budi@example.com'
            },
            'vaksinC': {
                name: 'dr. Citra',
                email: 'citra@example.com'
            },
        };

        document.querySelector('select[name="vaccine_name"]').addEventListener('change', function () {
            const selectedVaksin = this.value;
            const dokter = vaksinToDokter[selectedVaksin];

            if (dokter) {
                // Tampilkan hanya nama dokter
                document.getElementById('doctor_display').value = dokter.name;

                // Simpan nama dan email di field tersembunyi
                document.getElementById('doctor_name').value = dokter.name;
                document.getElementById('doctor_email').value = dokter.email;
            } else {
                document.getElementById('doctor_display').value = '';
                document.getElementById('doctor_name').value = '';
                document.getElementById('doctor_email').value = '';
            }
        });

    </script>
</x-app-layout>
