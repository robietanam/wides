<x-guest-layout>
    <x-slot name="title">Register</x-slot>
    <div class="absolute h-screen bg-cover bg-center w-screen px-4 m-auto flex justify-center items-center"
        style="background-image: url('{{ asset('storage/background/background_13.jpg') }}');">
        <!-- Session Status -->
        <div class="absolute inset-0 bg-gray-500 bg-opacity-50 backdrop-blur-sm"></div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="relative flex flex-col w-full lg:w-4/12 mb-6 rounded-lg bg-white shadow-md mt-20">
            <div class="rounded-t-lg px-6 py-6 text-center">
                <h6 class="text-gray-800 text-xl font-semibold mb-3">
                    Daftar
                </h6>
            </div>
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="name"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="email"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="password"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="block text-gray-700 text-sm font-medium mb-2" />
                        <x-text-input id="password_confirmation"
                            class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full transition duration-150 ease-in-out"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')"
                            class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Already Registered -->
                    <div class="flex items-center justify-between mb-4">
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Sudah terdaftar?') }}
                        </a>

                        <x-primary-button
                            class="w-1/2 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <h6 class="mx-auto">Daftar</h6>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
