@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex">
    {{-- Content --}}
    <main class="flex-1 bg-pink-100 p-10">
        <h1 class="text-3xl font-bold text-center text-red-600 mb-8">Profile</h1>

        <div class="max-w-2xl mx-auto bg-white rounded-2xl p-10 shadow-xl text-center">
            {{-- Avatar --}}
            <img src="{{ asset('images/ps.png') }}" alt="Avatar" class="w-24 h-24 mx-auto rounded-full mb-6">
            <h2 class="text-xl font-bold text-red-600 mb-8">Nama User</h2>

            {{-- Form Profile --}}
            <div class="bg-pink-50 p-8 rounded-xl shadow-inner text-left space-y-6">
                <div class="space-y-2">
                    <label class="font-semibold">Nama</label>
                    <input type="text" value="" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold">Email</label>
                    <input type="email" value="" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold">Tanggal Lahir</label>
                    <input type="date" value="" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-8">
                <button id="saveBtn" onclick="startLoading()" 
                    class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-md flex items-center justify-center mx-auto text-sm">
                    <span id="btnText">Simpan</span>
                    
                </button>
            </div>
        </div>
    </main>
</div>


@endsection
