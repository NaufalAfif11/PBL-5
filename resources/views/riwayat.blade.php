@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
    {{-- Sidebar otomatis --}}
    
    {{-- Content --}}
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold mb-4">Riwayat Vaksinasi</h1>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full text-sm text-center border border-pink-300 border-collapse">
                <thead class="bg-pink-300 text-black">
                    <tr>
                        <th class="px-4 py-2 border border-pink-300">No</th>
                        <th class="px-4 py-2 border border-pink-300">Nama Vaksin</th>
                        <th class="px-4 py-2 border border-pink-300">Tanggal</th>
                        <th class="px-4 py-2 border border-pink-300">Nama Dokter</th>
                        <th class="px-4 py-2 border border-pink-300">Alamat</th>
                        <th class="px-4 py-2 border border-pink-300">Status</th>
                        <th class="px-4 py-2 border border-pink-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-pink-100">
                    <tr class="hover:bg-pink-50">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Covovax</td>
                        <td class="px-4 py-2">21 Dec 2025</td>
                        <td class="px-4 py-2">Dr. Ivan</td>
                        <td class="px-4 py-2">Batam</td>
                        <td class="px-4 py-2">Sudah</td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-blue-600 hover:underline">Detail</a>
                        </td>
</tr>
                </tbody>
            </table>
        </div>

        {{-- Footer, copyright dsb --}}
    </main>
</div>
@endsection
