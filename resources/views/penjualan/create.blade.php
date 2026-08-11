<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penjualan Baru</title>
</head>
<body>
    <h1>Form Transaksi Penjualan Baru</h1>

    <p><a href="/penjualan">← Kembali ke Daftar Penjualan</a></p>
    <hr><br>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div style="color: red;">
            <strong>Error!</strong> Terjadi masalah dengan input Anda:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endif

    <form action="/penjualan/simpan" method="POST">
        @csrf

        <h3>1. Informasi Nota & Pelanggan</h3>
        <p>
            <label>Nomor Nota (Otomatis):</label><br>
            <input type="text" name="nomor_nota" value="{{ $nomorNotaAuto }}" readonly style="background-color: #eee;">
        </p>

        <p>
            <label>Pilih Pelanggan:</label><br>
            <select name="id_pelanggan" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($semuaPelanggan as $p)
                    <option value="{{ $p->id }}" {{ old('id_pelanggan') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_pelanggan }} 
                    </option>
                @endforeach
            </select>
        </p>

        <hr>
        <h3>2. Item Barang yang Dibeli</h3>
        <p><i>Silakan pilih barang dan tentukan jumlahnya:</i></p>

        {{-- Item Barang Pertama --}}
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;" class="baris-barang">
            <p>
                <label>Pilih Barang #1:</label><br>
                <select name="items[0][barang_id]" class="pilih-barang" required>
                    <option value="" data-harga="0">-- Pilih Barang --</option>
                    @foreach($semuaBarang as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}">
                            {{ $b->kode_barang }} - {{ $b->nama_barang }} ( Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </p>

            <p>
                <label>Jumlah Beli:</label><br>
                <input type="number" name="items[0][jumlah]" class="jumlah-barang" value="1" min="1" required>
            </p>
        </div>

        {{-- Item Barang Kedua (Opsional) --}}
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;" class="baris-barang">
            <p>
                <label>Pilih Barang #2 (Opsional):</label><br>
                <select name="items[1][barang_id]" class="pilih-barang">
                    <option value="" data-harga="0">-- Pilih Barang (Kosongkan jika tidak ada) --</option>
                    @foreach($semuaBarang as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}">
                            {{ $b->kode_barang }} - {{ $b->nama_barang }} (Harga: Rp {{ number_format($b->harga_jual, 0, ',', '.') }} | Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </p>

            <p>
                <label>Jumlah Beli:</label><br>
                <input type="number" name="items[1][jumlah]" class="jumlah-barang" value="" min="1">
            </p>
        </div>

        <hr>
        <h3>3. Perhitungan Pembayaran</h3>
        <p>
            <label>Subtotal (Rp):</label><br>
            <input type="number" id="subtotal" name="subtotal" value="0" readonly style="background-color: #eee;">
        </p>

        {{-- Diskon & Pajak di-set 0 (Hidden) --}}
        <input type="hidden" id="diskon" name="diskon" value="0">
        <input type="hidden" id="pajak" name="pajak" value="0">

        <p>
            <label>Total Belanja (Rp):</label><br>
            <input type="number" id="total" name="total" value="0" readonly style="background-color: #eee; font-weight: bold;">
        </p>

        <p>
            <label>Uang Bayar (Rp):</label><br>
            <input type="number" id="bayar" name="bayar" value="{{ old('bayar') }}" required placeholder="Contoh: 100000">
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

        <br>
        <button type="submit">Simpan Transaksi & Detail Barang</button>
    </form>

    {{-- Script Hitung Otomatis --}}
    <script>
        function hitungOtomatis() {
            let totalSubtotal = 0;
            const semuaBaris = document.querySelectorAll('.baris-barang');
            
            semuaBaris.forEach(function(baris) {
                const selectBarang = baris.querySelector('.pilih-barang');
                const inputJumlah = baris.querySelector('.jumlah-barang');
                
                const optionTerpilih = selectBarang.options[selectBarang.selectedIndex];
                const harga = parseFloat(optionTerpilih.getAttribute('data-harga')) || 0;
                const jumlah = parseInt(inputJumlah.value) || 0;
                
                totalSubtotal += (harga * jumlah);
            });

            document.getElementById('subtotal').value = totalSubtotal;
            document.getElementById('total').value = totalSubtotal;
        }

        document.querySelectorAll('.pilih-barang, .jumlah-barang').forEach(function(element) {
            element.addEventListener('change', hitungOtomatis);
            element.addEventListener('keyup', hitungOtomatis);
        });
    </script>
</body>
</html>