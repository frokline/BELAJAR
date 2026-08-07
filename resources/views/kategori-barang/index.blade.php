<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori Barang</title>
</head>
<body>
    <h1>Manajemen Toko - Kategori Barang</h1>

    <!-- Menampilkan notifikasi sukses jika datang dari halaman simpan -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <!-- Tombol/Link untuk menuju ke halaman formulir tambah -->
    <p>
        <a href="/kategori-barang/tambah"><button type="button">Tambah Kategori Baru</button></a>
    </p>    
    <br>

    <h3>Data Kategori Barang terdaftar</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaKategori as $k)
                <tr>
                    <td>{{ $k->nama_kategori }}</td>
                    <td>
                        <a href="/kategori-barang/edit/{{ $k->id }}"><button type="button">Edit</button></a>
                        <a href="/kategori-barang/hapus/{{ $k->id }}" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"><button type="button">Hapus</button></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Belum ada data kategori. Silakan klik tombol Tambah Kategori di atas!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>