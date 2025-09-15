<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Pengaduan Masyarakat</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Laporan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->tgl_pengaduan }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->masyarakat->nama }}</td>
                <td>{{ $p->isi_laporan }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
