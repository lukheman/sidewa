<div>
    <x-admin.page-header title="Dashboard Kepala Desa" subtitle="Ringkasan verifikasi surat dan layanan" />

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-clock" label="Menunggu Verifikasi" :value="$menungguVerifikasi"
                trend-value="Perlu ditinjau" variant="warning" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-check-circle" label="Disetujui" :value="$disetujui"
                trend-value="Siap diambil" variant="success" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-file-alt" label="Total Pengajuan" :value="$totalPengajuan"
                trend-value="Semua pengajuan" variant="primary" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-times-circle" label="Ditolak" :value="$ditolak"
                trend-value="Tidak disetujui" variant="danger" />
        </div>
    </div>

    <div class="row g-4">
        {{-- Surat Menunggu Verifikasi --}}
        <div class="col-lg-8">
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-hourglass-half" style="color: var(--warning-color);"></i>
                        Menunggu Verifikasi
                    </div>
                    <a href="{{ route('kepala-desa.verifikasi-surat') }}"
                        style="color: var(--primary-color); font-size: 0.875rem; text-decoration: none;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                @forelse($recentPengajuan as $pengajuan)
                    <div class="d-flex align-items-center gap-3 py-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                            style="width: 40px; height: 40px; background: var(--bg-secondary);">
                            <i class="fas fa-file-alt" style="color: var(--warning-color);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0" style="color: var(--text-primary); font-weight: 500;">
                                {{ $pengajuan->masyarakat->nama ?? '-' }}
                            </p>
                            <small style="color: var(--text-muted);">
                                {{ $pengajuan->jenisSurat->nama_surat ?? '-' }} •
                                {{ $pengajuan->tanggal_pengajuan->format('d M Y') }}
                            </small>
                        </div>
                        <x-admin.badge variant="warning" size="sm">Menunggu</x-admin.badge>
                    </div>
                @empty
                    <div class="text-center py-4" style="color: var(--text-muted);">
                        <i class="fas fa-check-circle mb-2" style="font-size: 2rem; color: var(--success-color);"></i>
                        <p class="mb-0">Tidak ada surat yang menunggu verifikasi</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="col-lg-4">
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-chart-pie" style="color: var(--primary-color);"></i>
                    Ringkasan
                </div>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">
                            <i class="fas fa-check-circle me-2" style="color: var(--success-color);"></i>Disetujui
                        </span>
                        <span style="color: var(--text-primary); font-weight: 600;">{{ $disetujui }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">
                            <i class="fas fa-comments me-2" style="color: var(--info-color);"></i>Total Pengaduan
                        </span>
                        <span style="color: var(--text-primary); font-weight: 600;">{{ $totalPengaduan }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>