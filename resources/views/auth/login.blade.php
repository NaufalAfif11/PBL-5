<x-guest-layout>
    <div class="fixed inset-0 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/bg.png') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full border-pink-500 focus:border-pink-600 focus:ring-pink-600" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-pink-400 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="text-center mt-6 text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-pink-600 hover:underline font-semibold">Daftar</a>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="ms-3 w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2 transition">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
