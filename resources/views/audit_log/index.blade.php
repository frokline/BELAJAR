<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Audit Logs - Rekam Aktivitas System</title>
</head>
<body>
    <h1>Audit Logs / Jurnal Aktivitas Sistem</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Petugas/User</th>
                <th>Aksi</th>
                <th>Entitas/Model</th>
                <th>ID Data</th>
                <th>IP Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaLog as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td><b>{{ optional($log->user)->name ?? 'Sistem/Guest' }}</b></td>
                    <td>
                        @if($log->action == 'CREATE')
                            <span style="color: green;"><b>CREATE</b></span>
                        @elseif($log->action == 'UPDATE')
                            <span style="color: blue;"><b>UPDATE</b></span>
                        @else
                            <span style="color: red;"><b>DELETE</b></span>
                        @endif
                    </td>
                    <td>{{ class_basename($log->model_type) }}</td>
                    <td>{{ $log->model_id ?? '-' }}</td>
                    <td>{{ $log->ip_address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada rekaman aktivitas audit log.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>