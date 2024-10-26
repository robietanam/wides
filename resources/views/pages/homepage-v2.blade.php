<x-guest-layout>
    <x-slot name="title">Homepage</x-slot>
    <div x-data="{ modalIsOpen: false, mediaSrc: null }">
        <x-navbar-guest />
        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
            class="fixed inset-0 w-full h-full z-50 flex items-center justify-center bg-black/20 lg:p-24 pb-8 backdrop-blur-md sm:items-center p-4"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <div @click="modalIsOpen = false" class="absolute top-0 right-0">
                <svg class="fill-slate-600 w-14 aspect-square" viewBox="0 -0.5 25 25"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z"
                            fill="#000000"></path>
                    </g>
                </svg>
            </div>
            <!-- Modal Dialog -->
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class="flex w-fit h-fit flex-col gap-4 overflow-hidden rounded-md  justify-center items-center">
                <img :src="mediaSrc" alt="Tour Image" class="w-full h-full object-contain ">
            </div>
        </div>
        <main class="min-h-screen">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <section id="hero" class="hero relative bg-cover bg-center text-white h-[130vh] lg:h-full"
                style="background-image: url('{{ asset('storage/' . ($siteInfo->landing_image ?? 'background/background_13.jpg')) }}');">
                <div class="absolute inset-0 bg-black opacity-45"></div>
                <div class="px-4 lg:px-20 md:py-16 relative z-10">

                    <div class=" lg:py-20 max-w-7xl h-[50vh] lg:h-[90vh] z-20">
                        <h1
                            class="text-6xl font-hero md:text-8xl tracking-wider font-normal leading-tight animate-fadeInScale w-full lg:w-3/6 mt-10 pt-32 lg:mt-20">
                            Wisata Desa Karangharjo
                        </h1>

                        <div class="flex justify-between flex-col lg:flex-row">

                            <div class="mb-10">
                                <p class="text-sm md:text-lg font-sans animate-fadeInDown lg:w-3/6 ">
                                    {{ $siteInfo->landing_desc }}
                                </p>
                                <div class="flex flex-wrap gap-5 mt-4 items-center animate-fadeInUp">
                                    <a href="#layanan"
                                        class="p-3 flex flex-row gap-1 justify-center items-center bg-white text-primary shadow-button hover:bg-primary hover:text-white transition-all duration-300 hover:animate-tiltHover">Order
                                        Paket<i class="fas fa-plus"></i></a>
                                    <a href="#galeri"
                                        class="p-3 flex flex-row gap-1 justify-center items-center bg-transparent text-white border-0 hover:bg-white hover:text-primary"><i
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
                                            <p class="text-xs font-light">
                                                {{ $siteInfo->address ??
                                                    'Dusun Sumberpinang, Desa Karangharjo, Kec.Silo, Kabupaten Jember, Jawa Timur,POS,68184' }}
                                            </p>
                                            <div
                                                class="pt-2 md:pt-4 translate-y-3 flex flex-col md:flex-row justify-between md:items-center">
                                                <div x-data="{ copied: false }">
                                                    @if (isset($siteInfo->phone_number))
                                                        <div class="flex gap-2">
                                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                                            <p @click="
                                                            navigator.clipboard.writeText('{{ $siteInfo->phone_number }}');
                                                            copied = true
                                                            setTimeout(()=>(copied=false), 3000)
                                                            "
                                                                :class="{ 'text-semibold': copied }"
                                                                class="text-xs italic cursor-pointer"
                                                                x-text="copied ? 'Tersalin!' : '{{ $siteInfo->phone_number }}'">
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div
                                                    class="flex flex-row gap-5 items-center mt-2 md:mt-0 md:-translate-x-3 ">
                                                    @if (isset($siteInfo->contact_person))
                                                        <a class="text-lg hover:scale-110 hover:duration-700"
                                                            target="_blank"
                                                            :href="'https://wa.me/62' + '{{ $siteInfo->contact_person }}'">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                    @endif
                                                    @if (isset($siteInfo->facebook))
                                                        <a class="text-lg hover:scale-110 hover:duration-700"
                                                            :href="'https://facebook.com/' + '{{ $siteInfo->facebook }}'">
                                                            <i class="fab fa-facebook"></i>
                                                        </a>
                                                    @endif

                                                    @if (isset($siteInfo->instagram))
                                                        <a class="text-lg hover:scale-110 hover:duration-700"
                                                            :href="'https://instagram.com/' + '{{ $siteInfo->instagram }}'">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    @endif
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

            <section id="layanan" class="relative my-4 lg:my-20 h-full lg:mb-32">
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
                                        description="{{ Str::limit($package->description, 100, ' ....') }}"
                                        discount="{{ $package->discount }}">
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
                    </div>
                </div>
            </section>

            <section id="galeri" class="h-full mt-16 lg:mt-32"">
                <div class="px-4 lg:px-20 mx-auto my-4 lg:my-10 h-full">
                    <div class="text-center mb-8 text-green-950" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-once="true">
                        <h2 class="text-2xl lg:text-4xl font-bold">Lihat Kegiatan Kami</h2>
                    </div>
                    @if ($videoId)
                        <div class="px-20 max-md:px-8 flex flex-col justify-center items-center h-full">
                            <iframe class="w-full aspect-video"
                                src="https://www.youtube.com/embed/{{ $videoId }}">
                            </iframe>
                        </div>
                    @endif
                </div>
                @if (!empty($siteInfo->gallery))
                    <div class="embla w-[90%] max-md:w-full mx-auto px-20 max-md:px-5 ">
                        <div class="embla__viewport overflow-hidden rounded-lg">
                            <div class="embla__container flex " id="lightgallery">
                                @foreach ($siteInfo->gallery as $image)
                                    <div @click="modalIsOpen = true;mediaSrc='{{ asset('storage/' . $image) }}'"
                                        class="embla__slide min-w-[50%] ml-1 rounded-lg overflow-hidden border border-slate-300 p-0 hover:cursor-pointer"
                                        href="{{ asset('storage/' . $image) }}" target="_blank" data-pswp-zoomable>
                                        <img src="{{ asset('storage/' . $image) }}" alt="Tour Image"
                                            class="w-full aspect-video object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>

            <section class="h-full mt-16 lg:mt-32">
                <div class="px-4 lg:px-20 mx-auto my-4 lg:my-10">
                    <div class="text-center mb-14 text-green-950" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-once="true">
                        <h3 class="text-gray-600 text-sm font-semibold">CUSTOMER STORY</h3>
                        <h2 class="text-2xl lg:text-4xl font-bold">CHECK PENILAIAN DARI MEREKA</h2>
                    </div>
                    @if (!empty($ratings))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($ratings as $rating)
                                <div class="w-full mx-auto" data-aos="fade-right" data-aos-duration="1000"
                                    data-aos-once="true">
                                    <div
                                        class="card bg-base-100 mt-4 border border-slate-200 rounded-md shadow-md p-5 min-h-[17rem]">
                                        <div class="flex mt-3 justify-start space-x-2">
                                            <img class="rounded-full w-28 aspect-square object-cover"
                                                src="{{ $rating->image ? asset('storage/' . $rating->image) : 'https://via.placeholder.com/100' }}"
                                                alt="{{ $rating->name }}">
                                            <div>
                                                <h4 class="text-lg font-semibold ml-1">{{ $rating->name }}</h4>
                                                <div class="flex space-x-1 mt-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating->stars)
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                class="h-5 w-5 text-yellow-400 fill-yellow-400"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M21.12 9.88005C21.0781 9.74719 20.9996 9.62884 20.8935 9.53862C20.7873 9.4484 20.6579 9.38997 20.52 9.37005L15.1 8.58005L12.67 3.67005C12.6008 3.55403 12.5027 3.45795 12.3853 3.39123C12.2678 3.32451 12.1351 3.28943 12 3.28943C11.8649 3.28943 11.7322 3.32451 11.6147 3.39123C11.4973 3.45795 11.3991 3.55403 11.33 3.67005L8.89999 8.58005L3.47999 9.37005C3.34211 9.38997 3.21266 9.4484 3.10652 9.53862C3.00038 9.62884 2.92186 9.74719 2.87999 9.88005C2.83529 10.0124 2.82846 10.1547 2.86027 10.2907C2.89207 10.4268 2.96124 10.5512 3.05999 10.6501L6.99999 14.4701L6.06999 19.8701C6.04642 20.0091 6.06199 20.1519 6.11497 20.2826C6.16796 20.4133 6.25625 20.5267 6.36999 20.6101C6.48391 20.6912 6.61825 20.7389 6.75785 20.7478C6.89746 20.7566 7.03675 20.7262 7.15999 20.6601L12 18.1101L16.85 20.6601C16.9573 20.7189 17.0776 20.7499 17.2 20.7501C17.3573 20.7482 17.5105 20.6995 17.64 20.6101C17.7537 20.5267 17.842 20.4133 17.895 20.2826C17.948 20.1519 17.9636 20.0091 17.94 19.8701L17 14.4701L20.93 10.6501C21.0305 10.5523 21.1015 10.4283 21.1351 10.2922C21.1687 10.1561 21.1634 10.0133 21.12 9.88005Z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        @else
                                                            <svg viewBox="0 0 24 24" version="1.2"
                                                                baseProfile="tiny" class="h-5 w-5  fill-yellow-400"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M16.855 20.966c-.224 0-.443-.05-.646-.146l-.104-.051-4.107-2.343-4.107 2.344-.106.053c-.488.228-1.085.174-1.521-.143-.469-.34-.701-.933-.586-1.509l.957-4.642-1.602-1.457-1.895-1.725-.078-.082c-.375-.396-.509-.97-.34-1.492.173-.524.62-.912 1.16-1.009l.102-.018 4.701-.521 1.946-4.31.06-.11c.262-.473.764-.771 1.309-.771.543 0 1.044.298 1.309.77l.06.112 1.948 4.312 4.701.521.104.017c.539.1.986.486 1.158 1.012.17.521.035 1.098-.34 1.494l-.078.078-3.498 3.184.957 4.632c.113.587-.118 1.178-.59 1.519-.252.182-.556.281-.874.281zm-8.149-6.564c-.039.182-.466 2.246-.845 4.082l3.643-2.077c.307-.175.684-.175.99 0l3.643 2.075-.849-4.104c-.071-.346.045-.705.308-.942l3.1-2.822-4.168-.461c-.351-.039-.654-.26-.801-.584l-1.728-3.821-1.726 3.821c-.146.322-.45.543-.801.584l-4.168.461 3.1 2.822c.272.246.384.617.302.966z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h2 class="text-sm m-1 font-light">
                                                    {{ $rating->updated_at->diffForHumans() }}</h2>
                                            </div>
                                        </div>

                                        <!-- prettier-ignore -->
                                        <p class="text-gray-600 mt-3 text-justify whitespace-normal ">{{ trim(substr($rating->description, 0, 120)) }}@if (strlen($rating->description) > 120)<span id="more_{{ $rating->id }}"
                                        class="hidden ">{{ trim(substr($rating->description, 120)) }}</span>
                                        <button @click="readMore('{{ $rating->id }}')"
                                            id="myBtn_{{ $rating->id }}" class="text-blue-700">... Lebih
                                            banyak</button>

                                        <!-- prettier-ignore -->
                                        @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @else
                        <p> Tidak ada penilaiaan untuk ditampilkan.</p>
                    @endif
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
                                    src="{{ asset('storage/background/background_8.png') }}" alt=""
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
                                class="text-2xl font-sans font-medium md:text-4xl animate-fadeInScale w-full text-green-950 my-4 ">
                                <span>{{ $siteInfo->profile_title ?? 'Berkomitmen pada Pembelajaran Berkelanjutan' }}</span>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-gray-700 leading-relaxed mb-5">
                                    {{ $siteInfo->profile_desc ?? ' ' }}
                                </p>
                                <div class="w-16 lg:w-20 h-1 bg-green-950 rounded-lg self-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <x-footer-guest :siteInfo="$siteInfo" />

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
    @push('scripts')
        @vite('resources/js/homepage-plugin.js')
        <script type="text/javascript">
            function readMore(id) {
                var moreText = document.getElementById("more_" + id);
                var btnText = document.getElementById("myBtn_" + id);

                if (btnText.innerHTML === "Lebih sedikit") {
                    btnText.innerHTML = "... Lebih banyak";
                    moreText.classList.add("hidden")
                } else {
                    btnText.innerHTML = "Lebih sedikit";
                    moreText.classList.remove("hidden")
                }
            }
            window.addEventListener('DOMContentLoaded', function() {


            });
        </script>
    @endpush
</x-guest-layout>
