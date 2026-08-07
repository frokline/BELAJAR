<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Supplier</title>
</head>
<body>

    <h1>Manajemen Toko - Data Supplier</h1>

    <!-- Menampilkan notifikasi sukses jika datang dari halaman simpan -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <!-- Tombol/Link untuk menuju ke halaman formulir tambah -->
    <p>
        <a href="/supplier/tambah"><button type="button">Tambah Supplier Baru</button></a>
    </p>

    <br>

    <h3>Data Supplier Terdaftar</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Supplier</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaSupplier as $s)
                <tr>
                    <td>{{ $s->nama_supplier }}</td>
                    <td>{{ $s->no_hp }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>
                        <a href="/supplier/edit/{{ $s->id }}"><button type="button">Edit</button></a>
                        <a href="/supplier/hapus/{{ $s->id }}" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')"><button type="button">Hapus</button></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data supplier. Silakan klik tombol Tambah Supplier di atas!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>