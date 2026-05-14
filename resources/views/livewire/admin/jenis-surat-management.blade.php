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
            <div class="modal-content-custom" wire:click.stop style="max-width: 1000px; width: 95%; max-height: 90vh; overflow-y: auto;">
                <div class="modal-header-custom" style="position: sticky; top: 0; background: var(--bg-secondary, #fff); z-index: 10; border-bottom: 1px solid var(--border-color); margin-bottom: 15px; padding-bottom: 15px;">
                    <h5 class="modal-title-custom mb-0">
                        {{ $editingId ? 'Edit Jenis Surat' : 'Tambah Jenis Surat Baru' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="row">

                        <!-- Kolom Kiri: Informasi Dasar -->
                        <div class="col-md-5 ps-md-4">
                            <h6 class="fw-bold mb-3 pb-2" style="color: var(--text-primary); border-bottom: 1px solid var(--border-color);">Informasi Dasar Surat</h6>
                            <div class="mb-3">
                                <label for="nama_surat" class="form-label fw-semibold">Nama Surat <span
                                        style="color: var(--danger-color);">*</span></label>
                                <input type="text" class="form-control @error('nama_surat') is-invalid @enderror" id="nama_surat"
                                    wire:model="nama_surat" placeholder="Contoh: Surat Keterangan Domisili">
                                @error('nama_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    wire:model="keterangan" placeholder="Deskripsi jenis surat" rows="3"></textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="file_template" class="form-label fw-semibold">Template Word (.docx)</label>
                                <input type="file" class="form-control @error('file_template') is-invalid @enderror" id="file_template"
                                    wire:model="file_template" accept=".docx">
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin mengubah template saat mengedit.
                                </small>
                                @error('file_template')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div wire:loading wire:target="file_template" class="text-primary mt-2">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Mengunggah file...
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Form Fields Dinamis -->
                        <div class="col-md-7 mb-4 mb-md-0 pe-md-4">
                            <label class="form-label d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold" style="color: var(--text-primary);">Form Fields Dinamis <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Opsional)</span></span>

                        <x-admin.button type="button" variant="primary" size="sm" wire:click="addField">
                                <i class="fas fa-plus"></i> Tambah Field
                        </x-admin.button>
                            </label>

                            <div class="alert alert-info mb-3" style="font-size: 0.85rem; padding: 12px; border-radius: 8px; background-color: rgba(13, 110, 253, 0.05); border-color: rgba(13, 110, 253, 0.2);">
                                <h6 class="alert-heading fw-bold mb-2" style="font-size: 0.9rem; color: #0d6efd;">
                                    <i class="fas fa-info-circle me-1"></i> Panduan Variabel Template Word
                                </h6>
                                <p class="mb-2 text-dark">Gunakan variabel ini di template Word Anda. Sistem otomatis mengisi data pemohon ke dalam variabel berikut (tanpa perlu ditambah di form dinamis):</p>
                                <div class="row g-1 mb-2">
                                    <div class="col-6">
                                        <ul class="mb-0 ps-3 text-dark" style="font-size: 0.8rem;">
                                            <li><code>${nomor_surat}</code></li>
                                            <li><code>${tanggal_surat}</code></li>
                                            <li><code>${nama_pemohon}</code></li>
                                            <li><code>${nik_pemohon}</code></li>
                                            <li><code>${tempat_lahir_pemohon}</code></li>
                                            <li><code>${tanggal_lahir_pemohon}</code></li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="mb-0 ps-3 text-dark" style="font-size: 0.8rem;">
                                            <li><code>${jenis_kelamin_pemohon}</code></li>
                                            <li><code>${agama_pemohon}</code></li>
                                            <li><code>${pekerjaan_pemohon}</code></li>
                                            <li><code>${alamat_pemohon}</code></li>
                                            <li><code>${desa_pemohon}</code></li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-2" style="border-color: rgba(13, 110, 253, 0.2);">
                                <p class="mb-0 text-dark">
                                    <strong>Field Tambahan:</strong> Jika butuh input khusus, tambahkan field di bawah. Ketik nama variabel (misal: <code>keperluan</code>) lalu tulis di Word <code>${keperluan}</code>.
                                </p>
                            </div>

                            <div class="p-3 custom-scrollbar" style="background: var(--bg-tertiary); border-radius: 8px; border: 1px solid var(--border-color); max-height: 300px; overflow-y: auto;">
                                @foreach($form_fields as $index => $field)
                                    <div class="row g-2 mb-3 align-items-end" style="border-bottom: 1px dashed var(--border-color); padding-bottom: 10px;">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="font-size: 0.8rem;">Label <small class="text-muted">(Tampil ke warga)</small></label>
                                            <input type="text" class="form-control form-control-sm" wire:model="form_fields.{{ $index }}.label" placeholder="Contoh: Keperluan">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="font-size: 0.8rem;">Variabel Word <small class="text-muted">(Tanpa $)</small></label>
                                            <input type="text" class="form-control form-control-sm" wire:model="form_fields.{{ $index }}.name" placeholder="Contoh: keperluan">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold" style="font-size: 0.8rem;">Tipe Input</label>
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
                                    <div class="text-center text-muted py-4" style="font-size: 0.85rem;">
                                        <i class="fas fa-list-alt mb-2" style="font-size: 2rem; opacity: 0.5;"></i>
                                        <p class="mb-0 fw-medium">Belum ada field tambahan.</p>
                                        <small class="d-block mt-1">Klik tombol "Tambah Field" jika ada informasi spesifik yang harus diinput oleh warga.</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="position: sticky; bottom: 0; background: var(--bg-secondary, #fff); z-index: 10; border-top: 1px solid var(--border-color); padding-top: 15px; margin-top: 0;">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            <i class="fas fa-save me-1"></i> {{ $editingId ? 'Simpan Perubahan' : 'Tambah Jenis Surat' }}
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
