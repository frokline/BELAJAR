<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit kategori</title>
</head>
<body>
    <h1>Edit Data kategori</h1>

    <p><a href="/kategori-barang">← Kembali ke daftar kategori</a></p>
    <hr><br>

    {{-- Tampilkan semua error validasi jika ada --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Arahkan ke rute update dengan ID kategori --}}
    <form action="/kategori-barang/update/{{ $kategoriBarang->id }}" method="POST">
        @csrf

        <p>
            <label>Nama kategori:</label><br>
            {{-- Tampilkan data lama dari database --}}
            <input type="text" name="nama_kategori" required value="{{ old('nama_kategori', $kategoriBarang->nama_kategori) }}">
        </p>

        <button type="submit">Update Data kategori</button>
    </form>
</body>
</html>