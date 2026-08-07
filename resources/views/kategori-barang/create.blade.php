<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah kategori baru</h1>

    <!-- Link untuk kembali ke halaman utama jika batal mengisi -->
    <p><a href="/kategori-barang">Kembali</a></p>
    <hr><br>

    {{-- Tampilkan semua error validasi jika ada --}}
    @if ($errors->any())
        <div style="color: red;">
            <strong>Error!</strong> Terjadi masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/kategori-barang/simpan" method="POST">
        @csrf

        <p>
            <label>Nama Kategori:</label><br>
            <input type="text" name="nama_kategori" required value="{{ old('nama_kategori') }}">
        </p>

        <button type="submit">Simpan Data Kategori</button>
    </form>
    
</body>
</html>