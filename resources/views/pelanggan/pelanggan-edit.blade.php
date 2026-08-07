<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit pelanggan</title>
</head>
<body>
    <h1>Edit Data pelanggan</h1>

    <p><a href="/pelanggan">← Kembali ke daftar pelanggan</a></p>
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

    {{-- Arahkan ke rute update dengan ID pelanggan --}}
    <form action="/pelanggan/update/{{ $pelanggan->id }}" method="POST">
        @csrf

        <p>
            <label>Nama pelanggan:</label><br>
            {{-- Tampilkan data lama dari database --}}
            <input type="text" name="nama_pelanggan" required value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
        </p>

        <p>
            <label>Alamat:</label><br>
            <input type="text" name="alamat" required value="{{ old('alamat', $pelanggan->alamat) }}">
        </p>

        <p>
            <label>No. Telepon:</label><br>
            <input type="integer" name="no_hp" required value="{{ old('no_hp', $pelanggan->no_hp) }}">
        </p>

        <button type="submit">Update Data pelanggan</button>
    </form>
    
</body>
</html>