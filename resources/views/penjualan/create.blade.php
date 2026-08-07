<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi Penjualan</title>
</head>
<body>
    <h1>Form Transaksi Penjualan Baru</h1>

    <p><a href="/penjualan">← Kembali ke daftar penjualan</a></p>
    <hr><br>

    <!-- Tampilkan error validasi jika ada -->
    @if ($errors->any())
        <div style="color: red;">
            <strong>Error!</strong> Terjadi kesalahan input:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/penjualan/simpan" method="POST">
        @csrf

        <p>
            <label>Nomor Nota (Otomatis):</label><br>
            <input type="text" name="nomor_nota" value="{{ $nomorNotaAuto }}" readonly style="background-color: #eee;">
        </p>

        <p>
            <label>Pelanggan (Opsional):</label><br>
            <select name="pelanggan_id">
                <option value="">-- Pembeli Umum / Anonim --</option>
                @foreach($semuaPelanggan as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->no_hp }})
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Subtotal (Rp):</label><br>
            <input type="number" name="subtotal" value="{{ old('subtotal') }}" required min="0">
        </p>

        <p>
            <label>Diskon (Rp):</label><br>
            <input type="number" name="diskon" value="{{ old('diskon', 0) }}" min="0">
        </p>

        <p>
            <label>Pajak (Rp):</label><br>
            <input type="number" name="pajak" value="{{ old('pajak', 0) }}" min="0">
        </p>

        <p>
            <label>Total Wajib Bayar (Rp):</label><br>
            <input type="number" name="total" value="{{ old('total') }}" required min="0">
        </p>

        <p>
            <label>Nominal Pembayaran / Uang Bayar (Rp):</label><br>
            <input type="number" name="bayar" value="{{ old('bayar') }}" required min="0">
        </p>

        <p>
            <label>Metode Pembayaran:</label><br>
            <select name="metode_pembayaran" required>
                <option value="cash">CASH (Tunai)</option>
                <option value="qris">QRIS</option>
                <option value="transfer">Transfer Bank</option>
                <option value="debit">Kartu Debit</option>
            </select>
        </p>

        <button type="submit">Simpan Transaksi Penjualan</button>
    </form>
</body>
</html>