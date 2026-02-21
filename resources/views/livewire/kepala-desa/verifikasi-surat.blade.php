<div>
    <x-admin.page-header title="Verifikasi Surat" subtitle="Setujui atau tolak pengajuan surat dari masyarakat" />

    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-4">
            <x-admin.stat-card icon="fas fa-hourglass-half" label="Menunggu Verifikasi" :value="$stats['menunggu']"
                trend-value="Perlu ditinjau" variant="warning" />
        </div>
        <div class="col-6 col-lg-4">
            <x-admin.stat-card icon="fas fa-check-circle" label="Disetujui" :value="$stats['disetujui']"
                trend-value="Sudah disetujui" variant="success" />
        </div>
        <div class="col-6 col-lg-4">
            <x-admin.stat-card icon="fas fa-times-circle" label="Ditolak" :value="$stats['ditolak']"
                trend-value="Tidak disetujui" variant="danger" />
        </div>
    </div>

    {{-- Table --}}
    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Pengajuan Surat</h5>
            <div class="d-flex gap-2 flex-wrap">
                <select class="form-select" wire:model.live="filterStatus" style="min-width: 150px;">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $statusOption)
                        @if(!in_array($statusOption->value, ['pending']))
                            <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text"
                        style="background: var(--input-bg); border-color: var(--border-color);">
                        <i class="fas fa-search" style="color: var(--text-muted);"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari pemohon/surat..."
                        wire:model.live.debounce.300ms="search" style="border-left: none;">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pemohon</th>
                        <th>Jenis Surat</th>
                        <th>Status</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuans as $item)
                        <tr wire:key="pengajuan-{{ $item->id }}">
                            <td>
                                <x-admin.badge variant="info">
                                    {{ $item->tanggal_pengajuan->format('d M Y') }}
                                </x-admin.badge>
                            </td>
                            <td>
                                <div style="color: var(--text-primary); font-weight: 500;">
                                    {{ $item->masyarakat->nama ?? '-' }}
                                </div>
                                <small style="color: var(--text-muted);">{{ $item->masyarakat->nik ?? '' }}</small>
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $item->jenisSurat->nama_surat ?? '-' }}
                            </td>
                            <td>
                                <x-admin.badge variant="{{ $item->status->color() }}" icon="{{ $item->status->icon() }}">
                                    {{ $item->status->label() }}
                                </x-admin.badge>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <button class="action-btn action-btn-view" wire:click="viewDetail({{ $item->id }})"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($item->status->value === 'diproses')
                                        <button class="btn btn-sm"
                                            style="background: var(--success-color); color: white; border: none; border-radius: 6px; padding: 4px 10px;"
                                            wire:click="confirmApprove({{ $item->id }})" title="Setujui">
                                            <i class="fas fa-check me-1"></i>Setujui
                                        </button>
                                        <button class="btn btn-sm"
                                            style="background: var(--danger-color); color: white; border: none; border-radius: 6px; padding: 4px 10px;"
                                            wire:click="confirmReject({{ $item->id }})" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Tidak ada pengajuan surat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengajuans->hasPages())
            <div class="d-flex justify-content-end mt-4">
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
                        <label class="form-label text-muted">Pemohon</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-user me-2" style="color: var(--primary-color);"></i>
                            {{ $selectedPengajuan->masyarakat->nama ?? '-' }}
                        </p>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-id-card me-2" style="color: var(--info-color);"></i>
                            NIK: {{ $selectedPengajuan->masyarakat->nik ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Jenis Surat</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-file-alt me-2" style="color: var(--info-color);"></i>
                            {{ $selectedPengajuan->jenisSurat->nama_surat ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal Pengajuan</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-calendar me-2" style="color: var(--primary-color);"></i>
                            {{ $selectedPengajuan->tanggal_pengajuan->format('d M Y') }}
                        </p>
                    </div>
                    <div class="col-md-6">
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
                            <label class="form-label text-muted">Diterima oleh</label>
                            <p style="color: var(--text-primary); font-weight: 500;">
                                <i class="fas fa-user-shield me-2" style="color: var(--success-color);"></i>
                                {{ $selectedPengajuan->user->name }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                    <div class="d-flex gap-2">
                        @if($selectedPengajuan->status->value === 'diproses')
                            <x-admin.button type="button" variant="primary"
                                wire:click="confirmApprove({{ $selectedPengajuan->id }})">
                                <i class="fas fa-check me-1"></i> Setujui
                            </x-admin.button>
                            <x-admin.button type="button" variant="danger"
                                wire:click="confirmReject({{ $selectedPengajuan->id }})">
                                <i class="fas fa-times me-1"></i> Tolak
                            </x-admin.button>
                        @endif
                    </div>
                    <x-admin.button type="button" variant="outline" wire:click="closeDetailModal">
                        Tutup
                    </x-admin.button>
                </div>
            </div>
        </div>
    @endif

    {{-- Reject Modal --}}
    @if($showRejectModal)
        <div class="modal-backdrop-custom" wire:click.self="closeRejectModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 500px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        <i class="fas fa-times-circle me-2" style="color: var(--danger-color);"></i>
                        Tolak Pengajuan Surat
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeRejectModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="reject">
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan <span
                                style="color: var(--danger-color);">*</span></label>
                        <textarea class="form-control @error('rejectNote') is-invalid @enderror" wire:model="rejectNote"
                            rows="4" placeholder="Tuliskan alasan penolakan pengajuan surat ini..."
                            style="resize: vertical;"></textarea>
                        @error('rejectNote')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeRejectModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="danger">
                            <i class="fas fa-times me-1"></i> Tolak Pengajuan
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Approve Confirm Modal --}}
    <x-admin.confirm-modal :show="$showApproveModal" title="Konfirmasi Persetujuan"
        message="Apakah Anda yakin ingin menyetujui pengajuan surat ini?" on-confirm="approve" on-cancel="cancelApprove"
        confirm-variant="primary">
        <x-slot:confirmButton>
            <i class="fas fa-check-circle me-2"></i>Ya, Setujui
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>