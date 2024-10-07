@props(['name', 'image', 'price', 'description', 'features', 'isLoggedIn'])
<div
    class="carousel-item relative flex aspect-[9/12] w-96 shrink-0 snap-start flex-col justify-end overflow-hidden rounded-3xl shadow-lg">
    <img data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" src="{{ $image }}" alt="Package Image"
        class="absolute inset-0 h-full w-full object-cover" />
    <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-black from-25% inset-ring inset-ring-gray-950/10">
    </div>
    <figure class="relative p-10">
        <figcaption class="mb-4 border-b border-white/20 pb-4">
            <p
                class="bg-gradient-to-r from-[#fff1be] from-28% via-[#ee87cb] via-70% to-[#b060ff] bg-clip-text text-lg font-bold text-transparent">
                {{ $name }}</p>
        </figcaption>
        <blockquote class="relative text-sm/7 text-white before:absolute before:-ml-5 before:translate-x-full">
            {{ $description }}
        </blockquote>
        <div class="card-actions mt-5 z-50">
            <button x-data="{
                isLoggedIn: true,
                {{--  @json(auth()->check()), --}}
                handleClick() {
                    if (this.isLoggedIn) {
                        window.location.href = '/order/{{ $name }}';
                    } else {
                        $dispatch('open-modal', 'auth');
                    }
                }
            }" x-on:click.prevent="handleClick" type="button"
                class="text-white hover:underline transition-all duration-200 text-sm">
                Selengkapnya
            </button>
        </div>
    </figure>
</div>
