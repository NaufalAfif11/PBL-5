@extends('layouts.app') <!-- pastikan file layout ada -->

@section('content')
<div class="min-h-screen flex">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r text-red-600 font-semibold p-4">
        <div class="text-center text-xl font-bold mb-6">Vaccine Schedule</div>
        <ul class="space-y-4">
            <li><a href="#" class="hover:text-red-400">🏠 Beranda</a></li>
            <li class="text-white bg-red-500 rounded px-3 py-1">📋 Menu Vaksin</li>
            <li><a href="#" class="hover:text-red-400">👤 Profil</a></li>
            <li><a href="#" class="hover:text-red-400">🔔 Notifikasi</a></li>
            <li><a href="#" class="hover:text-red-400">📜 Riwayat</a></li>
            <li><a href="#" class="hover:text-red-400">📤 Keluar</a></li>
        </ul>
    </aside>

    {{-- Content --}}
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold mb-4">Menu Vaksin</h1>
        <a href="#" class="bg-red-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ Tambah Vaksin</a>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full text-sm text-center">
                <thead class="bg-pink-300 text-black">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Vaksin</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Nama Dokter</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($data as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item['id'] }}</td>
                            <td class="px-4 py-2">{{ $item['nama_vaksin'] }}</td>
                            <td class="px-4 py-2">{{ $item['tanggal'] }}</td>
                            <td class="px-4 py-2">{{ $item['dokter'] }}</td>
                            <td class="px-4 py-2">{{ $item['pasien'] }}</td>
                            <td class="px-4 py-2">{{ $item['alamat'] }}</td>
                            <td class="px-4 py-2 text-red-500 font-bold">{{ $item['status'] }}</td>
                            <td class="px-4 py-2">
                                <button class="bg-red-500 text-white px-3 py-1 rounded">🗑 Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <footer class="text-center text-sm text-red-600 mt-10">
            © 2025 Vaccine Schedule. All rights reserved.
        </footer>
    </main>
</div>
@endsection
