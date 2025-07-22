<x-guest-layout>
    <div class="fixed inset-0 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/bg.png') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Registrasi Akun</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <x-text-input id="password" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Pilih Peran')" />
                        <select name="role" id="role" required class="block mt-1 w-full rounded-md border-pink-500 shadow-sm focus:ring-pink-600 focus:border-pink-600">
                            <option value="">-- Pilih Peran --</option>
                            <option value="pasien">Pasien</option>
                            <option value="dokter">Dokter</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2 transition">
                            {{ __('Daftar') }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6 text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-pink-600 hover:underline font-semibold">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
