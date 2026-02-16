<div>
    <x-admin.page-header title="Laporan Pengaduan" subtitle="Pantau dan cetak laporan pengaduan masyarakat" />

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <x-admin.stat-card icon="fas fa-bullhorn" label="Total Pengaduan" :value="$stats['total']"
                trend-value="Semua laporan" variant="primary" />
        </div>
        <div class="col-6 col-md-3">
            <x-admin.stat-card icon="fas fa-clock" label="Pending" :value="$stats['pending']"
                trend-value="Belum diproses" variant="warning" />
        </div>
        <div class="col-6 col-md-3">
            <x-admin.stat-card icon="fas fa-check-circle" label="Selesai" :value="$stats['selesai']"
                trend-value="Sudah ditangani" variant="success" />
        </div>
        <div class="col-6 col-md-3">
            <x-admin.stat-card icon="fas fa-times-circle" label="Ditolak" :value="$stats['ditolak']"
                trend-value="Tidak valid/Ditolak" variant="danger" />
        </div>
    </div>

    <div class="modern-card">
        <div
            class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-4 gap-3">
            <h5 class="mb-0" style="color: var(--text-primary); font-weight: 600;">Daftar Pengaduan</h5>

            <div class="d-flex flex-column flex-md-row gap-2 flex-wrap">
                {{-- Date Filter --}}
                <div class="d-flex gap-2">
                    <input type="date" class="form-control" wire:model.live="startDate" title="Dari Tanggal"
                        style="max-width: 150px;">
                    <span class="align-self-center text-muted">-</span>
                    <input type="date" class="form-control" wire:model.live="endDate" title="Sampai Tanggal"
                        style="max-width: 150px;">
                </div>

                {{-- Status Filter --}}
                <select class="form-select" wire:model.live="filterStatus" style="min-width: 150px;">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $statusOption)
                        <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                    @endforeach
                </select>

                {{-- Search --}}
                <div class="input-group" style="max-width: 250px;">
                    <span class="input-group-text"
                        style="background: var(--input-bg); border-color: var(--border-color);">
                        <i class="fas fa-search" style="color: var(--text-muted);"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari..."
                        wire:model.live.debounce.300ms="search" style="border-left: none;">
                </div>

                {{-- Print Button --}}
                <a href="{{ route('kepala-desa.pengaduan.print', ['status' => $filterStatus, 'start' => $startDate, 'end' => $endDate]) }}"
                    target="_blank" class="btn btn-primary d-flex align-items-center gap-2"
                    style="white-space: nowrap;">
                    <i class="fas fa-print"></i> Cetak PDF
                </a>
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
                        <th>Petugas</th>
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
                            <td style="color: var(--text-secondary);">
                                {{ Str::limit($item->isi_pengaduan, 80) }}
                            </td>
                            <td>
                                <x-admin.badge variant="{{ $item->status->color() }}" icon="{{ $item->status->icon() }}">
                                    {{ $item->status->label() }}
                                </x-admin.badge>
                            </td>
                            <td>
                                @if($item->user)
                                    <span style="font-size: 0.875rem; color: var(--text-primary);">
                                        {{ $item->user->name }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-comments mb-2" style="font-size: 2rem;"></i>
                                    <p class="mb-0">Tidak ada data pengaduan</p>
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
</div>