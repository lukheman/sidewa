<div>
    <x-admin.page-header title="Manajemen Pengajuan Surat" subtitle="Kelola pengajuan surat warga">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus" wire:click="openCreateModal">
                Tambah Pengajuan
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Pengajuan Surat</h5>
            <div class="d-flex gap-2 flex-wrap">
                <select class="form-select" wire:model.live="filterStatus" style="min-width: 150px;">
                    <option value="">Semua Status</option>
                    <option value="diajukan">Diajukan</option>
                    <option value="diproses">Diproses</option>
                    <option value="siap_ambil">Siap Diambil</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text" style="background: var(--input-bg); border-color: var(--border-color);">
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
                        <th style="width: 120px;">Aksi</th>
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
                                <div style="color: var(--text-primary); font-weight: 500;">{{ $item->masyarakat->nama ?? '-' }}</div>
                                <small style="color: var(--text-muted);">{{ $item->masyarakat->nik ?? '' }}</small>
                            </td>
                            <td style="color: var(--text-secondary);">{{ $item->jenisSurat->nama_surat ?? '-' }}</td>
                            <td>
                                @switch($item->status)
                                    @case('diajukan')
                                        <x-admin.badge variant="secondary" icon="fas fa-paper-plane">Diajukan</x-admin.badge>
                                        @break
                                    @case('diproses')
                                        <x-admin.badge variant="info" icon="fas fa-spinner">Diproses</x-admin.badge>
                                        @break
                                    @case('siap_ambil')
                                        <x-admin.badge variant="primary" icon="fas fa-inbox">Siap Diambil</x-admin.badge>
                                        @break
                                    @case('selesai')
                                        <x-admin.badge variant="success" icon="fas fa-check">Selesai</x-admin.badge>
                                        @break
                                    @case('ditolak')
                                        <x-admin.badge variant="danger" icon="fas fa-times">Ditolak</x-admin.badge>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="action-btn action-btn-edit" wire:click="openEditModal({{ $item->id }})" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn action-btn-delete" wire:click="confirmDelete({{ $item->id }})" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-file-alt mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Belum ada pengajuan surat</p>
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

    @if ($showModal)
        <div class="modal-backdrop-custom" wire:click.self="closeModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        {{ $editingId ? 'Edit Pengajuan Surat' : 'Tambah Pengajuan Surat Baru' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="masyarakat_id" class="form-label">Pemohon <span style="color: var(--danger-color);">*</span></label>
                        <select class="form-select @error('masyarakat_id') is-invalid @enderror" id="masyarakat_id" wire:model="masyarakat_id">
                            <option value="">Pilih Pemohon</option>
                            @foreach($masyarakats as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }} - {{ $m->nik }}</option>
                            @endforeach
                        </select>
                        @error('masyarakat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_surat_id" class="form-label">Jenis Surat <span style="color: var(--danger-color);">*</span></label>
                        <select class="form-select @error('jenis_surat_id') is-invalid @enderror" id="jenis_surat_id" wire:model="jenis_surat_id">
                            <option value="">Pilih Jenis Surat</option>
                            @foreach($jenisSurats as $js)
                                <option value="{{ $js->id }}">{{ $js->nama_surat }}</option>
                            @endforeach
                        </select>
                        @error('jenis_surat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_pengajuan" class="form-label">Tanggal <span style="color: var(--danger-color);">*</span></label>
                            <input type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" id="tanggal_pengajuan"
                                wire:model="tanggal_pengajuan">
                            @error('tanggal_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span style="color: var(--danger-color);">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" wire:model="status">
                                <option value="diajukan">Diajukan</option>
                                <option value="diproses">Diproses</option>
                                <option value="siap_ambil">Siap Diambil</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            wire:model="keterangan" placeholder="Keterangan tambahan (opsional)..." rows="3"></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Pengajuan' }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-admin.confirm-modal
        :show="$showDeleteModal"
        title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus pengajuan surat ini?"
        on-confirm="delete"
        on-cancel="cancelDelete"
        variant="danger"
        icon="fas fa-exclamation-triangle"
    >
        <x-slot:confirmButton>
            <i class="fas fa-trash-alt me-2"></i>Hapus
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>
