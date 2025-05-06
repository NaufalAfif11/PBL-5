<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen p-4 shadow">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-24 mx-auto mb-4">
            <h5 class="text-center font-bold">Vaccine Schedule</h5>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Beranda</a>
                <a href="{{ route('menu-vaksin') }}" class="{{ request()->routeIs('menu-vaksin') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Tambah Vaksin</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Profil</a>
                <a href="{{ route('notifikasi') }}" class="{{ request()->routeIs('notifikasi') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Notifikasi</a>
                <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'bg-red-500 text-white' : 'text-black' }} block py-2 px-4 rounded">Riwayat</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black block py-2 px-4 rounded">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 bg-pink-100 p-10 overflow-y-auto">
            <h1 class="text-3xl font-bold text-center text-red-600 mb-8">Profile</h1>

            <div class="max-w-2xl mx-auto bg-white rounded-2xl p-10 shadow-xl text-center">
                {{-- Avatar --}}
                <div class="relative">
                    <img src="{{ asset('images/ps.png') }}" alt="Avatar" id="profilePic" class="w-24 h-24 mx-auto rounded-full mb-6 border-4 border-pink-1111">
                    
                    <input type="file" id="avatarUpload" accept="image/*">
                </div>
                <h2 class="text-xl font-bold text-red-600 mb-8">Nama User</h2>

                {{-- Form --}}
                <div class="bg-pink-50 p-8 rounded-xl shadow-inner text-left space-y-6">
                    <div class="space-y-2">
                        <label class="font-semibold">Nama</label>
                        <input type="text" id="name" value="Nama User" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                    </div>
                    <div class="space-y-2">
                        <label class="font-semibold">Email</label>
                        <input type="email" id="email" value="user@example.com" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                    </div>
                    <div class="space-y-2">
                        <label class="font-semibold">Tanggal Lahir</label>
                        <input type="date" id="dob" value="2000-01-01" class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="mt-8">
                    <button id="saveBtn" onclick="updateProfile()" class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-md flex items-center justify-center mx-auto text-sm">
                        <span id="btnText">Simpan</span>
                    </button>
                </div>
            </div>
            <div class="mt-10 text-center text-red-600 font-bold">
                © 2025 Vaccine Schedule. All rights reserved.
            </div>
        </main>
    </div>

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    {{-- JavaScript --}}
    <script>
        // Ganti avatar
        document.getElementById('avatarUpload').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('profilePic').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Update profil
        function updateProfile() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const dob = document.getElementById('dob').value;
            console.log("Updated:", name, email, dob);
            alert("Profil berhasil diperbarui!");
        }
    </script>
</x-app-layout>
