<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penjualan</title>
</head>
<body>
    <h1>Manajemen Toko - Daftar Penjualan</h1>

    <!-- Notifikasi sukses -->
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    <p>
        <a href="/penjualan/tambah"><button type="button">Tambah Transaksi Penjualan Baru</button></a>
    </p>    
    <br>

    <h3>Riwayat Transaksi Penjualan</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No. Nota</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Belanja</th>
                <th>Metode Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaPenjualan as $p)
                <tr>
                    <td>{{ $p->nomor_nota }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->pelanggan ? $p->pelanggan->nama_pelanggan : 'Umum / Anonim' }}</td>
                    <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                    <td>{{ strtoupper($p->metode_pembayaran) }}</td>
                    <td><b>{{ strtoupper($p->status) }}</b></td>
                    <td>
                        <a href="/penjualan/{{ $p->id }}">Lihat Nota</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data transaksi penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>