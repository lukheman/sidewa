<div>
    <x-admin.page-header title="Laporan Anggaran Desa" subtitle="Rekapitulasi pendapatan dan belanja desa per tahun anggaran" />

    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Filter Tahun Anggaran</h5>
                    <a href="{{ route('pelayanan.laporan-anggaran.print', ['tahun' => $filterTahun]) }}" 
                       target="_blank" 
                       class="btn btn-primary-modern">
                        <i class="fas fa-print me-2"></i> Cetak Laporan PDF
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <select wire:model.live="filterTahun" class="form-select">
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}">Tahun {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <x-admin.stat-card icon="fas fa-arrow-down" label="Total Pendapatan" 
                value="Rp {{ number_format($totalPendapatan, 0, ',', '.') }}" variant="success" />
        </div>
        <div class="col-md-4">
            <x-admin.stat-card icon="fas fa-arrow-up" label="Total Belanja" 
                value="Rp {{ number_format($totalBelanja, 0, ',', '.') }}" variant="danger" />
        </div>
        <div class="col-md-4">
            <x-admin.stat-card icon="fas fa-balance-scale" label="Surplus / (Defisit)" 
                value="Rp {{ number_format($selisih, 0, ',', '.') }}" 
                variant="{{ $selisih >= 0 ? 'primary' : 'warning' }}" />
        </div>
    </div>

    <div class="row">
        <!-- Pendapatan -->
        <div class="col-md-6 mb-4">
            <div class="modern-card h-100">
                <h5 class="text-success mb-4"><i class="fas fa-arrow-down me-2"></i>Pendapatan Desa</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-modern">
                        <thead>
                            <tr>
                                <th>Uraian</th>
                                <th class="text-end">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendapatan as $item)
                                <tr>
                                    <td>
                                        {{ $item->uraian }}
                                        @if($item->keterangan)
                                            <br><small class="text-muted">{{ $item->keterangan }}</small>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Belum ada data pendapatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Pendapatan</th>
                                <th class="text-end">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Belanja -->
        <div class="col-md-6 mb-4">
            <div class="modern-card h-100">
                <h5 class="text-danger mb-4"><i class="fas fa-arrow-up me-2"></i>Belanja Desa</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-modern">
                        <thead>
                            <tr>
                                <th>Uraian</th>
                                <th class="text-end">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($belanja as $item)
                                <tr>
                                    <td>
                                        {{ $item->uraian }}
                                        @if($item->keterangan)
                                            <br><small class="text-muted">{{ $item->keterangan }}</small>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Belum ada data belanja.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Belanja</th>
                                <th class="text-end">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
