<div>
    <x-admin.page-header title="Pengaduan Masuk" subtitle="Kelola dan proses pengaduan dari masyarakat" />

    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-comments" label="Total Pengaduan" :value="$stats['total']"
                trend-value="Semua pengaduan" variant="primary" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-clock" label="Pending" :value="$stats['pending']"
                trend-value="Perlu ditangani" variant="warning" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-spinner" label="Diproses" :value="$stats['proses']"
                trend-value="Sedang ditangani" variant="info" />
        </div>
        <div class="col-6 col-lg-3">
            <x-admin.stat-card icon="fas fa-check-circle" label="Selesai" :value="$stats['selesai']"
                trend-value="Sudah ditangani" variant="success" />
        </div>
    </div>

    {{-- Table --}}
    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Pengaduan</h5>
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
                    <input type="text" class="form-control" placeholder="Cari pengaduan/pelapor..."
                        wire:model.live.debounce.300ms="search" style="border-left: none;">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pelapor</th>
                        <th>Isi Pengaduan</th>
                        <th>Status</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $item)
                        <tr wire:key="pengaduan-{{ $item->id }}">
                            <td>
                                <x-admin.badge variant="info">
                                    {{ $item->tanggal_pengaduan->format('d M Y') }}
                                </x-admin.badge>
                            </td>
                            <td>
                                <div style="color: var(--text-primary); font-weight: 500;">
                                    {{ $item->masyarakat->nama ?? '-' }}
                                </div>
                                <small style="color: var(--text-muted);">{{ $item->masyarakat->nik ?? '' }}</small>
                            </td>
                            <td style="color: var(--text-secondary);">{{ Str::limit($item->isi_pengaduan, 60) }}</td>
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
                                            wire:click="updateStatus({{ $item->id }}, 'proses')" title="Proses">
                                            <i class="fas fa-play me-1"></i>Proses
                                        </button>
                                    @elseif($item->status->value === 'proses')
                                        <button class="btn btn-sm"
                                            style="background: var(--success-color); color: white; border: none; border-radius: 6px; padding: 4px 10px;"
                                            wire:click="updateStatus({{ $item->id }}, 'selesai')" title="Selesai">
                                            <i class="fas fa-check me-1"></i>Selesai
                                        </button>
                                    @endif
                                    @if(in_array($item->status->value, ['pending', 'proses']))
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
                                    <p class="mb-0">Belum ada pengaduan masuk</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengaduans->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $pengaduans->links() }}
            </div>
        @endif
    </div>

    {{-- Detail Modal --}}
    @if($showDetailModal && $selectedPengaduan)
        <div class="modal-backdrop-custom" wire:click.self="closeDetailModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        Detail Pengaduan
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeDetailModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Pelapor</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-user me-2" style="color: var(--primary-color);"></i>
                            {{ $selectedPengaduan->masyarakat->nama ?? '-' }}
                        </p>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-id-card me-2" style="color: var(--info-color);"></i>
                            NIK: {{ $selectedPengaduan->masyarakat->nik ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal Pengaduan</label>
                        <p style="color: var(--text-primary); font-weight: 500;">
                            <i class="fas fa-calendar me-2" style="color: var(--primary-color);"></i>
                            {{ $selectedPengaduan->tanggal_pengaduan->format('d M Y') }}
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Status</label>
                        <div>
                            <x-admin.badge variant="{{ $selectedPengaduan->status->color() }}"
                                icon="{{ $selectedPengaduan->status->icon() }}">
                                {{ $selectedPengaduan->status->label() }}
                            </x-admin.badge>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Isi Pengaduan</label>
                        <div class="p-3"
                            style="background: var(--bg-tertiary); border-radius: 10px; color: var(--text-primary); line-height: 1.7;">
                            {{ $selectedPengaduan->isi_pengaduan }}
                        </div>
                    </div>
                    @if($selectedPengaduan->user)
                        <div class="col-12">
                            <label class="form-label text-muted">Ditangani oleh</label>
                            <p style="color: var(--text-primary); font-weight: 500;">
                                <i class="fas fa-user-shield me-2" style="color: var(--success-color);"></i>
                                {{ $selectedPengaduan->user->name }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Quick Action Buttons --}}
                <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($selectedPengaduan->status->value === 'pending')
                            <x-admin.button type="button" variant="primary"
                                wire:click="updateStatus({{ $selectedPengaduan->id }}, 'proses')">
                                <i class="fas fa-play me-1"></i> Proses
                            </x-admin.button>
                            <x-admin.button type="button" variant="danger"
                                wire:click="updateStatus({{ $selectedPengaduan->id }}, 'ditolak')">
                                <i class="fas fa-times me-1"></i> Tolak
                            </x-admin.button>
                        @elseif($selectedPengaduan->status->value === 'proses')
                            <x-admin.button type="button" variant="primary"
                                wire:click="updateStatus({{ $selectedPengaduan->id }}, 'selesai')">
                                <i class="fas fa-check me-1"></i> Selesai
                            </x-admin.button>
                            <x-admin.button type="button" variant="danger"
                                wire:click="updateStatus({{ $selectedPengaduan->id }}, 'ditolak')">
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