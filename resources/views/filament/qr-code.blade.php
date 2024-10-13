{{-- resources/views/qr-code.blade.php --}}
<div class="flex flex-col items-center">
    <!-- Display QR Code -->
    {{ $slug }}
</div>

<!-- Optional: Style customization -->
<style>
    .qr-code-image img {
        width: 256px;
        height: 256px;
    }
</style>
