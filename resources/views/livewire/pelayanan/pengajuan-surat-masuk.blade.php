<div>
    <x-admin.page-header title="Pengajuan Surat Masuk" subtitle="Kelola dan proses pengajuan surat dari masyarakat" />

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
            <x-admin.stat-card icon="fas fa-paper-plane" label="Baru Masuk" :value="$stats['pending']"
                trend-value="Perlu diproses" variant="warning" />
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

    {{-- Table --}}
    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Pengajuan Surat</h5>
            <div class="d-flex gap-2 flex-wrap">
                <select class="form-select" wire:model.live="filterStatus" style="min-width: 150px;">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $statusOption)
                        <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
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
                            <td style="color: var(--text-secondary);">{{ $item->jenisSurat->nama_surat ?? '-' }}</td>
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
                                    @if($item->status->value === 'pending')
                                        <button class="btn btn-sm"
                                            style="background: var(--info-color); color: white; border: none; border-radius: 6px; padding: 4px 10px;"
                                            wire:click="updateStatus({{ $item->id }}, 'diproses')" title="Proses">
                                            <i class="fas fa-play me-1"></i>Proses
                                        </button>
                                    @endif
                                    @if(in_array($item->status->value, ['pending', 'diproses']))
                                        <button class="btn btn-sm"
                                            style="background: var(--danger-color); color: white; border: none; border-radius: 6px; padding: 4px 10px;"
                                            wire:click="updateStatus({{ $item->id }}, 'ditolak')" title="Tolak">
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
                                    <p class="mb-0">Belum ada pengajuan surat masuk</p>
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
                        <small style="color: var(--text-muted);">NIK:
                            {{ $selectedPengajuan->masyarakat->nik ?? '-' }}</small>
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
                            <label class="form-label text-muted">Diproses oleh</label>
                            <p style="color: var(--text-primary); font-weight: 500;">
                                <i class="fas fa-user-shield me-2" style="color: var(--success-color);"></i>
                                {{ $selectedPengajuan->user->name }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Quick Action Buttons --}}
                <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($selectedPengajuan->status->value === 'pending')
                            <x-admin.button type="button" variant="primary"
                                wire:click="updateStatus({{ $selectedPengajuan->id }}, 'diproses')">
                                <i class="fas fa-play me-1"></i> Proses
                            </x-admin.button>
                            <x-admin.button type="button" variant="danger"
                                wire:click="updateStatus({{ $selectedPengajuan->id }}, 'ditolak')">
                                <i class="fas fa-times me-1"></i> Tolak
                            </x-admin.button>
                        @elseif($selectedPengajuan->status->value === 'diproses')
                            <x-admin.button type="button" variant="danger"
                                wire:click="updateStatus({{ $selectedPengajuan->id }}, 'ditolak')">
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
</div>