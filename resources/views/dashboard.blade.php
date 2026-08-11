<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama - Aplikasi Kasir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 15px;
        }
        h1 {
            color: #333;
        }
        .user-info {
            text-align: right;
        }
        .user-info p {
            margin: 5px 0;
            color: #666;
        }
        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }
        .logout-btn:hover {
            background-color: #da190b;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .menu-section {
            margin-bottom: 30px;
        }
        .menu-section h3 {
            color: #4CAF50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .menu-list {
            list-style: none;
        }
        .menu-list li {
            margin-bottom: 12px;
        }
        .menu-list a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .menu-list a:hover {
            background-color: #45a049;
        }
        .menu-list .count {
            color: #666;
            margin-left: 10px;
            font-size: 14px;
        }
        .menu-list .primary {
            background-color: #2196F3;
        }
        .menu-list .primary:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Dashboard Aplikasi Kasir</h1>
            </div>
            <div class="user-info">
                <p><strong>{{ optional(Auth::user())->name ?? 'User' }}</strong></p>
                <p>(Role: {{ strtoupper(optional(Auth::user())->role ?? 'GUEST') }})</p>
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>

        @if(session('sukses'))
            <div class="success-message">
                {{ session('sukses') }}
            </div>
        @endif

        <div class="menu-section">
            <h3>📊 Menu Navigasi Utama:</h3>
            <ul class="menu-list">
                <li>
                    <a href="/barang">Master Data Barang</a>
                    <span class="count">(Total: {{ $totalBarang }} barang)</span>
                </li>
                <li>
                    <a href="/penjualan">Daftar Transaksi Penjualan</a>
                    <span class="count">(Total: {{ $totalPenjualan }} transaksi)</span>
                </li>
                <li>
                    <a href="/penjualan/tambah" class="primary">+ Tambah Penjualan Baru (POS Kasir)</a>
                </li>
                <li>
                    <a href="/stok-opname">Stok Opname (Penyesuaian Fisik)</a>
                </li>
                <li>
                    <a href="/riwayat-harga">Riwayat Perubahan Harga</a>
                </li>
                <li>
                    <a href="/audit-log">Audit Logs (CCTV System)</a>
                </li>
            </ul>
        </div>

        <div class="menu-section">
            <h3>⚙️ Pengaturan:</h3>
            <ul class="menu-list">
                <li>
                    <a href="/profile">Pengaturan Profil Saya</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>