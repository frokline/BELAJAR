<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
</head>
<body>

    <h1>Tambah Supplier Baru</h1>
    
    <!-- Link untuk kembali ke halaman utama jika batal mengisi -->
    <p><a href="/supplier">← Kembali ke Daftar Supplier</a></p>
    <hr><br>

    <form action="/supplier/simpan" method="POST">
        @csrf
        
        <p>
            <label>Nama Supplier:</label><br>
            <input type="text" name="nama_supplier" required>
        </p>

        <p>
            <label>No HP:</label><br>
            <input type="text" name="no_hp" required>
        </p>

        <p>
            <label>Email (Opsional):</label><br>
            <input type="email" name="email">
        </p>

        <p>
            <label>Alamat:</label><br>
            <input type="text" name="alamat" required>
        </p>
        
        <button type="submit">Simpan Data Supplier</button>
    </form>

</body>
</html>