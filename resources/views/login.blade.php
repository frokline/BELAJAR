<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kasir / POS</title>
</head>
<body>
    <h1>Silakan Login Terlebih Dahulu</h1>
    <hr><br>

    {{-- Notifikasi Sukses / Error --}}
    @if(session('sukses'))
        <p style="color: green;"><b>{{ session('sukses') }}</b></p>
    @endif

    @if ($errors->has('login_error'))
        <p style="color: red;"><b>{{ $errors->first('login_error') }}</b></p>
    @endif

    <form action="/login" method="POST">
        @csrf

        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required placeholder="Masukkan username">
        </p>

        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required placeholder="Masukkan password">
        </p>

        <br>
        <button type="submit">Masuk (Login)</button>
    </form>

    <br><hr>
    <small>
        <b>Akun Default (dari Seeder):</b><br>
        Username: <code>admin</code> | Password: <code>password123</code><br>
        Username: <code>kasir</code> | Password: <code>password123</code>
    </small>
</body>
</html>