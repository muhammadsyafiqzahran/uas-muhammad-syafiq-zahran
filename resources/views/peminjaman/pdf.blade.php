<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Perpustakaan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f8fafc; font-weight: bold; }
        .text-center { text-align: center; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .badge-dipinjam { background-color: #fef3c7; color: #d97706; }
        .badge-kembali { background-color: #d1fae5; color: #059669; }
    </style>
</head>
<body>

    <h2>Laporan Transaksi Peminjaman Buku</h2>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Anggota</th>
                <th width="30%">Judul Buku</th>
                <th width="15%">Tgl Pinjam</th>
                <th width="15%">Tgl Kembali</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $i => $p)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $p->anggota->nama }}</td>
                <td>{{ $p->buku->judul }}</td>
                <td>{{ $p->tgl_pinjam->format('d M Y') }}</td>
                <td>{{ $p->tgl_kembali->format('d M Y') }}</td>
                <td class="text-center">
                    {{ $p->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: right; margin-top: 30px;">
        <p>Yogyakarta, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>Admin Perpustakaan</strong></p>
    </div>

</body>
</html>
