<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah barang</title>
</head>
<body>
    <h1>Tambah barang baru</h1>

    <!-- Link untuk kembali ke halaman utama jika batal mengisi -->
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

    <form action="/barang/simpan" method="POST">
        @csrf

        <p>
            <label>Supplier:</label><br>
            <select name="id_supplier" required>
                <option value="" disabled selected>-- Pilih Supplier --</option>
                @foreach ($semuaSupplier as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Kategori barang:</label><br>
            <select name="kategori_barang_id" required>
                <option value="" disabled selected>-- Pilih Kategori --</option>
                @foreach ($semuaKategori as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" required value="{{ old('nama_barang') }}">
        </p>

        <p>
            <label>Harga Jual:</label><br>
            <input type="number" name="harga_jual" step="0.01" required value="{{ old('harga_jual') }}">
        </p>

        <p>
            <label>Stok:</label><br>
            <input type="number" name="stok" required value="{{ old('stok') }}">
        </p>

        <button type="submit">Simpan Data Barang</button>
    </form>

</body>
</html>