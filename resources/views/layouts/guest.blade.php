<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="corporate">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico">
    <title>
        @if (isset($title))
            {{ $title }}
        @endif
        | {{ config('app.name') }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <!-- SEO -->
    <meta name="description"
        content="Jelajahi keindahan alam dan wisata edukasi di Desa Karangharjo, Jember. Temukan pesona alam, budaya lokal, dan destinasi wisata menarik lainnya.">
    <meta name="keywords"
        content="wisata karangharjo, wisata jember, wisata alam, wisata edukasi, desa wisata, tempat wisata, objek wisata, karangharjo jember, jember, indonesia">

    <!-- Open Graph Protocol -->
    <meta property="og:title" content="Wisata Desa Karangharjo Jember - Pesona Alam & Edukasi" />
    <meta property="og:description"
        content="Jelajahi keindahan alam dan wisata edukasi di Desa Karangharjo, Jember. Temukan pesona alam, budaya lokal, dan destinasi wisata menarik lainnya." />
    <meta property="og:image" content="https://www.contohwebsite.com/gambar-menarik.jpg" />
    <meta property="og:url" content="https://www.contohwebsite.com/" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wisata Desa Karangharjo Jember - Pesona Alam & Edukasi">
    <meta name="twitter:description"
        content="Jelajahi keindahan alam dan wisata edukasi di Desa Karangharjo, Jember. Temukan pesona alam, budaya lokal, dan destinasi wisata menarik lainnya.">
    <meta name="twitter:image" content="https://www.contohwebsite.com/gambar-menarik.jpg">
    @stack('style')
    <!-- Scripts -->
    @vite(['resources/css/guest.css', 'resources/js/guest.js'])
</head>

<body x-data="{ loading: true, isDarkmode: false }" x-init="window.onload = () => loading = false" :class="{ 'overflow-hidden': loading }"
    class="font-sans text-gray-900 antialiased dark:text-base-dark dark:bg-base-dark">

    <!-- Elemen Loading -->
    <div x-show="loading" class="flex justify-center items-center h-screen w-screen">
        <span class="loading loading-ring loading-lg text-gray-900"></span>
    </div>
    <div>
        {{ $slot }}
    </div>

    @stack('scripts')
</body>



</html>
