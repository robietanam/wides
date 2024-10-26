<x-guest-layout>
    <x-slot name="title">Transaksi</x-slot>
    <div>
        <x-navbar-guest shadowStrength="md" />

        <section
            class="max-lg:mt-20 relative flex max-lg:flex-col lg:flex-row gap-4 lg:mt-20 px-6 py-4 max-md:p-5 justify-center w-full bg-white">

            <div class="px-[2rem] py-[1rem] border border-slate-300 rounded-md w-full max-w-[66rem] bg-[#f4f4f4]">
                <div class="tiptap-editor ">
                    <div class="ProseMirror ">
                        <div class="flex flex-col items-center gap-4">
                            <p class="self-start font-semibold text-4xl">{{ $article->slug }}</p>
                            <img src="{{ asset('storage/' . $article->thumbnail) ?? 'https://placehold.co/600x400?text=' . urlencode($article->slug) }}"
                                alt="Gambar {{ $article->slug }}" class="w-fit max-h-[24rem] lg:rounded-lg">
                            <div class="self-start">Dibuat pada : {{ $article->updated_at->diffForHumans() }}</div>
                            <div class="h-0.5 w-full px-2 bg-slate-500"></div>
                            @if (!empty($article->short_descriptions))
                                <div class="border border-slate-300 rounded-md w-full p-4 h-fit bg-white">
                                    <p class="font-semibold text-lg mb-4">Informasi Lainnya</p>
                                    <div class="grid grid-cols-4 gap-4">
                                        @foreach ($article->short_descriptions as $key => $detail)
                                            <p class="col-span-1 max-md:col-span-2">{{ $detail['name'] }} :</p>
                                            <div class="col-span-3 max-md:col-span-2">{!! tiptap_converter()->asHTML($detail['description']) !!}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        {!! tiptap_converter()->asHTML($article->detailed_description) !!}
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-5 max-w-[66rem]">
                <div class="border border-slate-300 rounded-md w-full py-4 h-fit">
                    <p class="font-semibold text-lg pb-4 px-4 border-b border-slate-400 drop-shadow-md">Artikel Lainnya
                    </p>
                    <div class="flex flex-col ">
                        @foreach ($latestArticles as $key => $detail)
                            <a href="{{ route('article.show-id', $detail->id) }}"
                                class="px-3 py-2 bg-slate-200  h-20 max-lg:w-full lg:w-96 hover:bg-slate-300 hover:cursor-pointer transition-colors duration-150 ease-in-out border-b border-slate-300">
                                <div class="relative flex flex-row h-full w-full gap-2">
                                    <img src="{{ asset('storage/' . $detail->thumbnail) ?? 'https://placehold.co/600x400?text=' . urlencode($detail->slug) }}"
                                        alt="Gambar {{ $detail->slug }}" class="w-1/4 h-full object-cover rounded-md">
                                    <div class="flex flex-col w-3/4 justify-between ">
                                        <p class="text-base font-medium line-clamp-2 ">
                                            {{ $detail->slug }}

                                        </p>
                                        <div class="flex flex-row justify-between ">
                                            <p class="text-xs ">{{ $detail->updated_at->diffForHumans() }}</p>
                                            <svg class="mr-2 fill-black w-2 aspect-square animate-[bounceX_1.5s_ease-in-out_infinite]"
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
                            </a>
                        @endforeach
                        <a href="{{ route('article.index') }}"
                            class="border-t border-slate-400 drop-shadow-md pt-2 px-4 ">
                            <div
                                class="mx-auto px-4 py-2 w-fit bg-slate-400 rounded-lg border border-slate-400 font-semibold text-white">
                                Lihat Lainnya
                            </div>
                        </a>
                    </div>
                </div>
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

            .tiptap-editor .ProseMirror p {
                text-align: justify;
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
