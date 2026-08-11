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
            <td>: {{ optional($penjualan->pelanggan)->nama_pelanggan ?? 'Umum / Anonim' }}</td>
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
    <h3>Rincian Item Barang</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualan->detailBarangKeluars as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ optional($detail->barang)->nama_barang ?? 'Barang Terhapus' }}</td>
                    <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah_keluar }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada item barang pada nota ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <h3>Ringkasan Pembayaran</h3>
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
            <td>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>