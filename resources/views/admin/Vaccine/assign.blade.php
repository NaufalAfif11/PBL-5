<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto bg-white shadow rounded">
        <h2 class="text-2xl font-bold mb-6">Tautkan Vaksin ke Dokter</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.vaksin.store') }}">
            @csrf

            {{-- Pilih Dokter --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Pilih Dokter:</label>
                <select name="doctor_id" class="border p-2 rounded w-full">
                    @foreach ($doctors as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Vaksin --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Pilih Vaksin:</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($vaccine as $vaccine_name)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="vaccine_ids[]" value="{{ $vaccine->id }}" class="mr-2">
                            {{ $vaccine->vaccine_name ?? $vaccine->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- (Opsional) Tambah Hari & Jam Praktik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-2 font-semibold">Hari Praktik:</label>
                    <select name="hari" class="border p-2 rounded w-full">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Jam Mulai:</label>
                    <input type="time" name="jam_mulai" class="border p-2 rounded w-full">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Jam Selesai:</label>
                    <input type="time" name="jam_selesai" class="border p-2 rounded w-full">
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-6">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded">
                    Simpan & Tautkan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
