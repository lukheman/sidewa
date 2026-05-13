<!DOCTYPE html>
<html>

<head>
    <title>{{ $namaSurat }}</title>
    <style>
        @page {
            margin: 2.5cm 2.5cm 2cm 2.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }

        /* === KOP SURAT === */
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat .instansi {
            font-size: 14pt;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .kop-surat .desa {
            font-size: 18pt;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .kop-surat .alamat {
            font-size: 10pt;
            margin-top: 2px;
        }

        /* === JUDUL SURAT === */
        .judul-surat {
            text-align: center;
            margin: 25px 0 20px;
        }

        .judul-surat h2 {
            font-size: 14pt;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 1px;
        }

        .judul-surat .nomor {
            font-size: 11pt;
            margin-top: 3px;
        }

        /* === ISI SURAT === */
        .pembuka {
            margin-bottom: 15px;
            text-align: justify;
        }

        .data-pemohon {
            margin: 10px 0 15px 40px;
        }

        .data-pemohon table {
            border-collapse: collapse;
        }

        .data-pemohon td {
            padding: 3px 8px 3px 0;
            vertical-align: top;
        }

        .data-pemohon td:first-child {
            width: 140px;
        }

        .data-pemohon td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .isi-surat {
            text-align: justify;
            margin: 15px 0;
            text-indent: 40px;
        }

        .keterangan {
            margin: 15px 0;
        }

        .keterangan-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .keterangan-isi {
            margin-left: 40px;
            font-style: italic;
        }

        .penutup {
            text-align: justify;
            margin-top: 15px;
            text-indent: 40px;
        }

        /* === TANDA TANGAN === */
        .ttd-section {
            margin-top: 40px;
            float: right;
            text-align: center;
            width: 250px;
        }

        .ttd-section .tempat-tanggal {
            margin-bottom: 5px;
        }

        .ttd-section .jabatan {
            font-weight: bold;
        }

        .ttd-section .nama {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 70px;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>

<body>
    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <div class="instansi">PEMERINTAH DESA</div>
        <div class="desa">DESA WATALARA</div>
        <div class="alamat">Kecamatan Baula, Kabupaten Kolaka, Provinsi Sulawesi Tenggara</div>
        <div class="alamat">Email: desa.watalara@email.com</div>
    </div>

    {{-- JUDUL SURAT --}}
    <div class="judul-surat">
        <h2>{{ strtoupper($namaSurat) }}</h2>
        <div class="nomor">Nomor: {{ $nomorSurat }}</div>
    </div>

    {{-- PEMBUKA --}}
    <div class="pembuka">
        Yang bertanda tangan di bawah ini, Kepala Desa Watalara, Kecamatan Baula, Kabupaten Kolaka, menerangkan bahwa:
    </div>

    {{-- DATA PEMOHON --}}
    <div class="data-pemohon">
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><strong>{{ $pengajuan->masyarakat->nama ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $pengajuan->masyarakat->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $pengajuan->masyarakat->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{ $pengajuan->masyarakat->phone ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- ISI SURAT --}}
    <div class="isi-surat">
        {{ $isiSurat }}
    </div>

    {{-- KETERANGAN TAMBAHAN --}}
    @if($pengajuan->keterangan)
        <div class="keterangan">
            <div class="keterangan-label">Keterangan/Keperluan:</div>
            <div class="keterangan-isi">{{ $pengajuan->keterangan }}</div>
        </div>
    @endif

    {{-- PENUTUP --}}
    <div class="penutup">
        Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
    </div>

    {{-- TANDA TANGAN + QR CODE --}}
    <table style="width: 100%; margin-top: 40px;">
        <tr>
            <td style="width: 40%; vertical-align: top; text-align: center;">
                <div style="margin-bottom: 5px; font-size: 10pt; color: #333;">Tanda Tangan Digital:</div>
                <img src="data:image/svg+xml;base64,{{ $qrCode }}" style="width: 130px; height: 130px;">
                <div style="font-size: 8pt; color: #666; margin-top: 5px;">
                    Scan untuk verifikasi keaslian surat
                </div>
            </td>
            <td style="width: 60%; vertical-align: top; text-align: center;">
                <div>Watalara, {{ $pengajuan->tanggal_pengajuan->translatedFormat('d F Y') }}</div>
                <div style="font-weight: bold;">Kepala Desa Watalara</div>
                <div style="margin-top: 70px; font-weight: bold; text-decoration: underline;">
                    ( ..................................... )
                </div>
            </td>
        </tr>
    </table>
</body>

</html>