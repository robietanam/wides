<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Tidak Ditemukan</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">Transaksi Tidak Ditemukan</h1>
        <p class="text-gray-600 mt-4">Transaksi yang anda cari tidak ada.</p>
        <a href="/transaksi" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500">
            Kembali ke Transaksi
        </a>
    </div>
</body>

</html>
