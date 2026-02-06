<div>
    <x-admin.page-header title="Manajemen Kegiatan" subtitle="Kelola kegiatan desa">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus" wire:click="openCreateModal">
                Tambah Kegiatan
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Kegiatan</h5>
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text" style="background: var(--input-bg); border-color: var(--border-color);">
                    <i class="fas fa-search" style="color: var(--text-muted);"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari kegiatan..."
                    wire:model.live.debounce.300ms="search" style="border-left: none;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Periode</th>
                        <th>Progres</th>
                        <th>PJ</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kegiatans as $item)
                        <tr wire:key="kegiatan-{{ $item->id }}">
                            <td>
                                <div style="color: var(--text-primary); font-weight: 500;">{{ $item->nama_kegiatan }}</div>
                                <small style="color: var(--text-muted);">{{ Str::limit($item->deskripsi, 50) }}</small>
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $item->tanggal_mulai->format('d M') }} - {{ $item->tanggal_selesai->format('d M Y') }}
                            </td>
                            <td style="min-width: 150px;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 8px; background: var(--border-color);">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $item->progres }}%; background: {{ $item->progres >= 100 ? 'var(--success-color)' : 'var(--primary-color)' }};"
                                            aria-valuenow="{{ $item->progres }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small style="color: var(--text-muted); min-width: 35px;">{{ $item->progres }}%</small>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">{{ $item->user->name ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="action-btn action-btn-edit" wire:click="openEditModal({{ $item->id }})"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn action-btn-delete" wire:click="confirmDelete({{ $item->id }})"
                                        title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-alt mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Belum ada kegiatan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kegiatans->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $kegiatans->links() }}
            </div>
        @endif
    </div>

    @if ($showModal)
        <div class="modal-backdrop-custom" wire:click.self="closeModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        {{ $editingId ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan <span
                                style="color: var(--danger-color);">*</span></label>
                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            id="nama_kegiatan" wire:model="nama_kegiatan" placeholder="Masukkan nama kegiatan">
                        @error('nama_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                id="tanggal_mulai" wire:model="tanggal_mulai">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                id="tanggal_selesai" wire:model="tanggal_selesai">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="progres" class="form-label">Progres ({{ $progres }}%)</label>
                        <input type="range" class="form-range" id="progres" wire:model.live="progres" min="0" max="100">
                        @error('progres')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi <span
                                style="color: var(--danger-color);">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                            wire:model="deskripsi" placeholder="Deskripsi kegiatan..." rows="4"></textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Kegiatan' }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-admin.confirm-modal :show="$showDeleteModal" title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus kegiatan ini?" on-confirm="delete" on-cancel="cancelDelete"
        variant="danger" icon="fas fa-exclamation-triangle">
        <x-slot:confirmButton>
            <i class="fas fa-trash-alt me-2"></i>Hapus
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>