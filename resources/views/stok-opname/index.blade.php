<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>stok opname</title>
</head>
<body>
    <h1>Stok Opname</h1>
    <p><a href="{{ route('stok-opname.create') }}">Tambah Stok Opname Baru</a></p>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang</th>
                <th>Stok Fisik</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stokOpname as $stok)
                <tr>
                    <td>{{ $stok->id }}</td>
                    <td>{{ $stok->barang->nama_barang }}</td>
                    <td>{{ $stok->stok_fisik }}</td>
                    <td>{{ $stok->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>