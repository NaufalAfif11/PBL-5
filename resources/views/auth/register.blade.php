<x-guest-layout>
    <div class="fixed inset-0 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Registrasi Akun</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registrationForm">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="role" :value="__('Daftar Sebagai')" />
                        <select class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="role" name="role">
                            <option value="pasien">Pasien</option>
                            <option value="dokter">Dokter</option>
                        </select>
                    </div>

                    <div>
                        <x-primary-button class="w-full" id="registerButton">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="text-center mt-6 text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const registerButton = document.getElementById('registerButton');
            const roleSelect = document.getElementById('role');
            const form = document.getElementById('registrationForm');

            registerButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default form submission

                const selectedRole = roleSelect.value;

                if (selectedRole === 'dokter') {
                    window.location.href = '/dokter/dashboard';
                } else if (selectedRole === 'pasien') {
                    window.location.href = '/dashboard';
                } else {
                    // Jika role tidak dipilih atau nilai lain, submit form biasa
                    form.submit();
                }
            });
        });
    </script>
</x-guest-layout>