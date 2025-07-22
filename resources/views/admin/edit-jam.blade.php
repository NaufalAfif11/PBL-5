<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Jadwal Dokter</h2>

        <form action="{{ route('admin.jam.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Hari</label>
                <input type="text" name="day" value="{{ $jadwal->day }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jam</label>
                <input type="text" name="time" value="{{ $jadwal->time }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
