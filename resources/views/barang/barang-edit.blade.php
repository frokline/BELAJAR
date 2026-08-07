<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Data Barang</h1>

    <p><a href="/barang">← Kembali ke daftar barang</a></p>
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

    {{-- Arahkan ke rute update dengan ID barang --}}
    <form action="/barang/update/{{ $barang->id }}" method="POST">
        @csrf

        <p>
            <label>Supplier:</label><br>
            <select name="id_supplier" required>
                <option value="" disabled>-- Pilih Supplier --</option>
                @foreach ($semuaSupplier as $supplier)
                    {{-- Beri 'selected' jika ID supplier sama dengan ID supplier milik barang --}}
                    <option value="{{ $supplier->id }}" @if($barang->id_supplier == $supplier->id) selected @endif>
                        {{ $supplier->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Kategori barang:</label><br>
            <select name="kategori_barang_id" required>
                <option value="" disabled>-- Pilih Kategori --</option>
                @foreach ($semuaKategori as $kategori)
                    {{-- Beri 'selected' jika ID kategori sama dengan ID kategori milik barang --}}
                    <option value="{{ $kategori->id }}" @if($barang->kategori_barang_id == $kategori->id) selected @endif>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>

        <p>
            <label>Nama Barang:</label><br>
            {{-- Tampilkan data lama dari database --}}
            <input type="text" name="nama_barang" required value="{{ old('nama_barang', $barang->nama_barang) }}">
        </p>

        <p>
            <label>Harga Jual:</label><br>
            <input type="number" name="harga_jual" step="0.01" required value="{{ old('harga_jual', $barang->harga_jual) }}">
        </p>

        <p>
            <label>Stok:</label><br>
            <input type="number" name="stok" required value="{{ old('stok', $barang->stok) }}">
        </p>

        <button type="submit">Update Data Barang</button>
    </form>

</body>
</html>
