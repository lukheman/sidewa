<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat - SIDEWA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .valid-bg {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
        }

        .invalid-bg {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 50%, #fca5a5 100%);
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            max-width: 500px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .icon-valid {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .icon-invalid {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
        }

        .title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .title-valid {
            color: #065f46;
        }

        .title-invalid {
            color: #991b1b;
        }

        .subtitle {
            text-align: center;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .subtitle-valid {
            color: #047857;
        }

        .subtitle-invalid {
            color: #b91c1c;
        }

        .detail-group {
            background: #f8fafb;
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #6b7280;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .detail-value {
            color: #111827;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: right;
            max-width: 60%;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-disetujui {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-diproses {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-ditolak {
            background: #fecaca;
            color: #991b1b;
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .footer-text {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: #10b981;
        }

        .timestamp {
            text-align: center;
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 1rem;
        }
    </style>
</head>

<body class="{{ $valid ? 'valid-bg' : 'invalid-bg' }}">
    <div class="card">
        @if($valid)
            <div class="icon-circle icon-valid">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="title title-valid">Surat Terverifikasi</h1>
            <p class="subtitle subtitle-valid">Surat ini resmi dikeluarkan oleh Desa Watalara</p>

            <div class="detail-group">
                <div class="detail-row">
                    <span class="detail-label">Jenis Surat</span>
                    <span class="detail-value">{{ $pengajuan->jenisSurat->nama_surat ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nomor Surat</span>
                    <span class="detail-value">
                        {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}/SKD/{{ ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][$pengajuan->tanggal_pengajuan->month] }}/{{ $pengajuan->tanggal_pengajuan->year }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nama Pemohon</span>
                    <span class="detail-value">{{ $pengajuan->masyarakat->nama ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">NIK</span>
                    <span class="detail-value">{{ $pengajuan->masyarakat->nik ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tanggal Pengajuan</span>
                    <span class="detail-value">{{ $pengajuan->tanggal_pengajuan->format('d M Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">
                        <span class="status-badge status-{{ $pengajuan->status->value }}">
                            <i class="{{ $pengajuan->status->icon() }}"></i>
                            {{ $pengajuan->status->label() }}
                        </span>
                    </span>
                </div>
                @if($pengajuan->user)
                    <div class="detail-row">
                        <span class="detail-label">Diverifikasi oleh</span>
                        <span class="detail-value">{{ $pengajuan->user->name }}</span>
                    </div>
                @endif
            </div>

            <div class="footer">
                <p class="footer-text">Dokumen ini dapat diverifikasi secara digital melalui QR Code yang tertera pada
                    surat.</p>
                <div class="brand">
                    <i class="fas fa-layer-group"></i> SIDEWA
                </div>
            </div>

            <div class="timestamp">
                Diverifikasi pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
            </div>
        @else
            <div class="icon-circle icon-invalid">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1 class="title title-invalid">Surat Tidak Valid</h1>
            <p class="subtitle subtitle-invalid">Surat dengan kode verifikasi ini tidak ditemukan dalam sistem kami.</p>

            <div class="detail-group">
                <div style="text-align: center; padding: 1rem; color: #6b7280;">
                    <i class="fas fa-exclamation-triangle"
                        style="font-size: 2rem; color: #f59e0b; margin-bottom: 0.75rem;"></i>
                    <p style="font-size: 0.9rem;">Surat ini mungkin palsu atau kode verifikasi telah kedaluwarsa. Silakan
                        hubungi kantor Desa Watalara untuk konfirmasi lebih lanjut.</p>
                </div>
            </div>

            <div class="footer">
                <div class="brand">
                    <i class="fas fa-layer-group"></i> SIDEWA
                </div>
            </div>
        @endif
    </div>
</body>

</html>