<div>
    <x-admin.page-header title="Dashboard" subtitle="Selamat datang di SIDEWA - Sistem Informasi Desa">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-sync" wire:click="$refresh">
                Refresh Data
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-users" 
                label="Total Masyarakat" 
                :value="$totalMasyarakat"
                trend-value="Data warga terdaftar" 
                variant="primary" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-bullhorn" 
                label="Pengumuman" 
                :value="$totalPengumuman"
                trend-value="Pengumuman desa" 
                variant="secondary" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-comments" 
                label="Pengaduan Pending" 
                :value="$pengaduanPending"
                trend-value="Menunggu ditangani" 
                variant="warning" 
            />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-admin.stat-card 
                icon="fas fa-envelope" 
                label="Pengajuan Baru" 
                :value="$pengajuanDiajukan"
                trend-value="Surat menunggu proses" 
                variant="info" 
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
                        Pengaduan Terbaru
                    </h5>
                    <a href="{{ route('admin.pengaduan') }}" class="text-decoration-none" style="color: var(--primary-color); font-size: 0.875rem;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                @forelse($recentPengaduan as $pengaduan)
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="user-avatar" style="width: 40px; height: 40px; font-size: 0.75rem;">
                            {{ $pengaduan->masyarakat?->initials() ?? 'NA' }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="color: var(--text-primary); font-weight: 500;">{{ $pengaduan->masyarakat?->nama ?? 'Unknown' }}</div>
                                    <small style="color: var(--text-muted);">{{ Str::limit($pengaduan->isi_pengaduan, 50) }}</small>
                                </div>
                                @switch($pengaduan->status)
                                    @case('pending')
                                        <x-admin.badge variant="warning" size="sm">Pending</x-admin.badge>
                                        @break
                                    @case('proses')
                                        <x-admin.badge variant="info" size="sm">Proses</x-admin.badge>
                                        @break
                                    @case('selesai')
                                        <x-admin.badge variant="success" size="sm">Selesai</x-admin.badge>
                                        @break
                                    @default
                                        <x-admin.badge variant="secondary" size="sm">{{ $pengaduan->status }}</x-admin.badge>
                                @endswitch
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
                        Pengajuan Surat Terbaru
                    </h5>
                    <a href="{{ route('admin.pengajuan-surat') }}" class="text-decoration-none" style="color: var(--primary-color); font-size: 0.875rem;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                @forelse($recentPengajuan as $pengajuan)
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3" style="border-bottom: 1px solid var(--border-color);">
                        <div class="user-avatar" style="width: 40px; height: 40px; font-size: 0.75rem;">
                            {{ $pengajuan->masyarakat?->initials() ?? 'NA' }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="color: var(--text-primary); font-weight: 500;">{{ $pengajuan->masyarakat?->nama ?? 'Unknown' }}</div>
                                    <small style="color: var(--text-muted);">{{ $pengajuan->jenisSurat?->nama_surat ?? '-' }}</small>
                                </div>
                                @switch($pengajuan->status)
                                    @case('diajukan')
                                        <x-admin.badge variant="secondary" size="sm">Diajukan</x-admin.badge>
                                        @break
                                    @case('diproses')
                                        <x-admin.badge variant="info" size="sm">Diproses</x-admin.badge>
                                        @break
                                    @case('siap_ambil')
                                        <x-admin.badge variant="primary" size="sm">Siap</x-admin.badge>
                                        @break
                                    @case('selesai')
                                        <x-admin.badge variant="success" size="sm">Selesai</x-admin.badge>
                                        @break
                                    @default
                                        <x-admin.badge variant="secondary" size="sm">{{ $pengajuan->status }}</x-admin.badge>
                                @endswitch
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

    {{-- Recent Pengumuman --}}
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="modern-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">
                        <i class="fas fa-bullhorn me-2" style="color: var(--warning-color);"></i>
                        Pengumuman Terbaru
                    </h5>
                    <a href="{{ route('admin.pengumuman') }}" class="text-decoration-none" style="color: var(--primary-color); font-size: 0.875rem;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-3">
                    @forelse($recentPengumuman as $pengumuman)
                        <div class="col-md-4">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px; border-left: 4px solid var(--primary-color);">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0" style="color: var(--text-primary); font-weight: 600;">{{ Str::limit($pengumuman->judul, 30) }}</h6>
                                </div>
                                <p class="mb-2" style="color: var(--text-secondary); font-size: 0.875rem;">{{ Str::limit($pengumuman->isi, 80) }}</p>
                                <small style="color: var(--text-muted);">
                                    <i class="fas fa-calendar me-1"></i>{{ $pengumuman->tanggal->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-4" style="color: var(--text-muted);">
                                <i class="fas fa-bullhorn mb-2" style="font-size: 2rem;"></i>
                                <p class="mb-0">Belum ada pengumuman</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Stats Summary --}}
    <div class="row g-4 mt-2">
        <div class="col-md-6 col-lg-4">
            <div class="modern-card text-center">
                <i class="fas fa-calendar-alt mb-3" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                <h3 style="color: var(--text-primary); font-weight: 700;">{{ $kegiatanAktif }}</h3>
                <p class="mb-0" style="color: var(--text-secondary);">Kegiatan Aktif</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="modern-card text-center">
                <i class="fas fa-file-alt mb-3" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
                <h3 style="color: var(--text-primary); font-weight: 700;">{{ $totalPengajuanSurat }}</h3>
                <p class="mb-0" style="color: var(--text-secondary);">Total Pengajuan Surat</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="modern-card text-center">
                <i class="fas fa-headset mb-3" style="font-size: 2.5rem; color: var(--success-color);"></i>
                <h3 style="color: var(--text-primary); font-weight: 700;">{{ $totalPengaduan }}</h3>
                <p class="mb-0" style="color: var(--text-secondary);">Total Pengaduan</p>
            </div>
        </div>
    </div>
</div>
