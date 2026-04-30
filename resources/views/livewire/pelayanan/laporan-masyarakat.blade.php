<div>
    <x-admin.page-header title="Laporan Data Masyarakat" subtitle="Laporan dan statistik data penduduk terdaftar" />

    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Filter Laporan</h5>
                    <a href="{{ route('pelayanan.laporan-masyarakat.print', ['q' => $search, 'jk' => $jenisKelamin]) }}" 
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
                                placeholder="Cari NIK, Nama, atau Alamat...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select wire:model.live="jenisKelamin" class="form-select">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border rounded text-center h-100 d-flex align-items-center justify-content-center bg-light">
                            <strong>Total Data: {{ $totalData }} Jiwa</strong>
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
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masyarakats as $index => $item)
                        <tr>
                            <td>{{ $masyarakats->firstItem() + $index }}</td>
                            <td style="color: var(--text-primary); font-weight: 500;">{{ $item->nik }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">{{ $item->initials() }}</div>
                                    <span style="color: var(--text-primary);">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : ($item->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-admin.empty-state icon="fas fa-users" title="Tidak ada data masyarakat" 
                                    message="Data tidak ditemukan atau belum ada masyarakat yang terdaftar." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $masyarakats->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
