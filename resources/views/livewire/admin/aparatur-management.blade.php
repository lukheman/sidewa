<div>
    <x-admin.page-header title="Manajemen Struktur Organisasi" subtitle="Kelola data aparatur desa">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus" wire:click="openCreateModal">
                Tambah Aparatur
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
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Aparatur Desa</h5>
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text" style="background: var(--input-bg); border-color: var(--border-color);">
                    <i class="fas fa-search" style="color: var(--text-muted);"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari nama atau jabatan..."
                    wire:model.live.debounce.300ms="search" style="border-left: none;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th style="width: 80px;">Urutan</th>
                        <th>Pegawai</th>
                        <th>Jabatan</th>
                        <th>NIP</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aparaturList as $item)
                        <tr wire:key="aparatur-{{ $item->id }}">
                            <td class="text-center font-weight-bold">{{ $item->urutan }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        style="width: 45px; height: 45px; border-radius: 50%; overflow: hidden; background: var(--bg-light); display: flex; align-items: center; justify-content: center; border: 2px solid var(--border-color);">
                                        @if($item->foto)
                                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user text-muted" style="font-size: 1.2rem;"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="color: var(--text-primary); font-weight: 600; font-size: 0.95rem;">
                                            {{ $item->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span
                                    style="background: var(--bg-light); color: var(--primary-color); padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    {{ $item->jabatan }}
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $item->nip ?: '-' }}
                            </td>
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
                                    <i class="fas fa-sitemap mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Belum ada data struktur organisasi</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($aparaturList->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $aparaturList->links() }}
            </div>
        @endif
    </div>

    @if ($showModal)
        <div class="modal-backdrop-custom" wire:click.self="closeModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        {{ $editingId ? 'Edit Data Aparatur' : 'Tambah Aparatur Baru' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="nama" class="form-label">Nama Lengkap <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                wire:model="nama" placeholder="Contoh: Budi Santoso, S.E.">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="urutan" class="form-label">Urutan <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan"
                                wire:model="urutan" min="1">
                            @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted" style="font-size: 0.75rem;">1 = Paling atas</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                wire:model="jabatan" placeholder="Contoh: Kepala Desa">
                            @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP <small class="text-muted">(Opsional)</small></label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                wire:model="nip" placeholder="Nomor Induk Pegawai">
                            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto Profil <small class="text-muted">(Opsional)</small></label>

                        <div class="d-flex gap-3 align-items-end">
                            <div
                                style="width: 100px; height: 100px; border-radius: 12px; border: 2px dashed var(--border-color); display: flex; align-items: center; justify-content: center; overflow: hidden; background: var(--bg-light); position: relative;">
                                @if($foto)
                                    <img src="{{ $foto->temporaryUrl() }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    <button type="button" wire:click="removeFoto"
                                        style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                        <i class="fas fa-times" style="font-size: 0.7rem;"></i>
                                    </button>
                                @elseif($existingFoto)
                                    <img src="{{ Storage::url($existingFoto) }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    <button type="button" wire:click="removeExistingFoto"
                                        style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                        <i class="fas fa-times" style="font-size: 0.7rem;"></i>
                                    </button>
                                @else
                                    <i class="fas fa-user" style="font-size: 2rem; color: var(--text-muted);"></i>
                                @endif
                            </div>

                            <div class="flex-grow-1">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                    wire:model="foto" accept="image/*">
                                <small class="text-muted d-block mt-1">Format: JPG, PNG, GIF. Maks: 2MB.</small>
                                @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Aparatur' }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-admin.confirm-modal :show="$showDeleteModal" title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus data aparatur ini?" on-confirm="delete" on-cancel="cancelDelete"
        variant="danger" icon="fas fa-exclamation-triangle">
        <x-slot:confirmButton>
            <i class="fas fa-trash-alt me-2"></i>Hapus
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>