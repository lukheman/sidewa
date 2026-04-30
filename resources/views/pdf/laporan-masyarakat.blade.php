<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Masyarakat</title>
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
        <h1>LAPORAN DATA MASYARAKAT</h1>
        <h2>DESA WATALARA</h2>
        <p>Kecamatan Baula, Kabupaten Kolaka, Provinsi Sulawesi Tenggara</p>
    </div>

    <div class="meta">
        <p><strong>Pencarian:</strong> {{ $search ? $search : 'Semua Data' }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $jenisKelamin == 'L' ? 'Laki-laki' : ($jenisKelamin == 'P' ? 'Perempuan' : 'Semua') }}</p>
        <p><strong>Total Data:</strong> {{ $masyarakats->count() }} Jiwa</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">NIK</th>
                <th style="width: 20%;">Nama Lengkap</th>
                <th style="width: 10%;">L/P</th>
                <th style="width: 15%;">No. Telp</th>
                <th style="width: 25%;">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masyarakats as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : ($item->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td>{{ $item->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Watalara, {{ date('d F Y') }}</p>
        <p>{{ $signer ?? 'Petugas Pelayanan' }}</p>
        <div class="ttd">
            ( ..................................... )
        </div>
    </div>
</body>

</html>
