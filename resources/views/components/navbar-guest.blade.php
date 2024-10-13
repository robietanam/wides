@props([
    'navbarAlwaysVisible' => false,
    'shadowStrength' => 'xs',
    'visibleNavbarMobile' => true,
])

<header x-data="navbar({{ json_encode($navbarAlwaysVisible) }}, {{ json_encode($visibleNavbarMobile) }}, {{ json_encode($shadowStrength) }})" x-init="init()" x-bind:class="navbarClasses"
    class="fixed lg:px-20 top-0 left-0 right-0 z-50 flex flex-col justify-between transition-all duration-300 ease-in-out">
    @if ($navbarAlwaysVisible)
        <div class="hidden lg:block bg-base-light text-base-dark animate-fadeInDown z-10 w-full">
        @else
            <div :class="{ 'bg-base-light text-base-dark': mobileMenuOpen }" class="animate-fadeInDown z-10 w-full">
    @endif
    <div class="flex flex-wrap items-center justify-between py-3 animate-fadeInDown pl-2">
        <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
            @if ($visibleNavbarMobile)
                <a href="/#" class="text-2xl font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap">
                    Wideskarangharjo.
                </a>
                <button @click="toggleMobileMenu"
                    class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </button>
            @else
                <a href="/#"
                    class="hidden text-2xl font-bold leading-relaxed lg:inline-block mr-4 py-2 whitespace-nowrap">
                    Wideskarangharjo.
                </a>
            @endif
        </div>
        <nav :class="navClasses"
            class="lg:flex flex-grow items-center max-w-full justify-center lg:transition-none animate-fadeInUp"
            id="collapse-navbar">
            <ul class="flex flex-col items-center mt-2 lg:space-x-4 lg:flex-row list-none lg:m-auto">
                <li class="nav-item">
                    <a :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                        class="px-3 py-2 font-medium text-sm leading-snug" href="/">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                        class="px-3 py-2 font-medium text-sm leading-snug" href="/#layanan">
                        Beli Tiket
                    </a>
                </li>
                <li class="nav-item">
                    <a :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                        class="px-3 py-2 font-medium text-sm leading-snug" href="/artikel">
                        Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                        class="px-3 py-2 font-medium text-sm leading-snug" href="/transaksi">
                        Transaksi
                    </a>
                </li>
                <li class="nav-item lg:hidden">
                    @if (auth()->check())
                        <button type="button"
                            :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                            class="btn btn-ghost rounded-full"
                            @click="window.location.href = '{{ route('myticket.show') }}'">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user"></i>
                                <p class="text-sm font-semibold">Tiket saya</p>
                            </div>
                        </button>
                    @else
                        <div>
                            <button @click="window.location.href = '{{ route('login') }}'"
                                class="rounded-md bg-transparent py-2 px-4 text-center font-semibold text-sm transition-all hover:shadow-md focus:bg-blue-300 focus:shadow-none active:bg-blue-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Masuk
                            </button>
                            <button @click="window.location.href = '{{ route('register') }}'"
                                class="rounded-md bg-[#0a369d] py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg hover:bg-blue-600 focus:bg-blue-700 focus:shadow-none active:bg-blue-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Daftar
                            </button>
                        </div>
                    @endif
                </li>
            </ul>
            <div class="lg:flex flex-row list-none gap-3 hidden">
                @if (auth()->check())
                    <li class="mx-auto">
                        <button type="button"
                            :class="{ 'hover:opacity-75': !alwaysVisible, 'text-base-dark': alwaysVisible }"
                            class="btn btn-ghost rounded-full"
                            @click="window.location.href = '{{ route('myticket.show') }}'">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user"></i>
                                <p class="text-sm font-semibold">Tiket saya</p>
                            </div>
                        </button>
                    </li>
                @else
                    <li>
                        <button @click="window.location.href = '{{ route('login') }}'"
                            class="rounded-md bg-transparent py-2 px-4 text-center font-semibold text-sm transition-all hover:shadow-md focus:bg-blue-300 focus:shadow-none active:bg-blue-400 active:shadow-none hover:border border-opacity-10 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Masuk
                        </button>
                        <button @click="window.location.href = '{{ route('register') }}'"
                            class="rounded-md bg-[#0a369d] py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg hover:bg-blue-600 focus:bg-blue-700 focus:shadow-none active:bg-blue-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Daftar
                        </button>
                    </li>
                @endif
            </div>
        </nav>
    </div>
    </div>
</header>
<!-- Navbar End -->

@push('scripts')
    <script>
        function navbar(alwaysVisible, visibleNavbarMobile, shadowStrength) {
            return {
                navbarOpen: true,
                alwaysVisible: alwaysVisible,
                visibleNavbarMobile: visibleNavbarMobile,
                mobileMenuOpen: false,
                lastScrollY: 0,
                isHero: true,
                shadowStrength: shadowStrength,

                init() {
                    if (!alwaysVisible) {
                        const hero = document.getElementById("hero");

                        if (hero) {
                            new IntersectionObserver(
                                ([entry]) => {
                                    this.isHero = entry.isIntersecting;
                                }, {
                                    threshold: [0, 0.1]
                                }
                            ).observe(hero);
                        }

                        window.addEventListener("scroll", () => {
                            const {
                                scrollY
                            } = window;
                            const threshold = 5;

                            if (Math.abs(scrollY - this.lastScrollY) > threshold) {
                                this.navbarOpen = scrollY <= this.lastScrollY;
                            }

                            this.lastScrollY = scrollY;
                            this.mobileMenuOpen = false;
                        });
                    }
                },

                toggleMobileMenu() {
                    this.mobileMenuOpen = !this.mobileMenuOpen;
                },

                get navbarClasses() {
                    return "bg-base-light text-base-dark shadow-md"
                },

                get navClasses() {
                    return {
                        "flex bg-base-light text-base-dark": this.mobileMenuOpen,
                        hidden: !this.mobileMenuOpen,
                    };
                },
            };
        }
    </script>
@endpush
