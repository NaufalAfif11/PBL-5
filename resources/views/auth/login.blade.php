<x-guest-layout>
    <div class="fixed inset-0 bg-cover bg-center overflow-hidden" style="background-image: url('{{ asset('images/bg.png') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Optional: Overlay gelap agar teks lebih mudah dibaca --}}
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="text-center mt-6 text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-semibold">
                        Daftar </a>
                    <div class="text-center mt-6 text-sm text-gray-600">
                    Lupa Password?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">
                   Contact Admin </a>
                </div>
                

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                        <div class="text-center mt-6 text-sm text-gray-600">
                    
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">
                        
                    </a>
                </div>
                        @endif
</div>

                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>