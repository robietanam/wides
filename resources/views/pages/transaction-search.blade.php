<x-guest-layout>
    <x-slot name="title">Transaksi</x-slot>
    <div>
        <x-navbar-guest shadowStrength="md" />

        <section class="relative z-10 lg:mt-20 ">
            <div x-data="transactionApp()" class="w-full max-w-7xl md:px-5 lg:px-6 mx-auto relative z-10">
                <div class="p-5 mb-10">
                    <p class="text-[3rem] font-semibold">Cari Transaksi</p>
                    <p>Cari transaksi dengan cara memasukkan nomor invoice dibawah ini.</p>
                    <div class="p-4 mt-4 border border-slate-300 rounded-md w-full">
                        <p>Masukkan Nomor Transaksi</p>
                        <div class="flex flex-row items-center gap-3">
                            <input type="text" x-model="noInvoice" placeholder="VSXXXXXXXXXXX"
                                class="min-w-[24rem] max-sm:min-w-[14rem] rounded-lg" />
                            <button x-on:click="window.location='/transaksi/' + noInvoice;"
                                class=" px-3 py-2 bg-blue-600 rounded-md fill-white font-semibold hover:cursor-pointer hover:bg-white hover:fill-black border border-slate-400">
                                <svg class="w-6 aspect-square  " version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 488.4 488.4" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6
                                                    s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2
                                                    S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7
                                                    S381.9,104.65,381.9,203.25z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class=" mt-4 flex flex-row items-center justify-center">
                        <div class="h-0.5 w-full px-20 bg-slate-300"> </div>
                        <p class="px-5">Atau</p>
                        <div class="h-0.5 w-full px-20 bg-slate-300 "> </div>
                    </div>
                    <p>Cari dengan No Telepon yang digunakan untuk memesan.</p>
                    <div class="p-4 mt-4 border border-slate-300 rounded-md w-full">
                        <p>Masukkan Nomor Telepon</p>
                        <form action="{{ route('transaction.search') }}" method="GET"
                            class="flex flex-row items-center gap-3">
                            <input type="text" name="noTelp" x-model="noTelp" placeholder="08XXXXXXXXXX"
                                class="min-w-[24rem] max-sm:min-w-[14rem] rounded-lg" />
                            <button type="submit"
                                class="px-3 py-2  bg-blue-600 rounded-md fill-white font-semibold hover:cursor-pointer hover:bg-white hover:fill-black border border-slate-400 ">
                                <svg class="w-6 aspect-square  " version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 488.4 488.4" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6
                                                    s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2
                                                    S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7
                                                    S381.9,104.65,381.9,203.25z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <p class="mt-8 text-2xl font-semibold">List Pesanan</p>
                    <div class="p-4 mt-2 border border-slate-300 rounded-md w-full">
                        @if ($transaction->isEmpty())
                            <p>Tidak ada transaksi yang ditemukan</p>
                        @else
                            <div class="flex flex-col gap-2">
                                @foreach ($transaction as $tct)
                                    <div class="border border-slate-400 rounded-lg bg-white shadow-md p-4 md:grid md:grid-cols-2 
                                            max-md:place-content-start 
                                            hover:bg-slate-200 hover:cursor-pointer transition-colors duration-100 ease-in-out
                                        "
                                        x-on:click="window.location='/transaksi/{{ $tct->transaction_code }}';">
                                        <div class="grid md:grid-rows-4">
                                            <p
                                                class="px-3 py-1 bg-blue-300 w-fit rounded-md self-center max-md:text-sm">
                                                {{ $tct->transaction_code }}</p>
                                            <p
                                                class="text-3xl max-md:text-2xl max-md:my-2 font-semibold md:row-span-2 self-center">
                                                Paket
                                                {{ $tct->package_name }}
                                            </p>
                                            <p class="max-md:text-xs">Tanggal kunjungan : <span> {{ $tct->visit_date }}
                                                </span> </p>
                                        </div>
                                        <div
                                            class="md:grid md:grid-rows-4 max-md:flex max-md:flex-row max-md:grid-cols-2 max-md:my-1 place-content-end max-md:place-content-between ">
                                            <p class=" text-sm self-start max-md:hidden">Dibuat pada :
                                                {{ $tct->transaction_date }}
                                            </p>
                                            <p
                                                class="md:row-span-2 max-md:text-xs max-md:p-2 px-5 py-2 self-center text-lg rounded-md w-fit {{ $tct->statusInfo['class'] }}">
                                                {{ $tct->statusInfo['message'] }}</p>
                                            <div
                                                class="flex flex-row items-center justify-end px-2 gap-2 max-md:text-xs">
                                                <p class="max-md:hidden">Lihat selengkapnya</p>
                                                <svg class="fill-black w-3 aspect-square animate-[bounceX_1s_ease-in-out_infinite]"
                                                    version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330"
                                                    xml:space="preserve">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path id="XMLID_222_"
                                                            d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001 c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213 C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606 C255,161.018,253.42,157.202,250.606,154.389z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <form action="{{ request()->url() }}" method="GET"
                                class="flex items-center justify-center mt-4">
                                <input type="hidden" name="noTelp" value="{{ request()->input('noTelp') }}">
                                <input type="hidden" name="pageSize"
                                    value="{{ request()->input('pageSize', 10) + 10 }}">
                                <button type="submit"
                                    class="py-2 px-6 bg-blue-600 rounded-md text-white font-semibold">Muat lebih
                                    banyak</button>
                            </form>
                        @endif
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
                    noInvoice: '',
                    noTelp: '',
                }
            }
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
                color: #533c00;
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
