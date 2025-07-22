{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <p class="mt-2 text-gray-700">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</x-app-layout>
