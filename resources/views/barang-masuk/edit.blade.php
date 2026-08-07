<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Data Barang Masuk</h1>
    <!-- Form untuk mengedit data barang masuk -->
    <p><a href="/barang-masuk">← Kembali ke daftar Barang Masuk</a></p>
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

    @php
        // Ambil semua data barang dan supplier untuk dropdown
        $semuaBarang = \App\Models\Barang::all();
        $semuaSupplier = \App\Models\Supplier::all();
    @endphp

    {{-- Arahkan ke rute update dengan ID barang masuk --}}
    <form action="/barang-masuk/update/{{ $barangMasuk->id }}" method="POST">
        @csrf

        <p>
            <label>Tanggal Masuk:</label><br>
            {{-- Tampilkan data lama dari database --}}
            <input type="date" name="tanggal_masuk" required value="{{ old('tanggal_masuk', $barangMasuk->tanggal_masuk) }}">
        </p>

        <p>
            <label>Nama Barang:</label><br>
            <select name="id_barang" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($semuaBarang as $barang)
                    <option value="{{ $barang->id }}" {{ old('id_barang', $barangMasuk->id_barang) == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Supplier:</label><br>
            <select name="id_supplier" required>
                <option value="">-- Pilih Supplier --</option>
                @foreach($semuaSupplier as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('id_supplier', $barangMasuk->id_supplier) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Jumlah Masuk:</label><br>
            <input type="number" name="jumlah_masuk" min="1" required value="{{ old('jumlah_masuk', $barangMasuk->jumlah_masuk) }}">
        </p>
        
        <p>
            <label>Harga Beli (Modal):</label><br>
            <input type="number" name="harga_beli" min="0" required value="{{ old('harga_beli', $barangMasuk->harga_beli) }}">
        </p>

        <p>
            <label>Keterangan:</label><br>
            <textarea name="keterangan">{{ old('keterangan', $barangMasuk->keterangan) }}</textarea>
        </p>

        <button type="submit">Update Data Barang Masuk</button>
    </form>
</body>
</html>