<div>
    <x-admin.page-header title="Penggunaan Anggaran Desa" subtitle="Kelola data anggaran pendapatan dan belanja desa">
        <x-slot:actions>
            <x-admin.button variant="primary" icon="fas fa-plus" wire:click="openCreateModal">
                Tambah Anggaran
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(34,197,94,0.15);">
                    <i class="fas fa-arrow-down" style="color: #22c55e;"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Pendapatan</p>
                    <h3 class="stat-value" style="color: #22c55e;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(239,68,68,0.15);">
                    <i class="fas fa-arrow-up" style="color: #ef4444;"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Belanja</p>
                    <h3 class="stat-value" style="color: #ef4444;">Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(59,130,246,0.15);">
                    <i class="fas fa-balance-scale" style="color: #3b82f6;"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Selisih (Sisa)</p>
                    <h3 class="stat-value" style="color: {{ $selisih >= 0 ? '#3b82f6' : '#ef4444' }};">Rp
                        {{ number_format($selisih, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">
                Data Anggaran Tahun {{ $filterTahun }}
            </h5>
            <select wire:model.live="filterTahun" class="form-select" style="max-width: 160px;">
                @foreach($availableYears as $year)
                    <option value="{{ $year }}">Tahun {{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Uraian</th>
                        <th style="width: 130px;">Kategori</th>
                        <th style="width: 180px;">Jumlah (Rp)</th>
                        <th>Keterangan</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $index => $item)
                        <tr wire:key="anggaran-{{ $item->id }}">
                            <td>{{ $items->firstItem() + $index }}</td>
                            <td style="font-weight: 500; color: var(--text-primary);">{{ $item->uraian }}</td>
                            <td>
                                <span
                                    style="background: {{ $item->kategori === 'pendapatan' ? 'rgba(34,197,94,0.15)' : 'rgba(239,68,68,0.15)' }}; color: {{ $item->kategori === 'pendapatan' ? '#22c55e' : '#ef4444' }}; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: capitalize;">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td style="font-weight: 600; font-family: 'JetBrains Mono', monospace;">
                                {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td style="color: var(--text-secondary); font-size: 0.9rem;">
                                {{ $item->keterangan ?: '-' }}
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
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-chart-pie mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Belum ada data anggaran untuk tahun {{ $filterTahun }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($items->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>

    {{-- Modal Form --}}
    @if ($showModal)
        <div class="modal-backdrop-custom" wire:click.self="closeModal">
            <div class="modal-content-custom" wire:click.stop style="max-width: 600px;">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        {{ $editingId ? 'Edit Data Anggaran' : 'Tambah Data Anggaran' }}
                    </h5>
                    <button type="button" class="modal-close-btn" wire:click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tahun_anggaran" class="form-label">Tahun Anggaran <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="number" class="form-control @error('tahun_anggaran') is-invalid @enderror"
                                id="tahun_anggaran" wire:model="tahun_anggaran" min="2020" max="2099">
                            @error('tahun_anggaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori <span
                                    style="color: var(--danger-color);">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
                                wire:model="kategori">
                                <option value="pendapatan">Pendapatan</option>
                                <option value="belanja">Belanja</option>
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="uraian" class="form-label">Uraian <span
                                style="color: var(--danger-color);">*</span></label>
                        <input type="text" class="form-control @error('uraian') is-invalid @enderror" id="uraian"
                            wire:model="uraian" placeholder="Contoh: Dana Desa, Belanja Infrastruktur">
                        @error('uraian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah (Rp) <span
                                style="color: var(--danger-color);">*</span></label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                            wire:model="jumlah" min="0" step="1" placeholder="0">
                        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan <small
                                class="text-muted">(Opsional)</small></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            wire:model="keterangan" rows="2" placeholder="Catatan tambahan..."></textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <x-admin.button type="button" variant="outline" wire:click="closeModal">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Anggaran' }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-admin.confirm-modal :show="$showDeleteModal" title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus data anggaran ini?" on-confirm="delete" on-cancel="cancelDelete"
        variant="danger" icon="fas fa-exclamation-triangle">
        <x-slot:confirmButton>
            <i class="fas fa-trash-alt me-2"></i>Hapus
        </x-slot:confirmButton>
    </x-admin.confirm-modal>
</div>
