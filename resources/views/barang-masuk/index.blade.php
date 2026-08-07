<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Masuk</title>
</head>
<body>
    <h1>Manajemen Toko - Daftar Barang Masuk</h1>

    <!-- Menampilkan notifikasi sukses -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <p>
        <a href="/barang-masuk/tambah"><button type="button">Tambah Barang Masuk</button></a>
    </p>

    <br>

    <h3>Data Barang Masuk Terdaftar</h3>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal Masuk</th>
                <th>Nama Barang</th>
                <th>Supplier</th>
                <th>Jumlah Masuk</th>
                <th>Harga Beli (Modal)</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaBarangMasuk as $index => $masuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $masuk->tanggal_masuk }}</td>
                    <td>{{ $masuk->barang->nama_barang ?? '-' }}</td>
                    <!-- PERBAIKAN: Panggil langsung relasi supplier milik BarangMasuk -->
                    <td>{{ $masuk->supplier->nama_supplier ?? '-' }}</td>
                    <td><b>+{{ $masuk->jumlah_masuk }}</b></td>
                    <!-- PERBAIKAN: Menggunakan fungsi number_format bawaan PHP -->
                    <td>Rp {{ number_format($masuk->harga_beli, 0, ',', '.') }}</td>
                    <td>{{ $masuk->keterangan ?? '-' }}</td>

                    <td>
                        <a href="/barang-masuk/edit/{{ $masuk->id }}">
                            <button type="button">Edit</button>
                        </a>
                        <a href="/barang-masuk/hapus/{{ $masuk->id }}" onclick="return confirm('Yakin ingin menghapus data ini? Stok barang akan dikurangi kembali!')">
                            <button type="button">Hapus</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data barang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>