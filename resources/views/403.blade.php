<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h1>403 Akses Ditolak (Forbidden)</h1>
        @isset($message)
            <p>{{ $message }}</p>
        @else
            <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        @endisset
        <a href="/">Kembali ke Beranda</a>
    </div>
</body>
</html>