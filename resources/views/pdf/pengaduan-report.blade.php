<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 14px;
        }

        .meta {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .footer p {
            margin: 5px 0;
        }

        .ttd {
            margin-top: 50px;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PENGADUAN MASYARAKAT</h1>
        <h2>DESA WATALARA</h2>
        <p>Kecamatan Baula, Kabupaten Kolaka, Provinsi Sulawesi Tenggara</p>
    </div>

    <div class="meta">
        <p><strong>Periode:</strong>
            {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Semua' }}
            s/d
            {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Sekarang' }}
        </p>
        <p><strong>Status:</strong> {{ $status ? ucfirst($status) : 'Semua Status' }}</p>
        <p><strong>Total Data:</strong> {{ $pengaduans->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 20%;">Pelapor</th>
                <th style="width: 40%;">Isi Pengaduan</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_pengaduan->format('d/m/Y') }}</td>
                    <td>
                        {{ $item->masyarakat->nama ?? '-' }}<br>
                        <small>{{ $item->masyarakat->nik ?? '' }}</small>
                    </td>
                    <td>{{ $item->isi_pengaduan }}</td>
                    <td>{{ ucfirst($item->status->value) }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Watalara, {{ date('d F Y') }}</p>
        <p>Kepala Desa Watalara</p>
        <div class="ttd">
            ( ..................................... )
        </div>
    </div>
</body>

</html>