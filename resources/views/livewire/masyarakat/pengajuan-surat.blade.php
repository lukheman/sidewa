<div>
    {{-- Page Header --}}
    <x-admin.page-header title="Pengajuan Surat" subtitle="Ajukan permohonan surat kependudukan">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus"
                href="{{ route('masyarakat.pengajuan-surat.create') }}">
                Ajukan Surat
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    {{-- Flash Messages --}}
    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-file-alt" label="Total Pengajuan" :value="$stats['total']"
                trend-value="Semua pengajuan" variant="primary" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-paper-plane" label="Pending" :value="$stats['pending']"
                trend-value="Menunggu proses" variant="secondary" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-spinner" label="Diproses" :value="$stats['diproses']"
                trend-value="Sedang dikerjakan" variant="info" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-check-circle" label="Disetujui" :value="$stats['disetujui']"
                trend-value="Sudah disetujui" variant="success" />
        </div>
    </div>

    {{-- Filter --}}
    <div class="modern-card mb-4">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-filter" style="color: var(--text-muted);"></i>
                <label class="form-label mb-0" style="color: var(--text-secondary); font-weight: 500;">Filter
                    Status:</label>
            </div>
            <select wire:model.live="filterStatus" class="form-select" style="max-width: 200px;">
                <option value="">Semua Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Pengajuan List --}}
    <div class="modern-card">
        <div class="preview-title d-flex align-items-center gap-2 mb-3">
            <i class="fas fa-list" style="color: var(--primary-color);"></i>
            Daftar Pengajuan Surat
        </div>

        @forelse($pengajuans as $pengajuan)
            <div class="d-flex align-items-start gap-3 p-3 mb-3"
                style="background: var(--bg-tertiary); border-radius: 12px; border-left: 4px solid var(--{{ $pengajuan->status->color() }}-color);">
                <div class="flex-shrink-0">
                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                        style="width: 45px; height: 45px; background: var(--bg-secondary);">
                        <i class="{{ $pengajuan->status->icon() }}"
                            style="color: var(--{{ $pengajuan->status->color() }}-color); font-size: 1.1rem;"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="mb-1" style="color: var(--text-primary); font-weight: 600;">
                                {{ $pengajuan->jenisSurat->nama_surat ?? '-' }}
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <small style="color: var(--text-muted);">
                                    <i class="fas fa-calendar me-1"></i>{{ $pengajuan->tanggal_pengajuan->format('d M Y') }}
                                </small>
                                @if($pengajuan->keterangan)
                                    <small style="color: var(--text-muted);">
                                        <i class="fas fa-comment me-1"></i>{{ Str::limit($pengajuan->keterangan, 50) }}
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <x-admin.badge variant="{{ $pengajuan->status->color() }}" size="sm">
                                {{ $pengajuan->status->label() }}
                            </x-admin.badge>
                            <button wire:click="viewDetail({{ $pengajuan->id }})" class="btn btn-sm"
                                style="background: var(--bg-secondary); color: var(--primary-color); border: 1px solid var(--border-color); border-radius: 8px;"
                                title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5" style="color: var(--text-muted);">
                <i class="fas fa-file-alt mb-3" style="font-size: 3rem;"></i>
                <p class="mb-2">Belum ada pengajuan surat</p>
                <p class="mb-0" style="font-size: 0.875rem;">Klik tombol "Ajukan Surat" untuk mengajukan permohonan surat.
                </p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($pengajuans->hasPages())
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </div>

    {{-- Detail Modal --}}
    @if($showDetailModal && $selectedPengajuan)
        <div class="modal-backdrop-custom" wire:click.self="closeDetailModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        Detail Pengajuan Surat
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeDetailModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Jenis Surat</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-file-alt me-2" style="color: var(--primary-color);"></i>
                            {{ $selectedPengajuan->jenisSurat->nama_surat ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal Pengajuan</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-calendar me-2" style="color: var(--info-color);"></i>
                            {{ $selectedPengajuan->tanggal_pengajuan->format('d M Y') }}
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Status</label>
                        <div>
                            <x-admin.badge variant="{{ $selectedPengajuan->status->color() }}"
                                icon="{{ $selectedPengajuan->status->icon() }}">
                                {{ $selectedPengajuan->status->label() }}
                            </x-admin.badge>
                        </div>
                    </div>
                    @if($selectedPengajuan->keterangan)
                        <div class="col-12">
                            <label class="form-label text-muted">Keterangan</label>
                            <div class="p-3"
                                style="background: var(--bg-tertiary); border-radius: 10px; color: var(--text-primary); line-height: 1.7;">
                                {{ $selectedPengajuan->keterangan }}
                            </div>
                        </div>
                    @endif
                    @if($selectedPengajuan->user)
                        <div class="col-12">
                            <label class="form-label text-muted">Diproses oleh</label>
                            <p style="color: var(--text-primary); font-weight: 500;">
                                <i class="fas fa-user-shield me-2" style="color: var(--success-color);"></i>
                                {{ $selectedPengajuan->user->name }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-admin.button type="button" variant="outline" wire:click="closeDetailModal">
                        Tutup
                    </x-admin.button>
                </div>
            </div>
        </div>
    @endif
</div>