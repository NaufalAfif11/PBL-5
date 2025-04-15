@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
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
                    {{-- Baris data vaksin akan ditampilkan di sini --}}
                </tbody>
            </table>
        </div>

        
    </main>
</div>
@endsection
