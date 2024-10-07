<x-guest-layout>
    <x-slot name="title">Homepage</x-slot>

    <div>
        <x-navbar-guest />
        <main class="min-h-screen">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <section id="hero" class="hero relative bg-cover bg-center text-white"
                style="background-image: url('{{ asset('storage/background/background_13.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-55 lg:hidden"></div>
                <div class="absolute inset-0 bg-gradient-overlay-dark opacity-70 md:hidden"></div>
                <div class="absolute inset-0 w-5/6 bg-gradient-to-r from-neutral to-transparent hidden lg:block"></div>
                <div class="container mx-auto px-4 py-16 relative z-10">
                    <div
                        class="max-w-lg h-[85vh] lg:h-[80vh] flex flex-col justify-end md:justify-center md:pt-20 space-y-6 relative z-20">
                        <h1 class="text-5xl font-sans font-bold md:text-6xl leading-tight animate-fadeInUp">Wisata Desa
                            Karangharjo</h1>
                        <p class="mt-4 text-lg md:text-xl font-sans animate-fadeInDown">
                            Kami dengan senang hati menyambut Anda di Rumah Pintar Karangharjo, destinasi wisata edukasi
                            yang menawarkan pengalaman unik dan menarik di Jember.
                        <div class="flex flex-wrap gap-3 mt-10 items-center animate-fadeInUp">
                            <a href="javascript:void(0)"
                                class="btn bg-white text-primary shadow-button hover:bg-secondary transition-all duration-300">Lihat
                                Aktivitas <i class="pl-2 fas fa-play"></i></a>
                            <button
                                class="btn btn-primary text-base-100 shadow-button hover:bg-secondary transition-all duration-300">Pesan
                                Paket Wisata <i class="pl-2 fas fa-plus"></i></button>
                            <button
                                class="flex items-center justify-center w-10 h-10 border rounded-full text-primary bg-white shadow-button hover:bg-secondary transition-all duration-300">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Additional Decorative Lines -->
                    <div class="absolute top-0 left-0 w-full h-full pointer-events-none hidden lg:block">
                        <div class="absolute top-0 left-1/4 w-0.5 h-full bg-white opacity-20"></div>
                        <div class="absolute top-0 right-1/4 w-0.5 h-full bg-white opacity-20"></div>
                        <div class="absolute left-0 bottom-1/4 w-full h-0.5 bg-white opacity-20"></div>
                        <div class="absolute left-0 top-1/4 w-full h-0.5 bg-white opacity-20"></div>
                    </div>
                </div>
            </section>

            <!-- ====== Pricing Section Start -->
            <section id="price"
                class="relative z-10 overflow-hidden bg-white dark:bg-dark pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
                <div class="container mx-auto">
                    <div class="-mx-4 flex flex-wrap">
                        <div class="w-full px-4">
                            <div class="mx-auto mb-[60px] max-w-[510px] text-center">
                                <span class="mb-2 block text-lg font-semibold text-primary">
                                    Desa Wisata Karangharjo
                                </span>
                                <h2
                                    class="mb-3 text-4xl leading-[1.208] font-bold text-dark dark:text-white sm:text-4xl md:text-6xl font-lobster">
                                    Paket Wisata
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($tourPackages as $package)
                            @if ($package->is_visible)
                                <x-card-package
                                    class="transform transition-transform hover:scale-105 shadow-lg rounded-lg"
                                    image="{{ asset('storage/' . $package->image_icon) }}"
                                    price="IDR {{ number_format($package->price, 0, ',', '.') }}"
                                    name="{{ $package->name }}" :isLoggedIn="auth()->check()"
                                    description="{{ $package->description }}">
                                    {{-- <x-slot name="features">
                                        @foreach ($package->services as $service)
                                            <div class="flex items-center">
                                                <i class="fas fa-check mr-2 text-accent"></i>{{ $service->name }}
                                            </div>
                                        @endforeach
                                    </x-slot> --}}
                                </x-card-package>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- ====== Pricing Section End -->


            <x-modal name="auth" :show="$errors->isNotEmpty()" focusable>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-lg border-0 bg-base-100">
                    <div class="rounded-t mb-0 px-6 py-6 text-center">
                        <h6 class="text-gray-600 text-lg font-bold mb-3">
                            Login
                        </h6>
                    </div>
                    <div class="px-4 lg:px-10 py-10">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')"
                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                <x-text-input id="email"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full transition duration-150 ease-linear"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')"
                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />

                                <x-text-input id="password"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full transition duration-150 ease-linear"
                                    type="password" name="password" required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-center mt-4">
                                @if (Route::has('register'))
                                    <div class="flex text-sm text-gray-600 mt-3">
                                        Dont have account?
                                        <a class="underline text-blue-500 font-normal hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500""
                                            href="{{ route('register') }}">
                                            {{ __('Create') }}
                                        </a>
                                    </div>
                                @endif

                                <x-primary-button class="ms-3">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </x-modal>
        </main>
    </div>
    @include('layouts.footer')
</x-guest-layout>
