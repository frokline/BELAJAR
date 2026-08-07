<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>daftar pelanggan</title>
</head>
<body>
    <h1>Manajemen toko - daftar pelanggan</h1>

    <!-- Menampilkan notifikasi sukses jika datang dari halaman simpan -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <!-- Tombol/Link untuk menuju ke halaman formulir tambah -->
    <p>
        <a href="/pelanggan/tambah"><button type="button">Tambah Pelanggan Baru</button></a>
    </p>    
    <br>

    <h3>Data pelanggan terdaftar</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaPelanggan as $p)
                <tr>
                    <td>{{ $p->nama_pelanggan }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <a href="/pelanggan/edit/{{ $p->id }}"><button type="button">Edit</button></a>
                        <a href="/pelanggan/hapus/{{ $p->id }}" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')"><button type="button">Hapus</button></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data pelanggan. Silakan klik tombol Tambah Pelanggan di atas!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>