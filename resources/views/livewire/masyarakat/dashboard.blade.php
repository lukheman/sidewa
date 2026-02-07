<div>
    <x-admin.page-header title="Portal Masyarakat" subtitle="Selamat datang, {{ $masyarakat->nama }} (NIK: {{ $masyarakat->nik }})">
    </x-admin.page-header>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-comments" 
                label="Total Pengaduan" 
                :value="$totalPengaduan"
                trend-value="Pengaduan yang diajukan" 
                variant="primary" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-clock" 
                label="Menunggu Proses" 
                :value="$pendingPengaduan"
                trend-value="Pengaduan pending" 
                variant="warning" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-file-alt" 
                label="Total Pengajuan Surat" 
                :value="$totalPengajuan"
                trend-value="Surat yang diajukan" 
                variant="info" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-inbox" 
                label="Siap Diambil" 
                :value="$siapAmbil"
                trend-value="Surat siap diambil" 
                variant="success" 
            />
        </div>
    </div>

    <div class="row g-4">
        {{-- Recent Pengaduan --}}
        <div class="col-lg-6">
            <div class="modern-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">
                        <i class="fas fa-comments me-2" style="color: var(--primary-color);"></i>
                        Pengaduan Saya
                    </h5>
                </div>

                @forelse($recentPengaduans as $pengaduan)
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="user-avatar" style="width: 40px; height: 40px; font-size: 0.75rem;">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="color: var(--text-primary); font-weight: 500;">{{ Str::limit($pengaduan->isi_pengaduan, 50) }}</div>
                                    <small style="color: var(--text-muted);">{{ $pengaduan->tanggal_pengaduan->format('d M Y') }}</small>
                                </div>
                                <x-admin.badge variant="{{ $pengaduan->status->color() }}" size="sm">
                                    {{ $pengaduan->status->label() }}
                                </x-admin.badge>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4" style="color: var(--text-muted);">
                        <i class="fas fa-inbox mb-2" style="font-size: 2rem;"></i>
                        <p class="mb-0">Belum ada pengaduan</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recent Pengajuan Surat --}}
        <div class="col-lg-6">
            <div class="modern-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">
                        <i class="fas fa-envelope me-2" style="color: var(--secondary-color);"></i>
                        Pengajuan Surat Saya
                    </h5>
                </div>

                @forelse($recentPengajuans as $pengajuan)
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="user-avatar" style="width: 40px; height: 40px; font-size: 0.75rem;">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="color: var(--text-primary); font-weight: 500;">{{ $pengajuan->jenisSurat->nama_surat ?? '-' }}</div>
                                    <small style="color: var(--text-muted);">{{ $pengajuan->tanggal_pengajuan->format('d M Y') }}</small>
                                </div>
                                <x-admin.badge variant="{{ $pengajuan->status->color() }}" size="sm">
                                    {{ $pengajuan->status->label() }}
                                </x-admin.badge>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4" style="color: var(--text-muted);">
                        <i class="fas fa-inbox mb-2" style="font-size: 2rem;"></i>
                        <p class="mb-0">Belum ada pengajuan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Pengumuman Terbaru --}}
    @if($pengumumans->count() > 0)
        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="modern-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">
                            <i class="fas fa-bullhorn me-2" style="color: var(--warning-color);"></i>
                            Pengumuman Terbaru
                        </h5>
                    </div>

                    <div class="row g-3">
                        @foreach($pengumumans as $pengumuman)
                            <div class="col-md-4">
                                <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px; border-left: 4px solid var(--primary-color);">
                                    <h6 class="mb-2" style="color: var(--text-primary); font-weight: 600;">{{ Str::limit($pengumuman->judul, 30) }}</h6>
                                    <p class="mb-2" style="color: var(--text-secondary); font-size: 0.875rem;">{{ Str::limit($pengumuman->isi, 80) }}</p>
                                    <small style="color: var(--text-muted);">
                                        <i class="fas fa-calendar me-1"></i>{{ $pengumuman->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
