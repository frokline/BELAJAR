<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar barang</title>
</head>
<body>
    <h1>Manajemen toko - daftar barang</h1>

    <!-- Menampilkan notifikasi sukses jika datang dari halaman simpan -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <!-- Tombol/Link untuk menuju ke halaman formulir tambah -->
    <p>
        <a href="/barang/tambah"><button type="button">Tambah Barang Baru</button></a>
    </p>

    <br>

    <h3>Data barang terdaftar</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Supplier</th> <!-- TAMBAHAN: Kepala kolom supplier -->
                <th>Nama Barang</th>
                <th>Kategori</th> <!-- TAMBAHAN: Kepala kolom kategori -->
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaBarang as $b)
                <tr>
                    <!-- TAMBAHAN: Sementara kita tampilkan ID Supplier-nya dulu untuk memastikan data masuk -->
                    <td>ID: {{ $b->id_supplier }}</td> 
                    <td>{{ $b->nama_barang }}</td>
                    <td>ID: {{ $b->kategori_barang_id}}</td> <!-- TAMBAHAN: Sementara kita tampilkan ID Kategori-nya dulu -->
                    <td>{{ $b->harga_jual }}</td>
                    <td>{{ $b->stok }}</td>

                    <td>
                        <a href="/barang/edit/{{ $b->id }}"><button type="button">Edit</button></a>
                        <a href="/barang/hapus/{{ $b->id }}" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><button type="button">Hapus</button></a>
                    </td>
                </tr>   
            @empty
                <tr>
                    <!-- Diubah jadi colspan="4" karena jumlah kolom bertambah menjadi 4 -->
                    <td colspan="6">Belum ada data barang. Silakan klik tombol Tambah Barang di atas!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
