<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Kelola Jam Operasional Dokter</h2>

        <form method="POST" action="{{ route('admin.jadwal.store') }}" class="mb-6">
            @csrf
            <select name="doctor_id" class="border p-2 rounded mb-2 w-full">
                @foreach ($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
            <input type="text" name="hari" placeholder="Contoh: Senin" class="border p-2 rounded mb-2 w-full">
            <input type="time" name="jam_mulai" class="border p-2 rounded mb-2 w-full">
            <input type="time" name="jam_selesai" class="border p-2 rounded mb-2 w-full">
            <button class="bg-pink-500 text-white px-4 py-2 rounded">Simpan Jadwal</button>
        </form>

        <h3 class="text-lg font-semibold mb-2">Jadwal Tersedia</h3>
        <ul>
            @foreach ($dokter as $d)
                <li class="mb-2">
                    <strong>{{ $d->name }}</strong>
                    <ul class="ml-4 list-disc">
                        @foreach ($d->availabilities as $a)
                            <li>{{ $a->hari }}: {{ $a->jam_mulai }} - {{ $a->jam_selesai }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
