<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tiket Saya') }}
        </h2>
    </x-slot>

    <div class="py-2 bg-white" x-data="ticketHandler('{{ route('myticket.data') }}')">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col space-y-4 my-3 px-4">
                <!-- Filter Options -->
                <div class="flex flex-wrap gap-2 items-center">
                    <a href="{{ url()->current() }}?filter=invoice"
                        class="py-2 border rounded-lg text-sm px-5 transition-all focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-50 hover:bg-primary hover:text-white
                        {{ request()->query('filter') == 'invoice'
                            ? 'bg-primary text-white border-primary'
                            : 'bg-white text-black border-gray-300' }}
                        ">
                        <span> Invoice </span>
                    </a>
                    <a href="{{ url()->current() }}?filter=completed"
                        class="py-2 border rounded-lg text-sm px-5 transition-all focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-50 hover:bg-primary hover:text-white
                        {{ request()->query('filter') == 'completed'
                            ? 'bg-primary text-white border-primary'
                            : 'bg-white text-black border-gray-300' }}
                        ">
                        <span> Berhasil </span>
                    </a>
                    <a href="{{ url()->current() }}?filter=semua"
                        :class="{{ request()->query('filter') == 'semua' || request()->query('filter') == null }} ?
                            'bg-primary text-white border-primary' :
                            'bg-white text-black border-gray-300'"
                        class="py-2 border rounded-lg text-sm px-5 transition-all focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-50 hover:bg-primary hover:text-white">
                        <span> Semua </span>
                    </a>
                </div>
            </div>

            <div class="text-gray-200 px-4 sm:px- lg:px-0 grid grid-cols-1 md:grid-cols-2 gap-5 max-h-screen">
                @if ($transaction->isEmpty())
                    <p class="mt-10">Tidak ada transaksi untuk saat ini.</p>
                @else
                    @foreach ($transaction as $tct)
                        <div class="border border-slate-400 rounded-lg bg-white shadow-md p-4 md:grid md:grid-cols-2 
                                max-md:place-content-start 
                                hover:bg-slate-200 hover:cursor-pointer transition-colors duration-100 ease-in-out
                            "
                            x-on:click="window.location='/transaksi/{{ $tct->transaction_code }}';">
                            <div class="grid md:grid-rows-4">
                                <p class="px-3 py-1 bg-blue-300 w-fit rounded-md self-center max-md:text-sm">
                                    {{ $tct->transaction_code }}</p>
                                <p class="text-3xl max-md:text-2xl max-md:my-2 font-semibold md:row-span-2 self-center">
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
                                <div class="flex flex-row items-center justify-end px-2 gap-2 max-md:text-xs">
                                    <p class="max-md:hidden">Lihat selengkapnya</p>
                                    <svg class="fill-black w-3 aspect-square animate-[bounceX_1s_ease-in-out_infinite]"
                                        version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330"
                                        xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
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
                @endif
            </div>
        </div>
    </div>

    @push('style')
        <style>
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
    @push('scripts')
        <script>
            function ticketHandler(urlGetData) {
                return {
                    tickets: [],
                    loading: true,

                };
            }
        </script>
    @endpush
</x-app-layout>
