<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penjualan</title>
</head>
<body>
    <h1>Daftar Transaksi Penjualan</h1>

    @if(session('sukses'))
        <p style="color: green;"><strong>{{ session('sukses') }}</strong></p>
    @endif

    <p><a href="/penjualan/tambah"><button type="button">Tambah Penjualan Baru</button></a></p>
    <br>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Nota</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Rincian Barang</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaPenjualan as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ $penjualan->nomor_nota }}</b></td>
                    <td>{{ $penjualan->tanggal }}</td>
                    <td>{{ optional($penjualan->pelanggan)->nama_pelanggan ?? 'Umum / Anonim' }}</td>
                    <td>
                        @if($penjualan->detailBarangKeluars && $penjualan->detailBarangKeluars->count() > 0)
                            <ul style="margin: 0; padding-left: 15px;">
                                @foreach($penjualan->detailBarangKeluars as $detail)
                                    <li>
                                        {{ optional($detail->barang)->nama_barang ?? 'Barang Terhapus' }} 
                                        ({{ $detail->jumlah_keluar }} pcs)
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <i>Tidak ada item</i>
                        @endif
                    </td>
                    <td>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
                    <td><b>{{ strtoupper($penjualan->status) }}</b></td>
                    <td>
                        <a href="/penjualan/{{ $penjualan->id }}">Lihat</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Belum ada data penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>