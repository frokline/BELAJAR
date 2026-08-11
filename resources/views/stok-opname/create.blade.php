<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Stok Opname</title>

    <h1>Form Tambah Stok Opname</h1>

    <p><a href="/stok-opname"><button type="button">Kembali ke Daftar Stok Opname</button></a></p>
    <hr><br>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <strong>Error!</strong> Terjadi masalah dengan input Anda:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- PERBAIKAN: Action disesuaikan dengan Route /stok-opname/simpan -->
    <form action="/stok-opname/simpan" method="POST">
        @csrf

        <p>
            <label>Tanggal:</label><br>
            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
        </p>

        <p>
            <label>Pilih Barang yang dicek:</label><br>

            <select name="barang_id" id="barang_id" required>
                <option value="">-- Pilih Barang --</option>

                @foreach($semuaBarang as $barang)
                    <option
                        value="{{ $barang->id }}"
                        data-stok="{{ $barang->stok }}"
                        {{ old('barang_id') == $barang->id ? 'selected' : '' }}>

                        {{ $barang->nama_barang }}
                        (Stok: {{ $barang->stok }})

                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>Stok Sistem (Otomatis):</label><br>

            <input
                type="number"
                name="stok_sistem"
                id="stok_sistem"
                value="{{ old('stok_sistem', 0) }}"
                readonly
                style="background-color: #eee;">
        </p>
        <p>
            <label>Stok fisik saat ini</label><br>
            <input type="number" name="stok_fisik" id="stok_fisik" value="{{ old('stok_fisik', 0) }}" required min="0" placeholder="masukkan jumlah stok fisik saat ini">
        </p>

        <p>
            <label>Keterangan:</label><br>
            <textarea name="keterangan" rows="3" placeholder="Masukkan keterangan jika ada">{{ old('keterangan') }}</textarea>
        </p>

        <button type="submit">Simpan dan sesuaikan stok barang</button>
    </form>

    <!--script sederhana untuk menampilkan stok sistem terkini saat barang di pilih-->
    <script>
        document.getElementById('barang_id').addEventListener('change', function () {

            const selectedOption = this.options[this.selectedIndex];

            const stokSistem =
                selectedOption.getAttribute('data-stok') || 0;

            document.getElementById('stok_sistem').value = stokSistem;
        });
    </script>
</head>
</html>