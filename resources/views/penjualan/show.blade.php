<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Nota - {{ $penjualan->nomor_nota }}</title>
</head>
<body>
    <h1>Detail Nota Penjualan</h1>
    <p><a href="/penjualan">← Kembali ke daftar penjualan</a></p>
    <hr><br>

    <table border="0" cellpadding="5">
        <tr>
            <td><b>Nomor Nota</b></td>
            <td>: {{ $penjualan->nomor_nota }}</td>
        </tr>
        <tr>
            <td><b>Tanggal Transaksi</b></td>
            <td>: {{ $penjualan->tanggal }}</td>
        </tr>
        <tr>
            <td><b>Pelanggan</b></td>
            <td>: {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum / Anonim' }}</td>
        </tr>
        <tr>
            <td><b>Metode Bayar</b></td>
            <td>: {{ strtoupper($penjualan->metode_pembayaran) }}</td>
        </tr>
        <tr>
            <td><b>Status</b></td>
            <td>: {{ strtoupper($penjualan->status) }}</td>
        </tr>
    </table>

    <br>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Subtotal</th>
            <td>Rp {{ number_format($penjualan->subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Diskon</th>
            <td>Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Pajak</th>
            <td>Rp {{ number_format($penjualan->pajak, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Tagihan</th>
            <td><b>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</b></td>
        </tr>
        <tr>
            <th>Uang Dibayar</th>
            <td>Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Kembalian</th>
            <td>Rp {{ number_format($penjualan->kembali, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>