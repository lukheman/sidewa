<div>
    <x-admin.page-header title="Manajemen Jenis Surat" subtitle="Kelola master data jenis surat">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus" wire:click="openCreateModal">
                Tambah Jenis Surat
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
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Jenis Surat</h5>
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text" style="background: var(--input-bg); border-color: var(--border-color);">
                    <i class="fas fa-search" style="color: var(--text-muted);"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari jenis surat..."
                    wire:model.live.debounce.300ms="search" style="border-left: none;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Surat</th>
                        <th>Keterangan</th>
                        <th>Template</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenisSurats as $index => $item)
                        <tr wire:key="jenis-surat-{{ $item->id }}">
                            <td style="color: var(--text-muted);">{{ $jenisSurats->firstItem() + $index }}</td>
                            <td style="color: var(--text-primary); font-weight: 500;">{{ $item->nama_surat }}</td>
                            <td style="color: var(--text-secondary);">{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                @if($item->file_template)
                                    <x-admin.badge variant="success" icon="fas fa-file-word">Tersedia</x-admin.badge>
                                @else
                                    <x-admin.badge variant="danger" icon="fas fa-times">Belum Ada</x-admin.badge>
                                @endif
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
                                    <i class="fas fa-file-alt mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Belum ada jenis surat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($jenisSurats->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $jenisSurats->links() }}
            </div>
        @endif
    </div>

    @if ($showModal)
        <div class="modal-backdrop-custom" wire:click.self="closeModal">
            <div class="modal-content-custom" wire:click.stop>
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        {{ $editingId ? 'Edit Jenis Surat' : 'Tambah Jenis Surat Baru' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="nama_surat" class="form-label">Nama Surat <span
                                style="color: var(--danger-color);">*</span></label>
                        <input type="text" class="form-control @error('nama_surat') is-invalid @enderror" id="nama_surat"
                            wire:model="nama_surat" placeholder="Contoh: Surat Keterangan Domisili">
                        @error('nama_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            wire:model="keterangan" placeholder="Deskripsi jenis surat" rows="3"></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file_template" class="form-label">Template Word (.docx)</label>
                        <input type="file" class="form-control @error('file_template') is-invalid @enderror" id="file_template"
                            wire:model="file_template" accept=".docx">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah template. Variabel yang didukung: ${nomor_surat}, ${nama_pemohon}, ${nik_pemohon}, ${alamat_pemohon}, dll.</small>
                        @error('file_template')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div wire:loading wire:target="file_template" class="text-primary mt-2">
                            <i class="fas fa-spinner fa-spin me-1"></i> Mengunggah file...
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            <span>Form Fields Dinamis <span class="text-muted" style="font-size: 0.8rem;">(Opsional)</span></span>
                            <button type="button" wire:click="addField" class="btn btn-sm btn-outline-primary" style="padding: 4px 10px; font-size: 0.8rem;">
                                <i class="fas fa-plus"></i> Tambah Field
                            </button>
                        </label>
                        <div class="p-3 custom-scrollbar" style="background: var(--bg-tertiary); border-radius: 8px; border: 1px solid var(--border-color); max-height: 350px; overflow-y: auto;">
                            @foreach($form_fields as $index => $field)
                                <div class="row g-2 mb-3 align-items-end" style="border-bottom: 1px dashed var(--border-color); padding-bottom: 10px;">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 0.8rem;">Label (Yang tampil ke warga)</label>
                                        <input type="text" class="form-control form-control-sm" wire:model="form_fields.{{ $index }}.label" placeholder="Contoh: Nama Usaha">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 0.8rem;">Variabel di Word (Tanpa $)</label>
                                        <input type="text" class="form-control form-control-sm" wire:model="form_fields.{{ $index }}.name" placeholder="Contoh: nama_usaha">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 0.8rem;">Tipe Input</label>
                                        <select class="form-select form-select-sm" wire:model="form_fields.{{ $index }}.type">
                                            <option value="text">Teks Singkat</option>
                                            <option value="textarea">Teks Panjang</option>
                                            <option value="number">Angka</option>
                                            <option value="date">Tanggal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" wire:click="removeField({{ $index }})" class="btn btn-sm btn-outline-danger w-100" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    @error('form_fields.'.$index.'.name') <div class="col-12 mt-1 text-danger" style="font-size: 0.75rem;">Nama Variabel: {{ $message }}</div> @enderror
                                    @error('form_fields.'.$index.'.label') <div class="col-12 mt-1 text-danger" style="font-size: 0.75rem;">Label: {{ $message }}</div> @enderror
                                </div>
                            @endforeach
                            
                            @if(count($form_fields) === 0)
                                <div class="text-center text-muted" style="font-size: 0.85rem;">
                                    <i class="fas fa-info-circle mb-1"></i>
                                    <p class="mb-0">Belum ada field tambahan.</p>
                                    <small>Gunakan fitur ini jika jenis surat membutuhkan input spesifik selain data diri pemohon.</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Jenis Surat' }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-admin.confirm-modal :show="$showDeleteModal" :title="$forceDeleteMode ? 'Peringatan!' : 'Konfirmasi Hapus'"
        :message="$forceDeleteMode
        ? 'Jenis surat ini memiliki ' . $relatedCount . ' pengajuan surat yang terkait. Apakah Anda tetap ingin menghapus jenis surat ini? Semua pengajuan surat yang menggunakan jenis ini akan ikut terhapus.'
        : 'Apakah Anda yakin ingin menghapus jenis surat ini?'" on-confirm="delete" on-cancel="cancelDelete"
        variant="danger" icon="fas fa-exclamation-triangle">
        <x-slot:confirmButton>
            @if($forceDeleteMode)
                <i class="fas fa-trash-alt me-2"></i>Ya, Hapus Semua
            @else
                <i class="fas fa-trash-alt me-2"></i>Hapus
            @endif
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>