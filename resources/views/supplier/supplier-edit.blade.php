<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Supplier</title>
</head>
<body>
    <h1>Edit Data Supplier</h1>

    <p><a href="/supplier">← Kembali ke daftar supplier</a></p>
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

    {{-- Arahkan ke rute update dengan ID supplier --}}
    <form action="/supplier/update/{{ $supplier->id }}" method="POST">
        @csrf

        <p>
            <label>Nama Supplier:</label><br>
            {{-- Tampilkan data lama dari database --}}
            <input type="text" name="nama_supplier" required value="{{ old('nama_supplier', $supplier->nama_supplier) }}">
        </p>

        <p>
            <label>No. Telepon:</label><br>
            <input type="integer" name="no_hp" required value="{{ old('no_hp', $supplier->no_hp) }}">
        </p>

        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required value="{{ old('email', $supplier->email) }}">
        </p>
        
        <p>
            <label>Alamat:</label><br>
            <input type="text" name="alamat" required value="{{ old('alamat', $supplier->alamat) }}">
        </p>

        <button type="submit">Update Data Supplier</button>
    </form>
    
</body>
</html>