<!DOCTYPE html>
<html>

<head>
    <title>Laporan Anggaran Desa</title>
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

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .summary-box {
            border: 1px solid #000;
            padding: 15px;
            margin-top: 30px;
            width: 300px;
            float: left;
        }

        .summary-box table {
            margin-bottom: 0;
        }

        .summary-box th, .summary-box td {
            border: none;
            padding: 4px 8px;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            clear: both;
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
        <h1>LAPORAN REALISASI ANGGARAN DESA</h1>
        <h2>DESA WATALARA</h2>
        <p>Kecamatan Baula, Kabupaten Kolaka, Provinsi Sulawesi Tenggara</p>
    </div>

    <div class="meta">
        <p><strong>Tahun Anggaran:</strong> {{ $tahun }}</p>
    </div>

    <div class="section-title">A. PENDAPATAN DESA</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 50%;">Uraian</th>
                <th style="width: 25%;">Keterangan</th>
                <th style="width: 20%;" class="text-right">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendapatan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="text-right">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Nihil</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">B. BELANJA DESA</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 50%;">Uraian</th>
                <th style="width: 25%;">Keterangan</th>
                <th style="width: 20%;" class="text-right">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($belanja as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="text-right">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Nihil</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL BELANJA</td>
                <td class="text-right">{{ number_format($totalBelanja, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Pendapatan</strong></td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Belanja</strong></td>
                <td class="text-right">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr style="border-top: 1px dashed #000;"></td>
            </tr>
            <tr>
                <td><strong>Surplus / (Defisit)</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($selisih, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Watalara, {{ date('d F Y') }}</p>
        <p>{{ $signer ?? 'Kepala Desa Watalara' }}</p>
        <div class="ttd">
            ( ..................................... )
        </div>
    </div>
</body>

</html>
