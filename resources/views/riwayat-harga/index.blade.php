<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Harga Barang</title>
</head>
<body>
    <h1>Riwayat Perubahan Harga Barang</h1>

    <p><a href="/barang">← Kembali ke Data Barang</a></p>
    <br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga Beli Lama</th>
                <th>Harga Beli Baru</th>
                <th>Harga Jual Lama</th>
                <th>Harga Jual Baru</th>
                <th>Tanggal Perubahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaRiwayat as $index => $riwayat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ optional($riwayat->barang)->nama_barang ?? 'Barang Terhapus' }}</b></td>
                    <td>Rp {{ number_format($riwayat->harga_beli_lamaa ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($riwayat->harga_beli_baru ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($riwayat->harga_jual_lama ?? 0, 0, ',', '.') }}</td>
                    <td><b>Rp {{ number_format($riwayat->harga_jual_baru ?? 0, 0, ',', '.') }}</b></td>
                    <td>{{ optional($riwayat->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Belum ada riwayat perubahan harga barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>