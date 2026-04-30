<div>
    <x-admin.page-header title="Laporan Kegiatan Desa" subtitle="Pemantauan progres dan dokumentasi kegiatan desa" />

    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Filter Laporan</h5>
                    <a href="{{ route('kepala-desa.laporan-kegiatan.print', ['q' => $search, 'status' => $status]) }}" 
                       target="_blank" 
                       class="btn btn-primary-modern">
                        <i class="fas fa-print me-2"></i> Cetak Laporan PDF
                    </a>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input wire:model.live.debounce.300ms="search" type="text" 
                                class="form-control border-start-0 ps-0" 
                                placeholder="Cari nama atau deskripsi...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select wire:model.live="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="belum_mulai">Belum Mulai (0%)</option>
                            <option value="berjalan">Sedang Berjalan (1-99%)</option>
                            <option value="selesai">Selesai (100%)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border rounded text-center h-100 d-flex align-items-center justify-content-center bg-light">
                            <strong>Total Kegiatan: {{ $totalData }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modern-card">
        <div class="table-responsive">
            <table class="table table-modern table-hover mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Kegiatan</th>
                        <th width="25%">Waktu Pelaksanaan</th>
                        <th width="30%">Deskripsi</th>
                        <th width="20%">Progres</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatans as $index => $item)
                        <tr>
                            <td>{{ $kegiatans->firstItem() + $index }}</td>
                            <td><strong>{{ $item->nama_kegiatan }}</strong></td>
                            <td>
                                @if($item->tanggal_mulai)
                                    <small>Mulai: {{ $item->tanggal_mulai->format('d M Y') }}</small><br>
                                @endif
                                @if($item->tanggal_selesai)
                                    <small>Selesai: {{ $item->tanggal_selesai->format('d M Y') }}</small>
                                @endif
                            </td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar {{ $item->progres >= 100 ? 'bg-success' : 'bg-primary' }}" 
                                             role="progressbar" 
                                             style="width: {{ $item->progres }}%;" 
                                             aria-valuenow="{{ $item->progres }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                    <span style="font-size: 0.85rem; font-weight: 600;">{{ $item->progres }}%</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <x-admin.empty-state icon="fas fa-calendar-alt" title="Tidak ada data kegiatan" 
                                    message="Data tidak ditemukan atau belum ada kegiatan desa." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $kegiatans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
