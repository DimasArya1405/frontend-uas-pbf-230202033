<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Data Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['nama_peminjam'] }}</td>
                    <td>{{ $item['judul_buku'] }}</td>
                    <td>{{ $item['tanggal_pinjam'] }}</td>
                    <td>{{ $item['tanggal_kembali'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
