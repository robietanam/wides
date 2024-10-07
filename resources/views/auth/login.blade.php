<x-guest-layout>
    <x-slot name="title">Login</x-slot>
    <div class="absolute h-screen bg-cover bg-center w-screen px-4 m-auto flex justify-center items-center"
        style="background-image: url('{{ asset('storage/background/background_13.jpg') }}');">
        <!-- Session Status -->
        <div class="absolute inset-0 bg-gray-500 bg-opacity-50 backdrop-blur-sm"></div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="relative flex flex-col w-full lg:w-4/12 mb-6 rounded-lg bg-white shadow-md mt-20">
            <div class="rounded-t-lg px-6 py-6 text-center">
                <h6 class="text-gray-800 text-xl font-semibold mb-3">
                    Masuk
                </h6>
            </div>
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="email"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="password"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-4">
                        <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="text-center">
                        <x-primary-button
                            class="w-1/2 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <h6 class="mx-auto">Masuk</h6>
                        </x-primary-button>
                    </div>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                    <div class="flex justify-center text-sm text-gray-600 mt-4">
                        <span>Belum punya akun?</span>
                        <a class="ml-2 text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            href="{{ route('register') }}">
                            Daftar
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
