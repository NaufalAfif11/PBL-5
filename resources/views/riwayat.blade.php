@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
    {{-- Content --}}
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold mb-4">Riwayat Vaksinasi</h1>

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
                <tbody class="bg-white divide-y divide-pink-100">
                    
                        <tr class="hover:bg-pink-50">
                            <td class="px-4 py-2">13</td>
                            <td class="px-4 py-2">14</td>
                            <td class="px-4 py-2">21</td>
                            <td class="px-4 py-2">21</td>
                            <td class="px-4 py-2">22</td>
                            <td class="px-4 py-2">31</td>
                            <td class="px-4 py-2 font-bold ">31
                               
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                
                                <a href="#" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada data riwayat.</td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
