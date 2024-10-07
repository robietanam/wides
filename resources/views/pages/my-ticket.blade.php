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
                    <template x-for="filter in filters">
                        <button @click="toggleFilter(filter)"
                            :class="activeFilters.includes(filter.toLowerCase()) ? 'bg-primary text-white border-primary' : 'bg-white text-black border-gray-300'"
                            class="py-2 border rounded-lg text-sm px-5 transition-all focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-50 hover:bg-primary hover:text-white">
                            <span x-text="filter"></span>
                        </button>
                    </template>
                </div>

                <!-- Active Filters Display -->
                <template x-if="activeFilters.length > 0">
                    <div class="flex flex-wrap gap-2 items-center mt-2">
                        <span class="text-sm font-light">Active Filters:</span>
                        <template x-for="filter in activeFilters">
                            <div class="flex items-center bg-blue-50 text-blue-600 py-1 px-3 rounded-full text-sm">
                                <span x-text="filter"></span>
                                <button @click="removeFilter(filter)"
                                    class="ml-2 text-xs text-red-600 hover:text-red-800 transition-all"
                                    aria-label="Remove filter">
                                    &times;
                                </button>
                            </div>
                        </template>

                        <!-- Clear All Active Filters Button -->
                        <button @click="clearFilters"
                            class="ml-4 bg-red-50 text-red-600 hover:bg-red-100 py-1 px-3 rounded-full text-sm transition-all">
                            Clear All
                        </button>
                    </div>
                </template>
            </div>

            <div class="text-gray-200 px-4 sm:px- lg:px-0 grid grid-cols-1 md:grid-cols-2 gap-5 max-h-screen">
                <!-- Loading skeleton displayed while tickets are loading -->
                <template x-if="loading">
                    <div
                        class="card bg-base-300 border border-black border-opacity-25 shadow-md h-60 flex flex-col md:flex-row rounded-lg lg:rounded-xl">
                        <div class="flex flex-col gap-4 w-full h-full">
                            <div class="w-full h-1/5 flex justify-between px-4 items-center">
                                <div class="skeleton h-6 w-36 bg-white rounded-none"></div>
                                <div class="skeleton h-6 w-28 bg-white rounded-none"></div>
                            </div>
                            <div class="w-full h-full bg-white px-4 -mt-2 rounded-xl py-5">
                                <div class="skeleton h-8 w-80 rounded-sm"></div>
                                <div class="flex space-x-10">
                                    <div class="flex flex-col space-y-2 mt-10">
                                        <div class="skeleton h-4 w-24 rounded-sm"></div>
                                        <div class="skeleton h-8 w-32 bg-blue-100 rounded-sm"></div>
                                    </div>
                                    <div class="flex flex-col space-y-2 mt-10">
                                        <div class="skeleton h-4 w-24 rounded-sm"></div>
                                        <div class="skeleton h-8 w-32 bg-blue-100 rounded-sm"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Ticket data displayed when loaded -->
                <template x-if="tickets.length === 0 && !loading">
                    <div class="col-span-1 md:col-span-2 text-center p-4 bg-gray-100 rounded-lg">
                        <p class="text-gray-500">Tidak ada tiket yang ditemukan. Silakan tambahkan tiket baru.</p>
                    </div>
                </template>

                <template x-for="ticket in filteredTickets">
                    <div
                        class="card bg-base-300 border border-black border-opacity-25 shadow-md h-60 flex flex-col md:flex-row rounded-lg lg:rounded-xl">
                        <div class="flex flex-col gap-4 w-full h-full">
                            <div class="w-full h-1/5 flex justify-between px-4 items-center">
                                <div class="text-md text-base-dark">
                                    <span class="text-normal"></span>
                                    <span class="text-semibold" x-text="ticket.transaction_code"></span>
                                </div>
                                <div class="text-md font-medium text-base-dark" x-text="ticket.status"></div>
                            </div>
                            <div class="w-full h-full bg-white px-4 -mt-2 rounded-xl py-5">
                                <div class="text-xl font-semibold text-base-dark flex space-x-4 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="ticket"
                                        class="w-8 h-8">
                                        <g>
                                            <path fill="#ff5023"
                                                d="M55.1,17.8,51.29,9.65,41.32,14.3,16.22,26h9.47l13.7-6.39L42.37,26H53.81a5,5,0,0,1,1.29-8.2Z">
                                            </path>
                                            <polygon fill="#c6c5ca" points="39.39 19.61 42.37 26 25.69 26 39.39 19.61">
                                            </polygon>
                                            <path fill="#fbb040"
                                                d="M56,40a5,5,0,0,0,5,5v9H9V45A5,5,0,0,0,9,35V26H61v9A5,5,0,0,0,56,40Z">
                                            </path>
                                            <rect width="22" height="20" x="24" y="30" fill="#c0ab91"></rect>
                                            <path fill="#ff5023"
                                                d="M14,40a4.978,4.978,0,0,1-.45,2.08,4.988,4.988,0,0,0-6.58-2.3l-3.8-8.16L9,28.91V35A5,5,0,0,1,14,40Z">
                                            </path>
                                            <rect width="2" height="4" x="19" y="28" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="19" y="33" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="19" y="38" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="19" y="43" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="19" y="48" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="49" y="28" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="49" y="33" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="49" y="38" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="49" y="43" fill="#231f20"></rect>
                                            <rect width="2" height="4" x="49" y="48" fill="#231f20"></rect>
                                            <path fill="#231f20"
                                                d="M61,36a1,1,0,0,0,1-1V26a1,1,0,0,0-1-1H54.254a3.945,3.945,0,0,1,1.27-6.294,1,1,0,0,0,.482-1.33L52.2,9.227a1,1,0,0,0-1.328-.483L16,25H9a1,1,0,0,0-1,1v2.272L2.749,30.713a1,1,0,0,0-.486,1.329l3.8,8.16a1,1,0,0,0,1.331.484A4,4,0,0,1,12.388,42.1,3.988,3.988,0,0,1,9,44a1,1,0,0,0-1,1v9a1,1,0,0,0,1,1H61a1,1,0,0,0,1-1V45a1,1,0,0,0-1-1,4,4,0,0,1,0-8ZM50.807,10.979l3,6.414a6.012,6.012,0,0,0-2.032,7.48c.021.045.053.083.075.127H43.007L40.3,19.187a1,1,0,0,0-1.329-.483L25.468,25H20.731ZM40.8,25H30.2l8.707-4.061ZM7.49,38.527,4.5,32.1,8,30.478V35a1,1,0,0,0,1,1,3.994,3.994,0,0,1,3.978,3.781A6.042,6.042,0,0,0,7.49,38.527ZM60,45.917V53H10V45.917a6,6,0,0,0,0-11.834V27H60v7.083a6,6,0,0,0,0,11.834Z">
                                            </path>
                                            <path fill="#231f20"
                                                d="M46,29H24a1,1,0,0,0-1,1V50a1,1,0,0,0,1,1H46a1,1,0,0,0,1-1V30A1,1,0,0,0,46,29ZM45,49H25V31H45Z">
                                            </path>
                                            <rect width="2" height="4" x="42.016" y="15.922" fill="#231f20"
                                                transform="rotate(-25.001 43.015 17.922)"></rect>
                                            <rect width="2" height="4" x="44.129" y="20.453" fill="#231f20"
                                                transform="rotate(-24.988 45.13 22.454)"></rect>
                                        </g>
                                    </svg>
                                    <h2>
                                        <span>Paket </span><span x-text="ticket.name"></span>
                                    </h2>
                                </div>
                                <div class="flex space-x-10">
                                    <div class="flex flex-col space-y-2 mt-10">
                                        <h3 class="text-sm font-light">Jumlah Orang</h3>
                                        <h2 class="text-xl font-medium">
                                            <i class="fas fa-users"></i>
                                            <span x-text="ticket.quantity"></span>
                                        </h2>
                                    </div>
                                    <div class="flex flex-col space-y-2 mt-10">
                                        <h3 class="text-sm font-light">Harga</h3>
                                        <div class="flex items-baseline space-x-2 mt-1">
                                            <span x-text="ticket.price"
                                                class="text-xl font-extrabold text-indigo-700"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        function ticketHandler(urlGetData) {
            return {
                tickets: [],
                filters: ['Invoice', 'Complete', 'Refused'],
                activeFilters: [],
                loading: true,

                // Fetch tickets once when initialized
                async fetchTickets() {
                    try {
                        const response = await fetch(urlGetData);
                        const result = await response.json();
                        if (Array.isArray(result.ticketUser)) {
                            this.tickets = result.ticketUser.flatMap(ticketuser =>
                                (ticketuser.transaction_details || []).map(detail =>
                                    detail.tour_package ? {
                                        status: ticketuser.status.toLowerCase(),
                                        name: detail.tour_package.name,
                                        visit_date: ticketuser.visit_date,
                                        price: new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format((detail.price - (detail.price * ticketuser.discount / 100)) * detail.quantity),
                                        transaction_code: ticketuser.transaction_code,
                                        quantity: detail.quantity
                                    } : null
                                ).filter(ticket => ticket !== null)
                            );
                        }
                    } catch (error) {
                        console.error('Error fetching ticket data:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                // Computed property to get filtered tickets
                get filteredTickets() {
                    if (!this.activeFilters.length) return this.tickets;
                    const filterSet = new Set(this.activeFilters.map(filter => filter.toLowerCase()));
                    return this.tickets.filter(ticket => filterSet.has(ticket.status));
                },

                // Toggle filter by adding/removing from activeFilters
                toggleFilter(filter) {
                    const normalizedFilter = filter.toLowerCase();
                    const index = this.activeFilters.indexOf(normalizedFilter);
                    if (index === -1) {
                        this.activeFilters.push(normalizedFilter);
                    } else {
                        this.activeFilters.splice(index, 1);
                    }
                },

                // Remove individual filter
                removeFilter(filter) {
                    this.activeFilters = this.activeFilters.filter(f => f !== filter.toLowerCase());
                },

                // Clear all active filters
                clearFilters() {
                    this.activeFilters = [];
                },

                // Initialization function
                init() {
                    this.fetchTickets();
                }
            };
        }

    </script>

    @endpush
</x-app-layout>
