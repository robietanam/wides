@props([
    'name',
    'show' => false,
    'backgroundColor' => 'bg-white',
    'maxWidth' => '2xl',
    'redirectRoute' => null // Tambahkan props untuk route tujuan setelah modal ditutup
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div x-data="modalComponent({
    show: @js($show),
    name: '{{ $name }}',
    redirectRoute: '{{ $redirectRoute }}' // Berikan route yang di-passing ke props
})" x-init="init()" x-show="show" x-on:open-modal.window="openModal($event.detail)"
    x-on:close-modal.window="closeModal($event.detail)" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="close()"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-50 backdrop-blur-sm"></div>
    </div>

    <div x-show="show" class="mb-6 {{ $backgroundColor }} rounded-lg overflow-hidden shadow-xl transform transition-all
       sm:w-full {{ $maxWidth }}
       sm:mx-auto absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
       {{ $show ? 'block' : 'hidden' }}" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-50"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:scale-50">
        {{ $slot }}
    </div>
</div>


@push('scripts')
<script>
    function modalComponent({ show, name, redirectRoute }) {
            return {
                show: show,
                name: name,
                redirectRoute: redirectRoute,

                init() {
                    this.$watch('show', value => {
                        if (value) {
                            document.body.classList.add('overflow-y-hidden');
                            this.focusFirstElement();
                        } else {
                            document.body.classList.remove('overflow-y-hidden');
                            // Cek apakah ada route redirect yang di-passing, lalu redirect
                            if (this.redirectRoute) {
                                window.location.href = this.redirectRoute;
                            }
                        }
                    });
                },

                openModal(modalName) {
                    if (modalName === this.name) {
                        this.show = true;
                    }
                },

                closeModal(modalName) {
                    if (modalName === this.name) {
                        this.show = false;
                    }
                },

                close() {
                    this.show = false;
                },

                focusFirstElement() {
                    const focusable = this.getFocusableElements();
                    if (focusable.length) {
                        setTimeout(() => focusable[0].focus(), 100);
                    }
                },

                getFocusableElements() {
                    return [...this.$el.querySelectorAll('a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"])')]
                        .filter(el => !el.hasAttribute('disabled'));
                }
            };
        }
</script>
@endpush
