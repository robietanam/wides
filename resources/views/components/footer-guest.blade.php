@props(['siteInfo'])
<footer class="bg-[#0a369d] pt-8 pb-6 px-4 lg:px-20">

    <div class="flex justify-between flex-col lg:flex-row gap-3 lg:gap-0 text-white text-sm">
        <div>
            <div class="max-w-72">
                <p class="font-semibold">Wisata Desa Karangharjo</p>
                <p>{{ $siteInfo->address }}</p>
            </div>
            <div class="mt-3">
                <p class="font-semibold">Telepon</p>
                <p>
                    {{ $siteInfo->phone_number ?? ' - ' }}</p>
            </div>
        </div>
        <div>
            <p class="font-semibold">Jam Berkunjung</p>
            <p>Senin ‒ Kamis: 09.00 ‒ 15.00</p>
            <p>Jumat: 14.00 ‒ 16.00</p>
            <p>Sabtu ‒ Minggu: 09.00 ‒ 12.00</p>
        </div>
        <div class="flex flex-col">
            <a href="/" class="lg:text-right font-semibold">Beranda</a>
            <a href="/artikel" class="lg:text-right font-semibold">Artikel</a>
            <a href="/#galeri" class="lg:text-right font-semibold">Dokumentasi</a>
            <a href="/#services" class="lg:text-right font-semibold">Beli Tiket</a>
        </div>
    </div>
    <div class="flex gap-4 justify-center mt-4">
        @if (isset($siteInfo->contact_person))
            <a href="https://wa.me/+62{{ $siteInfo->contact_person }}">
                <div class="p-4 bg-white rounded-full ">
                    <i
                        class="fa-brands fa-whatsapp flex w-1 h-1 lg:w-2 lg:h-2 text-[#0a369d] justify-center items-center"></i>
                </div>
            </a>
        @endif
        @if (isset($siteInfo->facebook))
            <a :href="'https://facebook.com/' + '{{ $siteInfo->facebook }}'">
                <div class="p-4 bg-white rounded-full ">
                    <i
                        class="fa-brands fa-facebook flex w-1 h-1 lg:w-2 lg:h-2 text-[#0a369d] justify-center items-center"></i>
                </div>
            </a>
        @endif
        @if (isset($siteInfo->instagram))
            <a :href="'https://instagram.com/' + '{{ $siteInfo->instagram }}'">
                <div class="p-4 bg-white rounded-full ">
                    <i
                        class="fa-brands fa-instagram flex w-1 h-1 lg:w-2 lg:h-2 text-[#0a369d] justify-center items-center"></i>
                </div>
            </a>
        @endif
    </div>
    <div class="h-px bg-white my-6"></div>
    <div class="flex justify-center text-white text-xs">
        <p>Copyright © 2024, Wisata Desa Karangharjo, Fakultas Ilmu Komputer Universitas Jember.</p>
    </div>
</footer>
