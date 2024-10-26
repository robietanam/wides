<x-guest-layout>
    <x-slot name="title">Transaksi</x-slot>
    <div>
        <x-navbar-guest :navbarAlwaysVisible="true" shadowStrength="md" />

        <section class="relative z-10 lg:mt-20 ">
            <div x-data="transactionApp('{{ $payment->account_number ?? 0 }}', '{{ $transaction->transaction_code }}')" class="w-full max-w-7xl md:px-5 lg:px-6 mx-auto relative z-10">
                <div class="grid grid-cols-12 ">
                    <h3
                        class="col-span-12 xl:col-span-8 font-bold text-2xl mt-5 py-2 lg:pr-8 
                        w-full max-xl:max-w-3xl max-xl:mx-auto text-black hidden lg:block">
                        Pemesanan Tiket Wisata</h3>
                    <h3
                        class="col-span-12 xl:col-span-4 font-bold text-2xl mt-5 py-2 lg:pr-8 
                    w-full max-xl:max-w-3xl max-xl:mx-auto text-black hidden lg:block">
                        Detail Pemesanan</h3>
                    <div class="col-span-12 xl:col-span-8 md:pb-5 lg:pr-8 pb-5 w-full max-xl:max-w-3xl max-xl:mx-auto max-md:p-3"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full">
                        <div
                            class="container border border-slate-600 border-opacity-30 bg-white md:shadow-md rounded-md p-5 max-md:p-0">
                            <div>
                                <div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent sm:block  lg:hidden">
                                    <div class="flex-none">
                                        <button @click="history.back()"
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
                                <div class="flex flex-col md:flex-row">
                                    <div class="sticky top-0 md:static lg:w-10/12 lg:h-1/2 lg:rounded-lg z-0">
                                        <img src="{{ asset('storage/' . $tourPackage->images->first()?->image_url) ?? 'https://placehold.co/600x400?text=' . urlencode($tourPackage->name) }}"
                                            alt="Gambar {{ $tourPackage->name }}" class="w-full h-auto lg:rounded-lg">
                                    </div>
                                    <div class="px-4 bg-white rounded-t-xl py-5 -mt-5 z-10">
                                        <h3 class="font-bold text-green-500 text-sm">Paket Pilihan Anda</h3>
                                        <h3 class="font-semibold text-xl mb-2">Paket Wisata {{ $tourPackage->name }}
                                        </h3>
                                        <p class="text-gray-500 text-sm mb-3">{{ $tourPackage->description }}</p>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 xl:col-span-4 lg:pr-8 pb-8 w-full max-xl:max-w-3xl max-xl:mx-auto max-md:p-3 ">

                        <h3 class="font-bold text-2xl leading-10 text-black pb-2 xl:hidden ">
                            Detail Pemesanan</h3>
                        <div
                            class="container border border-slate-600 border-opacity-30  bg-white md:shadow-md rounded-md p-5">
                            <div class="flex flex-col items-center justify-between mb-2 gap-3 max-md:text-xs">
                                <div class="flex flex-col w-full gap-1">
                                    <p class="text-sm font-bold">Nama Pemesan</p>
                                    <p class=" truncate px-3 py-1 bg-blue-50 rounded-lg">
                                        {{ $transaction->name }}
                                    </p>
                                </div>
                                <div class="flex flex-col w-full gap-1">
                                    <p class="text-sm font-bold">Email</p>
                                    <p class=" truncate px-3 py-1 bg-blue-50 rounded-lg">
                                        {{ $transaction->email }}
                                    </p>
                                </div>
                                <div class="flex flex-col w-full gap-1">
                                    <p class="text-sm font-bold">No Telp.</p>
                                    <p class=" truncate px-3 py-1 bg-blue-50 rounded-lg">
                                        {{ $transaction->noTelp }}
                                    </p>
                                </div>
                                <div class="flex flex-col w-full gap-2">
                                    <p class="text-sm font-bold">Tanggal kunjungan</p>
                                    <p class="" id="tanggal_kunjungan"></p>
                                    {{-- <div id="my-calendar" class="micro-theme" data-language="id"
                                        data-month-format="month YYYY">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 mb-10 md:py-1 lg:pr-8 pb-8  w-full max-xl:max-w-3xl max-xl:mx-auto max-md:p-3">
                        <h3 class="font-bold text-2xl leading-10 text-black pb-5 hidden md:block">
                            Detail Transaksi</h3>
                        <div
                            class="container border border-slate-600 border-opacity-30 bg-white md:shadow-md rounded-md p-5">
                            <div class=" mb-2 grid grid-cols-2 gap-2 max-md:text-xs max-md:grid-cols-3">
                                <p class="self-center">Nomor Transaksi</p>
                                <div class="flex gap-2 item-center max-md:col-span-2 justify-self-end">
                                    <p class="self-center">{{ $transaction->transaction_code }}</p>
                                    <div class="p-2 bg-white rounded-lg hover:fill-white hover:bg-slate-500 hover:cursor-pointer"
                                        @click="copyTran">
                                        <svg class="w-4 h-fit " version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 210.107 210.107"
                                            xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M168.506,0H80.235C67.413,0,56.981,10.432,56.981,23.254v2.854h-15.38
                                                        c-12.822,0-23.254,10.432-23.254,23.254v137.492c0,12.822,10.432,23.254,23.254,23.254h88.271
                                                        c12.822,0,23.253-10.432,23.253-23.254V184h15.38c12.822,0,23.254-10.432,23.254-23.254V23.254C191.76,10.432,181.328,0,168.506,0z
                                                        M138.126,186.854c0,4.551-3.703,8.254-8.253,8.254H41.601c-4.551,0-8.254-3.703-8.254-8.254V49.361
                                                        c0-4.551,3.703-8.254,8.254-8.254h88.271c4.551,0,8.253,3.703,8.253,8.254V186.854z M176.76,160.746
                                                        c0,4.551-3.703,8.254-8.254,8.254h-15.38V49.361c0-12.822-10.432-23.254-23.253-23.254H71.981v-2.854
                                                        c0-4.551,3.703-8.254,8.254-8.254h88.271c4.551,0,8.254,3.703,8.254,8.254V160.746z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <p x-show="noTranI" class="text-sm self-center text-green-600">Tercopy
                                    </p>
                                </div>
                                <p class="self-center">Status</p>
                                <p
                                    class="{{ $statusInfo['class'] }} w-fit px-3 py-1 rounded-lg font-bold max-md:col-span-2 justify-self-end">
                                    {{ $statusInfo['message'] }}
                                </p>

                                <p>Dibuat pada</p>
                                <p class=" max-md:col-span-2 justify-self-end"> {{ $transaction->transaction_date }}
                                </p>
                                <div class="h-0.5 w-full px-5 bg-slate-200 col-span-2  max-md:col-span-3"></div>
                                <p class="col-span-2">Rincian Pembayaran</p>
                                <div
                                    class="col-span-2  max-md:col-span-3 grid grid-cols-2 gap-2 bg-blue-50 rounded-lg p-4">
                                    <p>Harga (x{{ $transaction->quantity }} Tiket)</p>
                                    <p class="text-end">
                                        {{ 'Rp ' . number_format($transaction->price, 0, ',', '.') }}</p>
                                    <p>Diskon (-{{ $transaction->discount }}%)</p>
                                    <p class="text-end">
                                        {{ 'Rp ' . number_format(($transaction->discount / 100) * $transaction->price, 0, ',', '.') }}
                                    </p>
                                    <div class="grid grid-cols-2 border-t col-span-2 py-2">
                                        <p>Total Pembayaran</p>
                                        <p class="text-green-500 font-semibold text-lg text-end">
                                            {{ 'Rp ' . number_format(($transaction->price - ($transaction->discount / 100) * $transaction->price) * $transaction->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="h-0.5 w-full px-5 bg-slate-200 col-span-2  max-md:col-span-3"></div>
                                @if ($transaction->status == 'pending')
                                    <div class="col-span-2 max-md:col-span-3">
                                        <p class="text-lg my-3">Metode Pembayaran ({{ $transaction->payment_method }})
                                        </p>
                                        @if (!empty($payment))
                                            <p>Silahkan Transfer Ke {{ $payment->type }} Berikut : </p>
                                        @endif
                                        <div class="grid grid-cols-2 gap-5">
                                            @if (!empty($payment) && $transaction->payment_method !== 'Bayar Ditempat')
                                                <div class="bg-blue-100 p-4 rounded-lg flex flex-col gap-1 h-fit">
                                                    <p class="text-base"> {{ $payment->payment_name }} </p>
                                                    <div class="flex gap-2 item-center">
                                                        <p class="text-xl font-extrabold self-center">
                                                            {{ $payment->account_number }} </p>
                                                        <div class="p-2 bg-white rounded-lg hover:fill-white hover:bg-slate-500 hover:cursor-pointer"
                                                            @click="copyNo">
                                                            <svg class="w-4 h-fit " version="1.1" id="Capa_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 210.107 210.107" xml:space="preserve">
                                                                <g>
                                                                    <path
                                                                        d="M168.506,0H80.235C67.413,0,56.981,10.432,56.981,23.254v2.854h-15.38
                                                            c-12.822,0-23.254,10.432-23.254,23.254v137.492c0,12.822,10.432,23.254,23.254,23.254h88.271
                                                            c12.822,0,23.253-10.432,23.253-23.254V184h15.38c12.822,0,23.254-10.432,23.254-23.254V23.254C191.76,10.432,181.328,0,168.506,0z
                                                            M138.126,186.854c0,4.551-3.703,8.254-8.253,8.254H41.601c-4.551,0-8.254-3.703-8.254-8.254V49.361
                                                            c0-4.551,3.703-8.254,8.254-8.254h88.271c4.551,0,8.253,3.703,8.253,8.254V186.854z M176.76,160.746
                                                            c0,4.551-3.703,8.254-8.254,8.254h-15.38V49.361c0-12.822-10.432-23.254-23.253-23.254H71.981v-2.854
                                                            c0-4.551,3.703-8.254,8.254-8.254h88.271c4.551,0,8.254,3.703,8.254,8.254V160.746z" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <p x-show="noAccI" class="text-sm self-center text-green-600">
                                                            Tercopy
                                                        </p>
                                                    </div>
                                                    <p>A/n {{ $payment->account_holder }} </p>
                                                </div>
                                            @elseif($transaction->payment_method === 'Bayar Ditempat')
                                                <div
                                                    class="bg-blue-100 p-4 max-md:p-2 max-md:rounded-md rounded-lg flex flex-col gap-1 h-fit">
                                                    <p class="max-md:text-xs text-sm font-semibold">Terima kasih sudah
                                                        memesan,</p>
                                                    <p class="max-md:text-xs text-sm">Silahkan hubungi kontak kami
                                                        untuk melanjutkan.
                                                    </p>
                                                </div>
                                            @else
                                                <div
                                                    class="bg-red-400 p-4 max-md:p-2 max-md:rounded-md rounded-lg flex flex-col gap-1 h-fit">
                                                    <p class="max-md:text-xs text-sm font-semibold"> Mohon Maaf,</p>
                                                    <p class="max-md:text-xs text-sm">Metode pembayaran ini sudah tidak
                                                        didukung.</p>
                                                </div>
                                            @endif

                                            <div class="">
                                                @if ($contact)
                                                    <p class="pb-2">
                                                        Kontak yang bisa dihubungi</p>
                                                    <div>
                                                        <div onclick="window.open('https://api.whatsapp.com/send?phone=62{{ $contact }}&text=Nomor Pesanan : {{ $transaction->transaction_code }} \n','mywindow');"
                                                            class="group flex flex-row gap-2 py-2 px-3 rounded-md bg-green-400 w-fit shadow-lg border border-slate-300
                                                        hover:bg-white hover:cursor-pointer">
                                                            <svg class="w-4 aspect-square group-hover:fill-green-600 fill-white"
                                                                version="1.1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 308 308" xml:space="preserve">
                                                                <g id="XMLID_468_">
                                                                    <path id="XMLID_469_"
                                                                        d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156
                                                                        c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687
                                                                        c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887
                                                                        c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153
                                                                        c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348
                                                                        c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802
                                                                        c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922
                                                                        c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0
                                                                        c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458
                                                                        C233.168,179.508,230.845,178.393,227.904,176.981z" />
                                                                    <path id="XMLID_470_"
                                                                        d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716
                                                                        c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396
                                                                        c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z
                                                                        M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188
                                                                        l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677
                                                                        c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867
                                                                        C276.546,215.678,222.799,268.994,156.734,268.994z" />
                                                                </g>
                                                            </svg>
                                                            <p class="group-hover:text-green-600 text-white">
                                                                {{ $contact }}
                                                        </div>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>


                                        </div>

                                    </div>
                                @else
                                    <div class="p-3 col-span-2 max-md:col-span-3">
                                        <p class="pb-2">
                                            Kontak yang bisa dihubungi</p>

                                        <div class="flex flex-col gap-2">
                                            @if (isset($contact))
                                                <div>
                                                    <div onclick="window.open('https://api.whatsapp.com/send?phone=62{{ $contact }}&text=Nomor Pesanan : {{ $transaction->transaction_code }} \n','mywindow');"
                                                        class="group flex flex-row gap-2 py-2 px-5 rounded-md bg-green-400 w-fit shadow-lg border border-slate-300
                                            hover:bg-white hover:cursor-pointer">
                                                        <svg class="w-4 aspect-square group-hover:fill-green-600 fill-white"
                                                            version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 308 308" xml:space="preserve">
                                                            <g id="XMLID_468_">
                                                                <path id="XMLID_469_" d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156
                                                            c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687
                                                            c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887
                                                            c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153
                                                            c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348
                                                            c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802
                                                            c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922
                                                            c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0
                                                            c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458
                                                            C233.168,179.508,230.845,178.393,227.904,176.981z" />
                                                                <path id="XMLID_470_" d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716
                                                            c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396
                                                            c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z
                                                            M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188
                                                            l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677
                                                            c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867
                                                            C276.546,215.678,222.799,268.994,156.734,268.994z" />
                                                            </g>
                                                        </svg>
                                                        <p class="group-hover:text-green-600 text-white">
                                                            {{ $contact }}
                                                    </div>
                                                    </p>
                                            @endif
                                        </div>

                                    </div>
                            </div>
                            @endif
                            <div @click="window.print()"
                                class="col-span-2  max-md:col-span-3 mt-5 px-5 py-2 bg-yellow-400 rounded-md  text-black font-semibold text-center border border-slate-300 shadow-md
                                hover:text-yellow-400 hover:bg-white hover:cursor-pointer">
                                <p>Cetak Invoice</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    @push('scripts')
        {{-- <script src="{{ asset('js/jsCalendar.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/jsCalendar.lang.id.js') }}"></script> --}}
        @vite('resources/js/transaction.js')

        <script type="text/javascript">
            function transactionApp(noAcc, noTran) {
                return {
                    noAcc: noAcc,
                    noAccI: false,
                    noTran: noTran,
                    noTranI: false,
                    copyNo() {
                        navigator.clipboard.writeText(this.noAcc)
                        this.noAccI = true
                        setTimeout(() => {
                            this.noAccI = false
                        }, 4000);
                    },
                    copyTran() {
                        navigator.clipboard.writeText(this.noTran)
                        this.noTranI = true
                        setTimeout(() => {
                            this.noTranI = false
                        }, 4000);
                    }
                }
            }
            window.addEventListener('DOMContentLoaded', function() {
                // var myCalendar = document.getElementById("my-calendar");
                // var myCalendar = jsCalendar.new(myCalendar);
                const formattedDate = new Date("{{ $transaction->transaction_date }}");
                // myCalendar.set(formattedDate.toLocaleDateString('en-GB'))
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const tanggal = document.getElementById("tanggal_kunjungan");
                tanggal.innerHTML = formattedDate.toLocaleDateString('id-ID', options)
            });
        </script>
    @endpush
    @push('style')
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jsCalendar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jsCalendar.micro.min.css') }}"> --}}
        <style>
            /* HTML: <div class="loader"></div> */
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

            /* Define custom status styles */
            .status-pending {
                color: #fbbf24;
                /* Text color: Tailwind's yellow-600 */
                background-color: #fefcbf;
                /* Background color: Tailwind's yellow-300 */
            }

            .status-processing {
                color: #3b82f6;
                /* Text color: Tailwind's blue-600 */
                background-color: #bfdbfe;
                /* Background color: Tailwind's blue-300 */
            }

            .status-invoice {
                color: #4b5563;
                /* Text color: Tailwind's gray-600 */
                background-color: #e5e7eb;
                /* Background color: Tailwind's gray-300 */
            }

            .status-completed {
                color: #16a34a;
                /* Text color: Tailwind's green-600 */
                background-color: #bbf7d0;
                /* Background color: Tailwind's green-300 */
            }

            .status-rejected {
                color: #dc2626;
                /* Text color: Tailwind's red-600 */
                background-color: #fee2e2;
                /* Background color: Tailwind's red-300 */
            }

            .status-refunded {
                color: #7e22ce;
                /* Text color: Tailwind's purple-600 */
                background-color: #e0e7ff;
                /* Background color: Tailwind's purple-300 */
            }
        </style>
    @endpush
</x-guest-layout>
