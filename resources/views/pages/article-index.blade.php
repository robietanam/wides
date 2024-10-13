<x-guest-layout>
    <x-slot name="title">Transaksi</x-slot>
    <div>
        <x-navbar-guest shadowStrength="md" />

        <section class="relative flex flex-col items-center gap-4 lg:mt-20 px-6 py-4 max-md:p-5 justify-center w-full">
            <p class="py-6 px-8 text-4xl font-bold drop-shadow-md text-green-950">
                Artikel Wisata Desa KarangHarjo
            </p>

            <form method="GET" action="{{ route('article.index') }}"
                class="max-w-6xl w-full h-fit flex flex-row rounded-md border border-slate-400 overflow-hidden">
                <svg class="w-5 aspect-square fill-black mx-3" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 488.4 488.4" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path
                                    d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 S381.9,104.65,381.9,203.25z">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>
                <input type="text" name="search" placeholder="Cari Artikel" value="{{ request()->query('search') }}"
                    class="placeholder-slate-400 w-full border-none outline-none" />
                <button type="submit" class="w-24 text-center bg-blue-600 hover:bg-blue-800 text-white font-semibold ">
                    Cari
                </button>
            </form>
            <div class="flex flex-col gap-4 w-full max-w-6xl">
                @if (!empty($articles))
                    @foreach ($articles as $item)
                        <a href="{{ route('article.show-id', $item->id) }}"
                            class="relative overflow-hidden border rounded-md  bg-blue-50 w-full h-72 max-md:h-52 hover:bg-slate-300 hover:cursor-pointer 
                    transition-colors duration-150 ease-in-out border-b border-slate-400 ">
                            <img src="{{ asset('storage/' . $item->thumbnail) ?? 'https://placehold.co/600x400?text=' . urlencode($detail->slug) }}"
                                alt="Gambar {{ $item->slug }}"
                                class="inset-0  absolute h-full w-full object-cover rounded-md">
                            <div
                                class="absolute inset-0  bg-gradient-to-t from-black from-25% inset-ring inset-ring-gray-950/10">
                            </div>
                            <div class="absolute bottom-5 inset-x-5  z-10 ">
                                <div class=" flex flex-col w-full justify-between text-white">
                                    <div class="my-2">
                                        <p class="text-xl lg:text-2xl font-semibold truncate ">
                                            {{ $item->slug }}
                                        </p>
                                        <p class="text-sm  line-clamp-2 ">
                                            {{ substr(tiptap_converter()->asTEXT($item['detailed_description']), 0, 350) }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-between">
                                        <p class="text-xs lg:text-sm">{{ $item->updated_at->diffForHumans() }}</p>
                                        <svg class="mr-2 fill-white w-2 lg:w-3 aspect-square animate-[bounceX_1.5s_ease-in-out_infinite]"
                                            version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330"
                                            xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
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
                        </a>
                    @endforeach
                @else
                    <p class="mx-auto text-center p-2 font-bold rounded-md">Tidak Ada Artikel Lain untuk Saat Ini
                        .......
                    </p>
                @endif
            </div>

            <div class="flex flex-row justify-between  w-full max-w-6xl">
                @if (!$articles->onFirstPage())
                    <a href="{{ $articles->previousPageUrl() }}&search={{ request('search') }}&pageSize={{ request('pageSize') }}"
                        class="flex flex-row w-fit items-center justify-center p-2 rounded-md 
                bg-blue-600 text-white ">
                        <span class="w-5 aspect-square ">
                            <svg viewBox="0 0 24 24" class="fill-white stroke-white" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                        <p>
                            Sebelumnya
                        </p>

                    </a>
                @endif

                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}&search={{ request('search') }}&pageSize={{ request('pageSize') }}"
                        class="flex flex-row w-fit items-center justify-center p-2 rounded-md 
                bg-blue-600 text-white">
                        <p>
                            Selanjutnya
                        </p>
                        <span class="w-5 aspect-square ">
                            <svg viewBox="0 0 24 24" class="fill-white stroke-white" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                @endif
            </div>
        </section>
    </div>
    @push('scripts')
        {{-- <script src="{{ asset('js/jsCalendar.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/jsCalendar.lang.id.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/awcodes/tiptap-editor/components/tiptap.js') }}"></script> --}}
        {{-- @vite('resources/js/tiptap.js') --}}

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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/awcodes/tiptap-editor/tiptap.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin.css') }}"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jsCalendar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jsCalendar.micro.min.css') }}"> --}}
        <style>
            .tiptap-editor .ProseMirror {
                --gray-50: #f9fafb !important;
                --gray-100: #f3f4f6 !important;
                --gray-200: #e5e7eb !important;
                --gray-300: #d1d5db !important;
                --gray-400: #e7e7e7 !important;
                --gray-500: #6b7280 !important;
                --gray-600: #4b5563 !important;
                --gray-700: #4b5563 !important;
                --gray-800: #1f2937 !important;
                --gray-900: #111827 !important;

                --primary-50: #eff6ff !important;
                --primary-100: #dbeafe !important;
                --primary-200: #bfdbfe !important;
                --primary-300: #93c5fd !important;
                --primary-400: #60a5fa !important;
                --primary-500: #3b82f6 !important;
                --primary-600: #2563eb !important;
                --primary-700: #1d4ed8 !important;
                --primary-800: #1e40af !important;
                --primary-900: #1e3a8a !important;
            }

            .tiptap-editor .ProseMirror table td,
            .tiptap-editor .ProseMirror table th {
                border: 1px solid var(--gray-800);
            }

            .tiptap-editor .ProseMirror table th {
                background-color: var(--gray-400);
            }

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
        </style>
    @endpush
</x-guest-layout>
