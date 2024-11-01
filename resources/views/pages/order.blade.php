<x-guest-layout>
    <x-slot name="title">Order Paket</x-slot>
    <div x-data="{ modalIsOpen: false, isImage: false, mediaSrc: null, }">
        <x-navbar-guest :navbarAlwaysVisible="true" shadowStrength="md" />
        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
            class="fixed w-full h-full inset-0 z-50 flex items-center justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
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
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class=" flex w-full justify-center items-center flex-col gap-4 overflow-hidden rounded-md ">

                <img x-show='isImage' :src="mediaSrc" alt="Tour Image" class="w-fit   object-contain">
                <iframe x-show='!isImage' :src="`https://youtube.com/embed/${mediaSrc}`" class="w-full aspect-video"
                    frameborder="0"></iframe>
            </div>
        </div>
        <section class="relative z-10 lg:pt-20 ">
            <div class="w-full max-w-7xl md:px-5 lg:px-6 mx-auto relative ">
                <div x-data="ticketApp({{ $tourPackage->price }}, {{ $tourPackage->discount }}, '{{ $tourPackage->id }}', '{{ csrf_token() }}', '{{ route('order.store') }}', {{ $payment }}, {{ $user }})" class="grid grid-cols-12">

                    <div x-show="showErrorToast" role="alert"
                        class="alert alert-error fixed top-5 right-5 w-fit z-50 flex flex-row">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span x-text="errorMessage"></span>
                        <button type="button" @click="showErrorToast = false"
                            class="btn btn-sm btn-circle bg-red-200">✕</button>
                    </div>

                    <div class="relative col-span-12 xl:col-span-8 md:py-5 lg:pr-8 pb-8 lg:py-11 w-full max-xl:max-w-3xl max-xl:mx-auto"
                        x-show="!isMobile || currentStep === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full">
                        <div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent sm:block md:hidden lg:hidden">
                            <div class="flex-none">
                                <button @click="window.location.href = '{{ route('home') }}'"
                                    class="bg-base-100 bg-opacity-80 rounded-full text-white font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                        id="back">
                                        <path
                                            d="M22,15H12.41l2.3-2.29a1,1,0,0,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L12.41,17H22a1,1,0,0,0,0-2Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <h3 class="font-bold text-2xl leading-10 text-black pb-5 hidden md:block">
                            Pemesanan Tiket Wisata
                        </h3>

                        <div
                            class="container border border-slate-600 border-opacity-30  bg-white md:shadow-md rounded-md p-5">
                            <div class="border-b border-base-dark">

                                <div class="flex flex-col md:flex-row">
                                    <div class="sticky top-0 md:static lg:w-10/12 lg:h-1/2 lg:rounded-lg z-0">
                                        <img src="{{ asset('storage/' . $tourPackage->image_icon) ?? 'https://placehold.co/600x400?text=' . urlencode($tourPackage->name) }}"
                                            alt="Gambar {{ $tourPackage->name }}" class="w-full h-auto lg:rounded-lg">
                                    </div>
                                    <div class="px-4 bg-white rounded-t-xl py-5 -mt-5 z-10 md:w-[90%]">
                                        <h3 class="font-bold text-green-500 text-sm">Paket Pilihan Anda</h3>
                                        <h3 class="font-semibold text-xl mb-2"> {{ $tourPackage->name }}
                                        </h3>
                                        <p class="text-gray-500 text-sm mb-3 text-justify">
                                            {{ $tourPackage->description }}</p>
                                    </div>
                                </div>
                                <div class="mx-3 lg:-mx-0 md:mt-3">
                                    <div class="bg-blue-50 rounded-md p-3 mb-3">
                                        <h3>Benefit</h3>
                                        <ul class="list-disc list-inside text-sm">
                                            @foreach ($tourPackage->services as $service)
                                                <li class="flex items-center gap-3">
                                                    <i class="fas fa-check-circle text-success text-lg"></i>
                                                    <span class="text-sm lg:text-base">{{ $service->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <h3 class="py-2 text-lg font-semibold">Galeri Kegiatan</h3>
                                    <div class="embla">
                                        <div class="embla__viewport overflow-hidden ">
                                            <div class="embla__container flex ">
                                                @if (!empty($images))
                                                    @foreach ($images as $image)
                                                        <div class="embla__slide min-w-full aspect-video rounded-lg overflow-hidden border border-slate-300 "
                                                            href="{{ asset('storage/' . $image['image_url']) }}"
                                                            @click="modalIsOpen = true;isImage=true;mediaSrc='{{ asset('storage/' . $image['image_url']) }}'"
                                                            target="_blank" data-pswp-zoomable>
                                                            <img src="{{ asset('storage/' . $image['image_url']) }}"
                                                                alt="Tour Image" class="w-full h-full object-cover">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if (!empty($videos))
                                                    @foreach ($videos as $key => $video)
                                                        <div class="embla__slide min-w-full aspect-video relative hover:cursor-pointer rounded-lg overflow-hidden border border-slate-300 "
                                                            @click="modalIsOpen = true;isImage=false;mediaSrc='{{ $video->youtube_id }}'">

                                                            <img class="w-full h-full object-cover"
                                                                src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" />

                                                            <div
                                                                class="absolute inset-0  bg-black bg-opacity-50 flex items-center justify-center transition-opacity duration-300">

                                                                <svg viewBox="0 0 24 24"
                                                                    class="fill-white h-20 aspect-square"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path
                                                                            d="M16.6582 9.28638C18.098 10.1862 18.8178 10.6361 19.0647 11.2122C19.2803 11.7152 19.2803 12.2847 19.0647 12.7878C18.8178 13.3638 18.098 13.8137 16.6582 14.7136L9.896 18.94C8.29805 19.9387 7.49907 20.4381 6.83973 20.385C6.26501 20.3388 5.73818 20.0469 5.3944 19.584C5 19.053 5 18.1108 5 16.2264V7.77357C5 5.88919 5 4.94701 5.3944 4.41598C5.73818 3.9531 6.26501 3.66111 6.83973 3.6149C7.49907 3.5619 8.29805 4.06126 9.896 5.05998L16.6582 9.28638Z"
                                                                            stroke-linejoin="round"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="embla-thumbs mt-4">
                                            <div class="embla-thumbs__viewport overflow-hidden w-full">
                                                <div class="embla-thumbs__container flex space-x-4">
                                                    @if (!empty($images))
                                                        @foreach ($images as $image)
                                                            <div class="embla-thumbs__slide min-w-28 max-w-28 cursor-pointer rounded-lg overflow-hidden"
                                                                data-index="{{ $loop->index }}">
                                                                <img src="{{ asset('storage/' . $image['image_url']) }}"
                                                                    alt="Thumbnail Image"
                                                                    class="w-full h-24 object-cover  ">
                                                            </div>
                                                        @endforeach

                                                    @endif
                                                    @if (!empty($videos))
                                                        @foreach ($videos as $key => $video)
                                                            <div class="embla-thumbs__slide min-w-28 max-w-28 cursor-pointer rounded-lg overflow-hidden"
                                                                data-index="{{ $loop->index }}">
                                                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/default.jpg"
                                                                    alt="Thumbnail Image"
                                                                    class="w-full h-24 object-cover  ">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="p-2">
                                            <span class="text-gray-600 text-sm font-medium">Harga</span>
                                            <div class="flex items-baseline space-x-2 mt-1">
                                                <span x-text="ticketPrice.toLocaleString('id-ID')"
                                                    class="text-3xl font-extrabold text-blue-700"></span>
                                                <span class="text-gray-600 text-xl font-semibold">IDR</span>
                                            </div>
                                            <p class="text-sm text-blue-800" x-show="discount">Diskon (<span
                                                    x-text="'-' + discount + '%'"></span>) </p>
                                            <p class="text-gray-500 text-xs mt-1">*Harga dapat berubah sewaktu-waktu
                                            </p>
                                        </div>

                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <!-- Tombol "-" -->
                                            <button class="px-3 py-2 text-gray-600 hover:bg-gray-100"
                                                @click="ticketQuantity = Math.max(1, ticketQuantity - 1)"
                                                :disabled="ticketQuantity <= 1"
                                                :class="{ 'opacity-50 cursor-not-allowed': ticketQuantity <= 1 }">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <!-- Input Jumlah Tiket -->
                                            <input type="text" x-model="ticketQuantity"
                                                class="w-12 h-full text-center border-b-0 border-t-0 border-gray-300 px-2 text-gray-900">

                                            <!-- Tombol "+" -->
                                            <button class="px-3 py-2 text-gray-600 hover:bg-gray-100"
                                                @click="ticketQuantity = Math.min(30, ticketQuantity + 1)"
                                                :disabled="ticketQuantity >= 30"
                                                :class="{ 'opacity-50 cursor-not-allowed': ticketQuantity >= 30 }">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pemilihan tanggal kunjungan --}}
                            <div class="mt-5 pb-8 mx-5 md:-mx-0">
                                <h3 class="font-semibold mb-4 text-lg text-base-dark">Tanggal Kunjungan</h3>
                                <div class="flex justify-center">
                                    <input class="hidden " type="text" id="date-picker" name="date"
                                        x-model="tanggalKunjungan" />
                                </div>
                                <!-- <div class="grid grid-cols-5 gap-3 mb-2">
                                    <template x-for="(date, index) in dates" :key="date.value">
                                        <label
                                            :class="tanggalKunjungan === date.value ? 'bg-blue-200 text-blue-700' :
                                                'bg-gray-200 text-gray-700'"
                                            class="flex flex-col items-center justify-center px-3 py-2 rounded-lg cursor-pointer border border-gray-400 transition-colors duration-200">
                                            <input type="radio" x-model="tanggalKunjungan" :value="date.value"
                                                class="hidden" name="tanggal_kunjungan">
                                            <span
                                                x-text="index === 0 ? 'Hari Ini' : (index === 1 ? 'Besok' : date.dateString)"
                                                class="text-xs md:text-sm font-medium md:font-semibold font-sans"></span>
                                            <span x-show="index !== 0 && index !== 1" x-text="date.monthString"
                                                class="text-xs font-medium lg:text-sm font-sans mt-1 text-gray-500"></span>
                                        </label>
                                    </template>
                                </div> -->
                            </div>

                            <!-- Payment Selection -->
                            <div class="mt-5 mb-10 col-span-12 mx-5 md:-mx-0">
                                <h3 class="font-semibold mb-4 text-lg text-base-dark">Metode Pembayaran</h3>
                                <div class="space-y-5">
                                    <template x-for="(types, index) in paymentMethods" :key="index">
                                        <div>
                                            <button @click="openIndex = index"
                                                class="w-full h-fit px-5 py-3  rounded-lg border border-blue-500 text-xl font-medium text-left">
                                                <div class="flex justify-between items-center">
                                                    <p x-text="index"></p>
                                                    <x-heroicon-o-chevron-down x-show="openIndex !== index"
                                                        class="h-5 aspect-square" />
                                                    <x-heroicon-o-chevron-up x-show="openIndex === index"
                                                        class="h-5 aspect-square" />
                                                </div>
                                            </button>
                                            <div class="mt-3 flex flex-col gap-2">
                                                <template x-for="(method, _index) in types" :key="_index">
                                                    <div x-show="openIndex === index" x-transition>
                                                        <label
                                                            :class="{
                                                                'bg-blue-500 text-white shadow-md': paymentMethod ==
                                                                    method.payment_name,
                                                                'bg-white text-base-dark border border-gray-300 hover:bg-gray-50': paymentMethod !=
                                                                    method.payment_name
                                                            }"
                                                            class="flex items-center p-4 justify-between rounded-md transition-colors duration-200">
                                                            <input type="radio" x-model="paymentMethod"
                                                                :value="method.payment_name"
                                                                class="radio radio-info w-5 h-5"
                                                                name="payment_method">
                                                            <div class="flex-grow ml-2">
                                                                <span x-text="method.payment_name"
                                                                    class="text-sm font-medium"></span>
                                                                <!-- Deskripsi Metode Pembayaran -->
                                                                <p x-text="method.description"
                                                                    class="text-xs text-gray-500 mt-1"></p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <!-- Next Button for Mobile -->
                        <template x-if="isMobile">
                            <button
                                class=" fixed w-full h-fit py-5 bottom-0 left-0 right-0 z-50 bg-blue-600  text-white font-semibold text-lg "
                                @click="currentStep = 2">
                                <p>Lanjutkan</p>
                            </button>
                        </template>
                    </div>

                    <!-- Step 2: Ringkasan Pesanan -->
                    <div class="col-span-12 xl:col-span-4 bg-gray-50 w-full max-md:px-6 max-w-3xl xl:max-w-lg mx-auto py-10"
                        x-show="!isMobile || currentStep === 2" x-transition:enter="transition ease-out duration-300"
                        x-bind:x-transition:enter-start="currentStep === 2 ? 'opacity-0 transform translate-x-full' : 'opacity-0 transform -translate-x-full'"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-bind:x-transition:leave-end="currentStep === 2 ? 'opacity-0 transform -translate-x-full' : 'opacity-0 transform translate-x-full'">
                        <div
                            class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent sm:block md:hidden lg:hidden">
                            <div class="flex-none">
                                <button @click="currentStep = 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                        id="back">
                                        <path
                                            d="M22,15H12.41l2.3-2.29a1,1,0,0,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L12.41,17H22a1,1,0,0,0,0-2Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-1 ml-5">
                                <h3
                                    class="font-semibold text-xl md:text-2xl leading-10 text-black md:pb-8 md:border-b md:border-gray-300">
                                    Ringkasan Pesanan
                                </h3>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl lg:text-2xl leading-10 text-black pb-6 hidden md:block">
                                Ringkasan Pesanan</h3>
                            <div class="flex justify-center items-center mt-8 md:-mt-0">
                                <div
                                    class="container p-6 max-w-lg bg-white border border-slate-600 border-opacity-30 rounded-lg shadow-lg">

                                    <div class="mb-4 text-gray-700">
                                        <p class="text-sm font-medium">Nama Pemesan</p>
                                        <div class="relative w-full h-fit ">
                                            <div
                                                class="absolute flex items-center justify-center self-center h-full w-10 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="h-4 w-4 opacity-70 ">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                                                </svg>
                                            </div>
                                            <input type="text" id="name" class="w-full rounded-lg pl-10"
                                                x-model="nama" />
                                        </div>
                                    </div>
                                    <div class="mb-4 text-gray-700">
                                        <p class="text-sm font-medium">Email</p>
                                        <div class="relative w-full h-fit ">
                                            <div
                                                class="absolute flex items-center justify-center self-center h-full w-10 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="h-4 w-4 opacity-70">
                                                    <path
                                                        d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                    <path
                                                        d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                                </svg>
                                            </div>
                                            <input type="email" id="email" class="w-full rounded-lg pl-10"
                                                x-model="email" />
                                        </div>

                                    </div>
                                    <div class="mb-4 text-gray-700">
                                        <p class="text-sm font-medium">No. Whatsapp</p>
                                        <div class="relative w-full h-fit ">
                                            <div
                                                class="absolute flex items-center justify-center self-center h-full w-10 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70"
                                                    viewBox="0 0 256 258">
                                                    <defs>
                                                        <linearGradient id="logosWhatsappIcon0" x1="50%"
                                                            x2="50%" y1="100%" y2="0%">
                                                            <stop offset="0%" stop-color="black" />
                                                            <stop offset="100%" stop-color="black" />
                                                        </linearGradient>
                                                        <linearGradient id="logosWhatsappIcon1" x1="50%"
                                                            x2="50%" y1="100%" y2="0%">
                                                            <stop offset="0%" stop-color="#f9f9f9" />
                                                            <stop offset="100%" stop-color="#fff" />
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#logosWhatsappIcon0)"
                                                        d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004" />
                                                    <path fill="url(#logosWhatsappIcon1)"
                                                        d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z" />
                                                    <path fill="#fff"
                                                        d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64" />
                                                </svg>
                                            </div>
                                            <input type="tel" id="phone" class="w-full rounded-lg pl-10"
                                                x-model="noTelp" />
                                        </div>
                                    </div>
                                    <div class="mb-4 text-gray-700">
                                        <p class="text-sm font-medium">Tanggal Kunjungan</p>
                                        <p class="text-[16px] font-semibold text-base-dark" x-text="tanggalKunjungan">
                                        </p>

                                    </div>

                                    <!-- Ringkasan Pembayaran -->
                                    <div class="border-t border-gray-200 pt-4 mb-6 text-gray-700">
                                        <p class="text-[16px] font-semibold text-gray-800 mb-4">Ringkasan Pembayaran
                                        </p>
                                        <div class="flex justify-between mb-2">
                                            <p class="text-sm">Metode Pembayaran</p>
                                            <p x-show="paymentMethod" x-text="paymentMethod" class="font-semibold">
                                            </p>
                                            <p x-show="!paymentMethod" class="font-semibold text-red-500">Belum
                                                dipilih
                                            </p>
                                        </div>
                                        <div class="flex justify-between mb-2">
                                            <p class="text-sm">Jumlah Tiket</p>
                                            <p class="font-semibold" x-text="ticketQuantity"></p>
                                        </div>
                                        <div class="flex justify-between mb-2">
                                            <p class="text-sm">Harga</p>
                                            <p class="font-semibold"
                                                x-text="ticketPrice.toLocaleString('id-ID') + '(x' + ticketQuantity + ')'">
                                            </p>
                                        </div>
                                        <div class="flex justify-between mb-4" x-show="discount">
                                            <p class="text-sm">Diskon (<span x-text="discount + '%'"></span>)</p>
                                            <p class="font-semibold">- <span
                                                    x-text="(ticketPrice * discount / 100 * ticketQuantity).toLocaleString('id-ID')"></span>
                                            </p>
                                        </div>
                                        <div class="border-t border-gray-200 pt-4">
                                            <div class="flex justify-between text-lg font-semibold">
                                                <p>Total Harga</p>
                                                <p class="text-blue-600">
                                                    <span>Rp.</span>
                                                    <span x-text="amount.toLocaleString('id-ID')"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click="submitOrder()"
                                        class="bg-blue-600 text-white w-full py-3 rounded-md font-medium text-lg hover:bg-blue-700 transition duration-300">
                                        Pesan Paket
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Step 3: Result Transaction --}}
                    <div class="flex flex-col justify-center items-center bg-blue-500 min-h-screen w-screen p-4 md:hidden"
                        x-show="currentStep >= 3" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full">

                        <div class="text-white w-full">
                            <!-- Icon centang -->
                            <div class="flex flex-col justify-center mb-4 text-center" x-show="currentStep === 4">
                                <div class="flex items-center justify-center">
                                    <x-animated-checkmark />
                                </div>
                                <h2 class="font-semibold text-2xl mb-2 text-blue uppercase">Transaksi Berhasil</h2>
                            </div>
                            <div class="flex flex-col justify-center mb-4 text-center" x-show="loading">
                                <div class="flex items-center justify-center">
                                    <div class="loader !border-r-white"></div>
                                </div>
                                <h2 class="font-semibold text-2xl mb-2 text-blue">Membuat Pesanan, Harap
                                    Menunggu. </h2>
                            </div>
                        </div>
                        <div x-show="currentStep === 4"
                            class="absolute bottom-0 h-60 flex justify-between items-center w-screen px-16 gap-5">
                            <div x-show="!loading"
                                class="p-1 w-32 rounded-lg bg-white flex flex-col justify-center items-center drop-shadow-lg">
                                <svg class="w-5 aspect-square" fill="#000000" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 495.398 495.398" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z">
                                                    </path>
                                                    <path
                                                        d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <p>Home</p>
                            </div>
                            <div x-show="!loading"
                                class="p-1 w-32 rounded-lg bg-white flex flex-col justify-center items-center drop-shadow-lg"
                                @click="window.location.href = '/transition/' + transactionId">
                                <svg class="w-5 aspect-square" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 512 512" viewBox="0 0 512 512" id="ticket">
                                    <path d="M505.081,196.611c3.82,0,6.919-3.097,6.919-6.919V123.56c0-18.536-15.081-33.615-33.617-33.615H33.613
                                          C15.077,89.945,0,105.024,0,123.56v66.133c0,3.822,3.099,6.919,6.919,6.919c32.748,0,59.387,26.642,59.387,59.387
                                          s-26.64,59.387-59.387,59.387c-3.82,0-6.919,3.097-6.919,6.919v66.135c0,18.536,15.077,33.615,33.613,33.615h444.77
                                          c18.536,0,33.617-15.079,33.617-33.615v-66.135c0-3.822-3.099-6.919-6.919-6.919c-32.748,0-59.387-26.642-59.387-59.387
                                          S472.333,196.611,505.081,196.611z M431.856,255.999c0,38.043,29.162,69.403,66.306,72.901v59.541
                                          c0,10.905-8.874,19.777-19.779,19.777H174.297V375.94c0-3.822-3.099-6.919-6.919-6.919s-6.919,3.097-6.919,6.919v32.277H33.613
                                          c-10.905,0-19.775-8.872-19.775-19.777V328.9c37.144-3.498,66.306-34.858,66.306-72.901s-29.162-69.403-66.306-72.901V123.56
                                          c0-10.905,8.869-19.777,19.775-19.777H160.46v32.275c0,3.822,3.099,6.919,6.919,6.919s6.919-3.097,6.919-6.919v-32.275h304.086
                                          c10.905,0,19.779,8.872,19.779,19.777v59.538C461.018,186.596,431.856,217.956,431.856,255.999z M174.297,234.92v42.158
                                          c0,3.822-3.099,6.919-6.919,6.919s-6.919-3.097-6.919-6.919V234.92c0-3.822,3.099-6.919,6.919-6.919
                                          C171.198,228.001,174.297,231.098,174.297,234.92z M174.297,305.429v42.162c0,3.822-3.099,6.919-6.919,6.919
                                          s-6.919-3.097-6.919-6.919v-42.162c0-3.822,3.099-6.919,6.919-6.919C171.198,298.51,174.297,301.607,174.297,305.429z
                                           M174.297,164.409v42.16c0,3.822-3.099,6.919-6.919,6.919s-6.919-3.097-6.919-6.919v-42.16c0-3.822,3.099-6.919,6.919-6.919
                                          C171.198,157.49,174.297,160.587,174.297,164.409z M378.973,170.377c0,3.822-3.099,6.919-6.919,6.919H249.82
                                          c-3.82,0-6.919-3.097-6.919-6.919s3.099-6.919,6.919-6.919h122.234C375.874,163.458,378.973,166.555,378.973,170.377z
                                           M378.973,227.458c0,3.822-3.099,6.919-6.919,6.919H249.82c-3.82,0-6.919-3.097-6.919-6.919s3.099-6.919,6.919-6.919h122.234
                                          C375.874,220.539,378.973,223.636,378.973,227.458z M378.973,284.539c0,3.822-3.099,6.919-6.919,6.919H249.82
                                          c-3.82,0-6.919-3.097-6.919-6.919c0-3.822,3.099-6.919,6.919-6.919h122.234C375.874,277.62,378.973,280.717,378.973,284.539z
                                           M378.973,341.62c0,3.822-3.099,6.919-6.919,6.919H249.82c-3.82,0-6.919-3.097-6.919-6.919c0-3.822,3.099-6.919,6.919-6.919h122.234
                                          C375.874,334.702,378.973,337.798,378.973,341.62z"></path>
                                </svg>
                                <p>
                                    Lanjutkan
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Modal success for dekstop --}}

                    <div class="modal" role="dialog" x-show="!isMobile && (currentStep >= 3)"
                        class="fixed inset-0 flex items-center justify-center z-50"
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-75"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-75">
                        <div class="modal-box">
                            <div class="text-white w-full">
                                <!-- Icon centang -->
                                <div class="flex flex-col justify-center mb-4 text-center" x-show="currentStep === 4">
                                    <div class="flex items-center justify-center">
                                        <x-animated-checkmark />
                                    </div>
                                    <h2 class="font-semibold text-2xl mb-2 text-blue uppercase text-blue-500">
                                        Transaksi
                                        Berhasil</h2>
                                </div>
                                <div class="flex flex-col justify-center mb-4 text-center gap-10 py-5"
                                    x-show="loading">
                                    <div class="flex items-center justify-center">
                                        <div class="loader"></div>
                                    </div>
                                    <h2 class="font-semibold text-xl mb-2 text-blue-500">Membuat Pesanan, Harap
                                        Menunggu. </h2>
                                </div>
                            </div>
                            <div x-show="currentStep === 4" x-data="{ show: false }" x-init="setTimeout(() => show = true, 1000)"
                                class="flex justify-between items-center ">
                                <div x-show="show" class="btn btn-md w-40">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" id="home">
                                            <path fill="#292D32" fill-rule="evenodd"
                                                d="M10.867 3.851c-.506.29-1.11.733-1.981 1.375l-3.5 2.58C4.127 8.732 3.715 9.06 3.492 9.5c-.223.441-.242.967-.242 2.53V15.5c0 1.435.002 2.436.103 3.192.099.734.28 1.122.556 1.399.277.277.665.457 1.4.556.754.101 1.756.103 3.191.103h7c1.435 0 2.436-.002 3.192-.103.734-.099 1.122-.28 1.399-.556.277-.277.457-.665.556-1.4.101-.755.103-1.756.103-3.191v-3.468c0-1.564-.019-2.09-.242-2.53-.223-.442-.635-.77-1.894-1.697l-3.5-2.579c-.872-.642-1.475-1.085-1.98-1.375-.49-.28-.82-.375-1.134-.375-.315 0-.645.096-1.133.375ZM10.12 2.55c.616-.353 1.208-.574 1.879-.574s1.263.221 1.879.574c.59.337 1.262.833 2.089 1.442l3.536 2.606.14.103c1.061.78 1.799 1.323 2.203 2.124.404.8.404 1.716.403 3.033v3.697c0 1.367 0 2.47-.116 3.337-.122.9-.38 1.658-.982 2.26-.602.602-1.36.86-2.26.982-.867.116-1.97.116-3.337.116h-7.11c-1.367 0-2.47 0-3.337-.116-.9-.122-1.658-.38-2.26-.982-.602-.602-.86-1.36-.981-2.26-.117-.867-.117-1.97-.117-3.337v-3.698c0-1.316-.001-2.232.403-3.032.404-.8 1.142-1.343 2.202-2.124l.14-.103 3.537-2.606c.827-.61 1.5-1.105 2.09-1.442Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </i>
                                    Home
                                </div>
                                <div x-show="show" class="btn btn-md w-40"
                                    @click="window.location.href = '/transition/' + transactionId">
                                    <i class="w-5 h-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512"
                                            viewBox="0 0 512 512" id="ticket">
                                            <path d="M505.081,196.611c3.82,0,6.919-3.097,6.919-6.919V123.56c0-18.536-15.081-33.615-33.617-33.615H33.613
                                                  C15.077,89.945,0,105.024,0,123.56v66.133c0,3.822,3.099,6.919,6.919,6.919c32.748,0,59.387,26.642,59.387,59.387
                                                  s-26.64,59.387-59.387,59.387c-3.82,0-6.919,3.097-6.919,6.919v66.135c0,18.536,15.077,33.615,33.613,33.615h444.77
                                                  c18.536,0,33.617-15.079,33.617-33.615v-66.135c0-3.822-3.099-6.919-6.919-6.919c-32.748,0-59.387-26.642-59.387-59.387
                                                  S472.333,196.611,505.081,196.611z M431.856,255.999c0,38.043,29.162,69.403,66.306,72.901v59.541
                                                  c0,10.905-8.874,19.777-19.779,19.777H174.297V375.94c0-3.822-3.099-6.919-6.919-6.919s-6.919,3.097-6.919,6.919v32.277H33.613
                                                  c-10.905,0-19.775-8.872-19.775-19.777V328.9c37.144-3.498,66.306-34.858,66.306-72.901s-29.162-69.403-66.306-72.901V123.56
                                                  c0-10.905,8.869-19.777,19.775-19.777H160.46v32.275c0,3.822,3.099,6.919,6.919,6.919s6.919-3.097,6.919-6.919v-32.275h304.086
                                                  c10.905,0,19.779,8.872,19.779,19.777v59.538C461.018,186.596,431.856,217.956,431.856,255.999z M174.297,234.92v42.158
                                                  c0,3.822-3.099,6.919-6.919,6.919s-6.919-3.097-6.919-6.919V234.92c0-3.822,3.099-6.919,6.919-6.919
                                                  C171.198,228.001,174.297,231.098,174.297,234.92z M174.297,305.429v42.162c0,3.822-3.099,6.919-6.919,6.919
                                                  s-6.919-3.097-6.919-6.919v-42.162c0-3.822,3.099-6.919,6.919-6.919C171.198,298.51,174.297,301.607,174.297,305.429z
                                                   M174.297,164.409v42.16c0,3.822-3.099,6.919-6.919,6.919s-6.919-3.097-6.919-6.919v-42.16c0-3.822,3.099-6.919,6.919-6.919
                                                  C171.198,157.49,174.297,160.587,174.297,164.409z M378.973,170.377c0,3.822-3.099,6.919-6.919,6.919H249.82
                                                  c-3.82,0-6.919-3.097-6.919-6.919s3.099-6.919,6.919-6.919h122.234C375.874,163.458,378.973,166.555,378.973,170.377z
                                                   M378.973,227.458c0,3.822-3.099,6.919-6.919,6.919H249.82c-3.82,0-6.919-3.097-6.919-6.919s3.099-6.919,6.919-6.919h122.234
                                                  C375.874,220.539,378.973,223.636,378.973,227.458z M378.973,284.539c0,3.822-3.099,6.919-6.919,6.919H249.82
                                                  c-3.82,0-6.919-3.097-6.919-6.919c0-3.822,3.099-6.919,6.919-6.919h122.234C375.874,277.62,378.973,280.717,378.973,284.539z
                                                   M378.973,341.62c0,3.822-3.099,6.919-6.919,6.919H249.82c-3.82,0-6.919-3.097-6.919-6.919c0-3.822,3.099-6.919,6.919-6.919h122.234
                                                  C375.874,334.702,378.973,337.798,378.973,341.62z"></path>
                                        </svg>
                                    </i>
                                    Lanjutkan
                                </div>
                            </div>
                        </div>
                        <label class="modal-backdrop" for="my_modal_7">Close</label>
                    </div>

                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="{{ asset('js/order.js') }}"></script>
        @vite('resources/js/order-plugin.js')
    @endpush
    @push('style')
        <style>
            /* HTML: <div class="loader"></div> */
            .slide_active {
                border: 1px solid #0948f3
            }

            .loader {
                width: 70px;
                aspect-ratio: 1;
                display: grid;
                border: 4px solid #0000;
                border-radius: 50%;
                border-right-color: #0948f3;
                animation: l15 1s infinite linear;
            }

            .loader::before,
            .loader::after {
                content: "";
                grid-area: 1/1;
                margin: 2px;
                border: inherit;
                border-radius: 50%;
                animation: l15 2s infinite;
            }

            .loader::after {
                margin: 8px;
                animation-duration: 3s;
            }

            @keyframes l15 {
                100% {
                    transform: rotate(1turn)
                }
            }
        </style>
    @endpush
</x-guest-layout>
