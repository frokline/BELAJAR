<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Barang Masuk</title>
</head>
<body>
    <h1>Form Input Barang Masuk</h1>

    <a href="/barang-masuk"><button type="button">Kembali ke Daftar Barang Masuk</button></a>

    <br><br>

    <!-- Menampilkan pesan error validasi jika ada input yang salah -->
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- PERBAIKAN: Action disesuaikan dengan Route /barang-masuk/simpan -->
    <form action="/barang-masuk/simpan" method="POST">
        @csrf
        
        <label for="tanggal_masuk">Tanggal Masuk:</label>
        <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ date('Y-m-d') }}" required><br><br>

        <!-- PERBAIKAN: name disesuaikan jadi id_barang -->
        <label for="id_barang">Nama Barang:</label>
        <select id="id_barang" name="id_barang" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($semuaBarang as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
            @endforeach
        </select><br><br>

        <!-- PERBAIKAN: Menambahkan Pilihan Supplier -->
        <label for="id_supplier">Supplier:</label>
        <select id="id_supplier" name="id_supplier" required>
            <option value="">-- Pilih Supplier --</option>
            @foreach($semuaSupplier as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
            @endforeach
        </select><br><br>

        <label for="jumlah_masuk">Jumlah Masuk:</label>
        <input type="number" id="jumlah_masuk" name="jumlah_masuk" min="1" required><br><br>

        <label for="harga_beli">Harga Beli (Modal):</label>
        <input type="number" id="harga_beli" name="harga_beli" min="0" required><br><br>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan"></textarea><br><br>

        <button type="submit">Simpan & Tambah Stok</button>
    </form>
</body>
</html>