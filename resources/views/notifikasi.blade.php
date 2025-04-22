@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold mb-6 text-red-600">Notifikasi</h1>

        
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full text-sm text-center">
                <thead class="bg-pink-300 text-black">
                    <tr>
                        
                    </tr>
                    <tbody class="bg-white divide-y divide-pink-100">
                    
                        <tr class="hover:bg-pink-50">
                            
                            
                            <td class="px-4 py-2 space-x-2">
                                
                                
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-sm text-gray-500">Tidak Ada Notifikasi.</td>
                        </tr>
                    
                </tbody>
                </thead>
                <tbody class="bg-white">
                    {{-- Baris data vaksin akan ditampilkan di sini --}}
                </tbody>
            </table>
        </div><div class="space-y-4">
            {{-- Contoh notifikasi (hapus bagian ini saat sudah ada data dari backend) --}}
            {{-- 
            <div class="bg-white p-4 rounded shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-lg font-semibold">Judul Notifikasi</div>
                        <div class="text-sm text-gray-500">12 Apr 2025, 10:00</div>
                        <p class="mt-2 text-gray-700">Pesan dari notifikasi ini akan ditampilkan di sini.</p>
                    </div>
                    <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">Hapus</button>
                </div>
            </div>
            --}}
        </div>

        
    </main>
</div>
@endsection
