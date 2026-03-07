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

                    {{-- Foto Dokumentasi --}}
                    <div class="mb-4">
                        <label class="form-label">Dokumentasi Foto <small class="text-muted">(Opsional, maks. 3 foto)</small></label>

                        {{-- Existing Photos --}}
                        @if(!empty($existingFoto))
                            <div class="d-flex gap-2 flex-wrap mb-2">
                                @foreach($existingFoto as $index => $path)
                                    <div style="position: relative; width: 100px; height: 100px;">
                                        <img src="{{ Storage::url($path) }}" alt="Foto {{ $index + 1 }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; border: 2px solid var(--border-color);">
                                        <button type="button" wire:click="removeExistingFoto({{ $index }})"
                                            style="position: absolute; top: -6px; right: -6px; background: var(--danger-color); color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- New Photo Upload --}}
                        @if(count($existingFoto) + count($foto) < 3)
                            <input type="file" class="form-control @error('foto.*') is-invalid @enderror"
                                wire:model="foto" accept="image/*" multiple>
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks. 2MB per foto. Sisa: {{ 3 - count($existingFoto) - count($foto) }} foto.</small>
                            @error('foto.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        @else
                            <div class="alert alert-info py-2 small mb-0">
                                <i class="fas fa-info-circle me-1"></i>Batas maksimal 3 foto sudah tercapai.
                            </div>
                        @endif

                        {{-- Preview New Uploads --}}
                        @if(!empty($foto))
                            <div class="d-flex gap-2 flex-wrap mt-2">
                                @foreach($foto as $index => $file)
                                    <div style="position: relative; width: 100px; height: 100px;">
                                        <img src="{{ $file->temporaryUrl() }}" alt="Preview"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; border: 2px dashed var(--primary-color);">
                                        <button type="button" wire:click="removeFoto({{ $index }})"
                                            style="position: absolute; top: -6px; right: -6px; background: var(--danger-color); color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
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