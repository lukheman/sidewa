<div>
    <x-admin.page-header title="Dashboard Pelayanan" subtitle="Ringkasan layanan surat dan pengaduan" />

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-file-alt" label="Total Pengajuan" :value="$totalPengajuan"
                trend-value="Semua pengajuan surat" variant="primary" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-paper-plane" label="Baru Masuk" :value="$pengajuanDiajukan"
                trend-value="Perlu diproses" variant="warning" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-spinner" label="Diproses" :value="$pengajuanDiproses"
                trend-value="Sedang dikerjakan" variant="info" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-box" label="Siap Diambil" :value="$pengajuanSiapAmbil"
                trend-value="Menunggu diambil" variant="success" />
        </div>
    </div>

    <div class="row g-4">
        {{-- Pengajuan Terbaru --}}
        <div class="col-lg-8">
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-inbox" style="color: var(--primary-color);"></i>
                        Pengajuan Surat Terbaru
                    </div>
                    <a href="{{ route('pelayanan.pengajuan-surat') }}"
                        style="color: var(--primary-color); font-size: 0.875rem; text-decoration: none;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                @forelse($recentPengajuan as $pengajuan)
                    <div class="d-flex align-items-center gap-3 py-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                            style="width: 40px; height: 40px; background: var(--bg-secondary);">
                            <i class="{{ $pengajuan->status->icon() }}"
                                style="color: var(--{{ $pengajuan->status->color() }}-color);"></i>
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
                        <x-admin.badge variant="{{ $pengajuan->status->color() }}" size="sm">
                            {{ $pengajuan->status->label() }}
                        </x-admin.badge>
                    </div>
                @empty
                    <div class="text-center py-4" style="color: var(--text-muted);">
                        <i class="fas fa-inbox mb-2" style="font-size: 2rem;"></i>
                        <p class="mb-0">Belum ada pengajuan surat</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Statistik Ringkasan --}}
        <div class="col-lg-4">
            <div class="modern-card mb-4">
                <div class="preview-title d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-chart-pie" style="color: var(--primary-color);"></i>
                    Ringkasan Status
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">
                            <i class="fas fa-check-circle me-2" style="color: var(--success-color);"></i>Selesai
                        </span>
                        <span style="color: var(--text-primary); font-weight: 600;">{{ $pengajuanSelesai }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">
                            <i class="fas fa-comments me-2" style="color: var(--info-color);"></i>Total Pengaduan
                        </span>
                        <span style="color: var(--text-primary); font-weight: 600;">{{ $totalPengaduan }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">
                            <i class="fas fa-clock me-2" style="color: var(--warning-color);"></i>Pengaduan Pending
                        </span>
                        <span style="color: var(--text-primary); font-weight: 600;">{{ $pengaduanPending }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>