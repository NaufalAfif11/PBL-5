@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold mb-6 text-red-600">Notifikasi</h1>

        <div class="space-y-4">
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
