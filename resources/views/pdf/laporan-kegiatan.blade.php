<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kegiatan Desa</title>
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
        <h1>LAPORAN KEGIATAN DESA</h1>
        <h2>DESA WATALARA</h2>
        <p>Kecamatan Baula, Kabupaten Kolaka, Provinsi Sulawesi Tenggara</p>
    </div>

    <div class="meta">
        <p><strong>Pencarian:</strong> {{ $search ? $search : 'Semua Kegiatan' }}</p>
        <p><strong>Status:</strong> 
            @if($status == 'selesai') Selesai (100%)
            @elseif($status == 'berjalan') Sedang Berjalan (1-99%)
            @elseif($status == 'belum_mulai') Belum Mulai (0%)
            @else Semua Status @endif
        </p>
        <p><strong>Total Kegiatan:</strong> {{ $kegiatans->count() }} Kegiatan</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Kegiatan</th>
                <th style="width: 25%;">Waktu Pelaksanaan</th>
                <th style="width: 35%;">Deskripsi</th>
                <th style="width: 10%;">Progres</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kegiatan }}</td>
                    <td>
                        @if($item->tanggal_mulai)
                            Mulai: {{ $item->tanggal_mulai->format('d/m/Y') }}<br>
                        @endif
                        @if($item->tanggal_selesai)
                            Selesai: {{ $item->tanggal_selesai->format('d/m/Y') }}
                        @endif
                    </td>
                    <td>{{ $item->deskripsi }}</td>
                    <td style="text-align: center;">{{ $item->progres }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Watalara, {{ date('d F Y') }}</p>
        <p>{{ $signer ?? 'Kepala Desa Watalara' }}</p>
        <div class="ttd">
            ( ..................................... )
        </div>
    </div>
</body>

</html>
