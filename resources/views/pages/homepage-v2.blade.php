<x-guest-layout>
    <x-slot name="title">Homepage</x-slot>
    <div>
        <x-navbar-guest />
        <main class="min-h-screen">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <section id="hero" class="hero relative bg-cover bg-center text-white h-[130vh] lg:h-full"
                style="background-image: url('{{ asset('storage/background/background_13.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-45"></div>
                <div class="px-4 lg:px-20 md:py-16 relative z-10">
                    <div class=" lg:py-20 max-w-7xl h-[50vh] lg:h-[90vh] z-20">
                        <h1
                            class="text-6xl font-hero md:text-8xl tracking-wider font-normal leading-tight animate-fadeInScale w-full lg:w-3/6 mt-10 lg:mt-20">
                            Wisata Desa Karangharjo
                        </h1>
                        <div class="flex justify-between flex-col lg:flex-row">
                            <div class="mb-10">
                                <p class="text-sm md:text-lg font-sans animate-fadeInDown lg:w-3/6 hidden md:block">
                                    Kami dengan senang hati menyambut Anda di Rumah Pintar Karangharjo, destinasi wisata
                                    edukasi
                                    yang menawarkan pengalaman unik dan menarik di daerah Jember.
                                </p>
                                <p class="mt-4 text-sm md:text-lg font-sans animate-fadeInDown w-5/6 md:hidden">
                                    Selamat datang di Rumah Pintar Karangharjo, destinasi wisata edukasi unik dan
                                    menarik di
                                    Jember.
                                </p>

                                <div class="flex flex-wrap gap-5 mt-4 items-center animate-fadeInUp">
                                    <a href="#services"
                                        class="btn bg-white text-primary shadow-button hover:bg-primary hover:text-white transition-all duration-300 hover:animate-tiltHover">Order
                                        Paket<i class="fas fa-plus"></i></a>
                                    <a href="javascript:void(0)"
                                        class="btn bg-transparent text-white border-0 hover:bg-white hover:text-primary"><i
                                            class="fa-regular fa-circle-play text-2xl"></i>Lihat Aktivitas</a>
                                </div>
                            </div>
                            <div data-aos="fade-down" data-aos-duration="500" data-aos-once="true"
                                class="h-auto w-full md:w-4/6 bg-green-300 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-5 hover:backdrop-blur-lg border border-gray-300 border-opacity-40 hover:border-gray-100 animate-fadeInScale duration-1000">
                                <div>
                                    <div class="px-6 py-3 pb-6 space-y-4">
                                        <div class="flex justify-between items-center">
                                            <i class="fa-solid fa-location-dot text-3xl"></i>
                                            <a
                                                href="https://www.google.com/maps/place/RUMAH+PINTAR+JEMBER/@-8.2462226,113.832909,16.69z/data=!4m6!3m5!1s0x2dd6bd6321365f87:0xeacadbead0200275!8m2!3d-8.2463333!4d113.8361649!16s%2Fg%2F11qndqqyrm?entry=ttu">
                                                <i
                                                    class="fa-solid fa-arrow-right btn bg-black bg-opacity-35 text-white border-none rounded-full -rotate-45 text-xl"></i>
                                            </a>
                                        </div>
                                        <div class="flex flex-col space-y-2">
                                            <h2 class="text-lg text-white font-sans font-Normal">Rumah Pintar</h2>
                                            <p class="text-xs font-light">Dusun Sumberpinang, Desa Karangharjo, Kec.
                                                Silo,
                                                Kabupaten Jember, Jawa Timur,
                                                POS,
                                                68184</p>
                                            <div
                                                class="pt-2 md:pt-4 translate-y-3 flex flex-col md:flex-row justify-between md:items-center">
                                                <div x-data="{ copied: false, copyText: '+62 8233-5351-928' }">
                                                    <div class="flex gap-2">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                        <p @click="
                                                    navigator.clipboard.writeText(copyText);
                                                    copied = true;
                                                    setTimeout(() => copied = false, 3000)
                                                    "
                                                            :class="{ 'text-semibold': copied }"
                                                            class="text-xs italic cursor-pointer"
                                                            x-text="copied ? 'Tersalin!' : copyText">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex flex-row gap-5 items-center mt-2 md:mt-0 md:-translate-x-3 ">
                                                    <a class="text-lg hover:scale-110 hover:duration-700"
                                                        target="_blank" href="https://wa.me/6282335351928"><i
                                                            class="fab fa-whatsapp"></i></a>
                                                    <a class="text-lg hover:scale-110 hover:duration-700"
                                                        href="#"><i class="fab fa-facebook"></i></a>
                                                    <a class="text-lg hover:scale-110 hover:duration-700"
                                                        href="#"><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="services" class="relative my-4 lg:my-20 h-full lg:mb-60">
                <div class="px-4 lg:px-20 mx-auto py-10 md:py-6 z-10 h-full space-y-2">
                    <div class="mt-16 flex flex-col md:flex-row lg:justify-between">
                        <div>
                            <div class="flex gap-3 items-center">
                                <div class="w-8 lg:w-14 h-1 bg-green-950 rounded-lg"></div>
                                <h3 class="tracking-wider leading-tight animate-fadeInScale font-extralight">LAYANAN
                                    KAMI
                                </h3>
                            </div>
                            <div
                                class="text-2xl font-sans font-medium md:text-4xl animate-fadeInScale w-full text-green-950">
                                <span> Belajar Bermain, Berkarya untuk</span>
                                <span class="flex items-center gap-3">
                                    Semua
                                    <div class="w-8 lg:w-12 h-1 bg-green-950 rounded-lg"></div>
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-x-4 mt-4 self-end">
                            <button id="prev" aria-label="Previous testimonial"
                                class="btn inline-flex h-12 w-12 items-center justify-center rounded-full ring shadow-sm ring-gray-950/10">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="h-10 w-10">
                                    <path fill-rule="evenodd"
                                        d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button id="next" aria-label="Next testimonial"
                                class="btn inline-flex h-12 w-12 items-center justify-center rounded-full ring shadow-sm ring-gray-950/10">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="h-10 w-10">
                                    <path fill-rule="evenodd"
                                        d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative mt-16 flex items-center py-5 lg:py-10">
                        <div id="carousel"
                            class="relative scrollbar-hide flex w-full snap-x snap-mandatory scroll-pl-28 scroll-pr-8 gap-8 overflow-x-auto overscroll-x-contain">
                            @foreach ($tourPackages as $package)
                                @if ($package->is_visible)
                                    <x-card-package
                                        class="transform transition-transform hover:scale-105 shadow-lg rounded-lg"
                                        image="{{ asset('storage/' . $package->image_icon) }}"
                                        price="IDR {{ number_format($package->price, 0, ',', '.') }}"
                                        name="{{ $package->name }}"
                                        description="{{ Str::limit($package->description, 100, ' ....') }}">
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
                    <div class="px-4 md:px-10">
                        <p class="text-sm lg:text-lg text-gray-600">Ayo kunjungi Rumah Pintar Wisata Desa, tempat seru
                            untuk
                            belajar
                            dan bermain bersama keluarga.</p>
                        <div class="mt-2 flex gap-x-2">
                            <a href="#services" class="text-sm lg:text-lg font-medium text-[#0a369d]">Liburan Sekarang!!
                                <svg viewBox="0 0 20 20" fill="currentColor" class="inline-block h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="h-full lg:mb-60">
                <div class="px-4 lg:px-20 mx-auto my-4 lg:my-10">
                    <div class="text-center mb-14 text-green-950" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-once="true">
                        <h3 class="text-gray-600 text-sm font-semibold">CUSTOMER STORY</h3>
                        <h2 class="text-2xl lg:text-4xl font-bold">CHECK PENILAIAN DARI MEREKA</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="w-full mx-auto" data-aos="fade-right" data-aos-duration="1000"
                            data-aos-once="true">
                            <div class="card bg-base-100 mt-4 shadow-md p-5">
                                <div class="flex mt-3 justify-start space-x-2">
                                    <img class="rounded-full" src="https://via.placeholder.com/100"
                                        alt="Hanif Pandu Nugroho">
                                    <div>
                                        <h4 class="text-lg font-semibold ml-1">Hanif Pandu Nugroho</h4>
                                        <div class="flex space-x-1 mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-sm m-1 font-light">9 bulan yg lalu</h2>
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-3">Terimakasih telah menerima saya untuk melaksanakan
                                    kegiatan
                                    praktikum 🙏🏻, semoga rumpi jember semakin berkembang dan sukses selalu aamiin ya
                                    rabbal alamin</p>
                            </div>
                        </div>
                        <div class="w-full mx-auto" data-aos="fade-right" data-aos-duration="1200"
                            data-aos-once="true">
                            <div class="card bg-base-100 mt-4 shadow-md p-5">
                                <div class="flex mt-3 justify-start space-x-2">
                                    <img class="rounded-full" src="https://via.placeholder.com/100"
                                        alt="BUFF TRAVELER">
                                    <div>
                                        <h4 class="text-lg font-semibold ml-1">BUFF TRAVELER</h4>
                                        <div class="flex space-x-1 mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-sm m-1 font-light">1 tahun yg lalu</h2>
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-3">Cool and educative place at, karangharjo village, silo,
                                    Jember. Fun education Center for public and students. We can learn anything about
                                    history, sains, and edupark.

                                    The owner is friendly and family.
                                    Important think is, tadabur, trip, silaturahmi.</p>
                            </div>
                        </div>
                        <div class="w-full mx-auto" data-aos="fade-right" data-aos-duration="1500"
                            data-aos-once="true">
                            <div class="card bg-base-100 mt-4 shadow-md p-5">
                                <div class="flex mt-3 justify-start space-x-2">
                                    <img class="rounded-full" src="https://via.placeholder.com/100" alt="Amrullah">
                                    <div>
                                        <h4 class="text-lg font-semibold ml-1">Amrullah</h4>
                                        <div class="flex space-x-1 mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.834 2.06a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.834-2.06a1 1 0 00-1.175 0l-2.834 2.06c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-sm m-1 font-light">3 tahun yg lalu</h2>
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-3">Edukatif dan inspiratif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="about-us" class="relative my-5 mb-4 lg:mb-60">
                <div class="px-4 lg:px-20 mx-auto py-10 md:py-6 z-10 h-full space-y-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 h-full">
                        <div>
                            <div class="flex gap-6 justify-center items-end">
                                <img class="rounded-full object-cover size-32 md:size-64 lg:size-80"
                                    src="{{ asset('storage/background/background_1.png') }}" alt=""
                                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                                <img class="rounded-full object-cover size-32 md:size-44 lg:size-58"
                                    src="{{ asset('storage/background/background_3.png') }}" alt=""
                                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                            </div>
                            <div class="flex justify-center">
                                <img class="rounded-full object-cover size-36 md:size-48 lg:size-52"
                                    src="{{ asset('storage/background/background_5.png') }}" alt=""
                                    data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                            </div>
                        </div>
                        <div class="mt-8 md:mt-20">
                            <div class="flex gap-3 items-center">
                                <div class="w-8 lg:w-14 h-1 bg-green-950 rounded-lg"></div>
                                <h3
                                    class="tracking-wider leading-tight animate-fadeInScale font-extralight text-green-950">
                                    TENTANG
                                    KAMI
                                </h3>
                            </div>
                            <div
                                class="text-2xl font-sans font-medium md:text-4xl animate-fadeInScale w-full text-green-950 mb-4 lg:mb-10">
                                <span>Berkomitmen pada Pembelajaran</span>
                                <span class="flex items-center gap-3">
                                    Berkelanjutan
                                    <div class="w-8 lg:w-12 h-1 bg-green-950 rounded-lg"></div>
                                </span>
                            </div>
                            <div class="">
                                <p class="text-gray-700 leading-relaxed mb-5">
                                    Ini adalah bagian deskripsi tentang kami. Anda bisa menjelaskan visi misi,
                                    nilai-nilai, atau informasi penting lainnya tentang perusahaan atau organisasi Anda.
                                    Pastikan deskripsinya informatif dan menarik bagi pengunjung website Anda.
                                </p>
                                <a href="#"
                                    class=" px-6 py-3 bg-[#0a369d] text-white rounded-lg hover:bg-[#190a9d] transition duration-300 hover:animate-tiltHover">
                                    Lihat Selengkapnya <i class="fa fa-arrow-right ml-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <x-footer-guest />

            <x-modal name="auth" :show="$errors->isNotEmpty()" focusable>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="relative flex flex-col w-full mb-6 rounded-lg bg-white">
                    <div class="rounded-t-lg px-6 py-6 text-center">
                        <h6 class="text-gray-800 text-xl font-semibold mb-3">
                            Masuk
                        </h6>
                    </div>
                    <div class="px-6 py-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Alamat Email -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')"
                                    class="block text-gray-700 text-sm font-medium mb-2" />
                                <x-text-input id="email"
                                    class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0a369d] w-full transition duration-150 ease-in-out"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                            </div>

                            <!-- Kata Sandi -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Password')"
                                    class="block text-gray-700 text-sm font-medium mb-2" />

                                <x-text-input id="password"
                                    class="border border-gray-300 px-4 py-2 placeholder-gray-400 text-gray-700 bg-white rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0a369d] w-full transition duration-150 ease-in-out"
                                    type="password" name="password" required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                            </div>

                            <!-- Ingat Saya -->
                            <div class="flex items-center justify-between mb-4">
                                <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-[#0a369d] shadow-sm focus:ring-[#0a369d]"
                                        name="remember">
                                    <span class="ml-2">Ingat saya</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm text-[#0a369d] hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-[#0a369d]"
                                        href="{{ route('password.request') }}">
                                        Lupa kata sandi?
                                    </a>
                                @endif
                            </div>

                            <div class="text-center">
                                <x-primary-button
                                    class="w-1/2 py-2 bg-[#0a369d] text-white rounded-lg hover:bg-[#0a369d] focus:outline-none focus:ring-2 focus:ring-[#0a369d]">
                                    <h6 class="mx-auto">Masuk</h6>
                                </x-primary-button>
                            </div>

                            @if (Route::has('register'))
                                <div class="flex justify-center text-sm text-gray-600 mt-4">
                                    <span>Belum punya akun?</span>
                                    <a class="ml-2 text-[#0a369d] hover:text-[#0a369d] focus:outline-none focus:ring-2 focus:ring-[#0a369d]"
                                        href="{{ route('register') }}">
                                        Daftar
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </x-modal>
        </main>
    </div>
</x-guest-layout>
