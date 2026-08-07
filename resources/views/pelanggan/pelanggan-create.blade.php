<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah pelanggan</title>
</head>
<body>
    <h1>Tambah pelanggan baru</h1>

    <!-- Link untuk kembali ke halaman utama jika batal mengisi -->
    <p><a href="/pelanggan">← Kembali ke daftar pelanggan</a></p>
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

    <form action="/pelanggan/simpan" method="POST">
        @csrf

        <p>
            <label>Nama Pelanggan:</label><br>
            <input type="text" name="nama_pelanggan" required value="{{ old('nama_pelanggan') }}">
        </p>

        <p>
            <label>No HP:</label><br>
            <input type="text" name="no_hp" required value="{{ old('no_hp') }}">
        </p>

        <p>
            <label>Alamat:</label><br>
            <textarea name="alamat" required>{{ old('alamat') }}</textarea>
        </p>

        <button type="submit">Simpan Data Pelanggan</button>
    </form>

</body>
</html>