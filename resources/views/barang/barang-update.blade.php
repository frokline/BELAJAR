<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>

    <h1>Edit Data Barang</h1>

    <!-- Link kembali -->
    <p><a href="/barang">← Kembali ke daftar barang</a></p>
    <hr><br>

    {{-- Menampilkan semua error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <strong>Error!</strong> Terjadi masalah dengan input Anda.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/barang/update/{{ $barang->id }}" method="POST">
        @csrf

        <p>
            <label>Supplier:</label><br>

            <select name="id_supplier" required>

                @foreach ($semuaSupplier as $supplier)

                    <option
                        value="{{ $supplier->id }}"
                        {{ $supplier->id == $barang->id_supplier ? 'selected' : '' }}>

                        {{ $supplier->nama_supplier }}

                    </option>

                @endforeach

            </select>

        </p>

        <p>
            <label>Kategori barang:</label><br>

            <select name="kategori_barang_id" required>

                @foreach ($semuaKategori as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        {{ $kategori->id == $barang->kategori_barang_id ? 'selected' : '' }}>

                        {{ $kategori->nama_kategori }}

                    </option>

                @endforeach

            </select>

        <p>
            <label>Nama Barang:</label><br>

            <input
                type="text"
                name="nama_barang"
                value="{{ old('nama_barang', $barang->nama_barang) }}"
                required>

        </p>

        <p>
            <label>Harga Jual:</label><br>

            <input
                type="number"
                name="harga_jual"
                value="{{ old('harga_jual', $barang->harga_jual) }}"
                required>

        </p>

        <p>
            <label>Stok:</label><br>

            <input
                type="number"
                name="stok"
                value="{{ old('stok', $barang->stok) }}"
                required>

        </p>

        <button type="submit">Update Data Barang</button>

    </form>

</body>
</html>