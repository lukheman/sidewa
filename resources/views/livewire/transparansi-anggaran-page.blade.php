<div>
    {{-- Header Section --}}
    <section style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 8rem 0 4rem;">
        <div class="container">
            <div class="text-center">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem;">
                    <i class="fas fa-chart-pie me-2" style="color: var(--primary-color);"></i>Penggunaan Anggaran Desa
                </h1>
                <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto 2rem;">
                    Informasi alokasi anggaran pendapatan dan belanja desa secara terbuka untuk seluruh warga
                </p>
                {{-- Year Selector --}}
                <div class="d-flex justify-content-center">
                    <select wire:model.live="selectedTahun" class="form-select"
                        style="max-width: 200px; border: 2px solid var(--border-color); border-radius: 12px; padding: 0.75rem 1rem; font-size: 1rem; font-weight: 600; text-align: center;">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}">Tahun {{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- Summary Cards --}}
    <section style="padding: 3rem 0 1rem; background: white;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div
                        style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); border-radius: 16px; padding: 2rem; text-align: center; border: 1px solid #93c5fd;">
                        <div
                            style="width: 56px; height: 56px; border-radius: 50%; background: rgba(34,197,94,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-arrow-down" style="color: #22c55e; font-size: 1.3rem;"></i>
                        </div>
                        <h5
                            style="color: #6b7280; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Total Pendapatan</h5>
                        <h2 style="color: #22c55e; font-size: 1.5rem; font-weight: 800;">Rp
                            {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div
                        style="background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%); border-radius: 16px; padding: 2rem; text-align: center; border: 1px solid #fca5a5;">
                        <div
                            style="width: 56px; height: 56px; border-radius: 50%; background: rgba(239,68,68,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-arrow-up" style="color: #ef4444; font-size: 1.3rem;"></i>
                        </div>
                        <h5
                            style="color: #6b7280; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Total Belanja</h5>
                        <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 800;">Rp
                            {{ number_format($totalBelanja, 0, ',', '.') }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div
                        style="background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%); border-radius: 16px; padding: 2rem; text-align: center; border: 1px solid #93c5fd;">
                        <div
                            style="width: 56px; height: 56px; border-radius: 50%; background: rgba(59,130,246,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-balance-scale" style="color: #3b82f6; font-size: 1.3rem;"></i>
                        </div>
                        <h5
                            style="color: #6b7280; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Selisih (Sisa)</h5>
                        <h2
                            style="color: {{ $selisih >= 0 ? '#3b82f6' : '#ef4444' }}; font-size: 1.5rem; font-weight: 800;">
                            Rp {{ number_format($selisih, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Chart & Tables --}}
    <section style="padding: 3rem 0; background: white;">
        <div class="container">
            <div class="row g-4">
                {{-- Belanja Chart --}}
                <div class="col-lg-5">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; height: 100%;">
                        <h4
                            style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                            <i class="fas fa-chart-pie me-2" style="color: var(--primary-color);"></i>Komposisi Belanja
                        </h4>
                        @if(count($chartLabels) > 0)
                            <div style="max-width: 350px; margin: 0 auto;">
                                <canvas id="belanjaChart" wire:ignore></canvas>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-chart-pie mb-2" style="font-size: 2.5rem; color: var(--border-color);"></i>
                                <p style="color: var(--text-muted);">Belum ada data belanja</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tables --}}
                <div class="col-lg-7">
                    {{-- Pendapatan Table --}}
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; margin-bottom: 1.5rem;">
                        <h4
                            style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.25rem;">
                            <i class="fas fa-arrow-circle-down me-2" style="color: #22c55e;"></i>Pendapatan
                        </h4>
                        @if($pendapatan->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--border-color);">
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem;">
                                                No</th>
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem;">
                                                Uraian</th>
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem; text-align: right;">
                                                Jumlah (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendapatan as $i => $item)
                                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                                <td style="padding: 0.75rem; color: var(--text-secondary);">{{ $i + 1 }}</td>
                                                <td style="padding: 0.75rem; font-weight: 500; color: var(--text-primary);">
                                                    {{ $item->uraian }}</td>
                                                <td
                                                    style="padding: 0.75rem; text-align: right; font-weight: 600; color: #22c55e;">
                                                    {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr style="background: #f0f9ff;">
                                            <td colspan="2"
                                                style="padding: 0.75rem; font-weight: 700; color: var(--text-primary);">
                                                Total Pendapatan</td>
                                            <td
                                                style="padding: 0.75rem; text-align: right; font-weight: 800; color: #22c55e; font-size: 1.05rem;">
                                                {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p style="color: var(--text-muted); text-align: center; padding: 1rem 0;">Belum ada data
                                pendapatan</p>
                        @endif
                    </div>

                    {{-- Belanja Table --}}
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem;">
                        <h4
                            style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.25rem;">
                            <i class="fas fa-arrow-circle-up me-2" style="color: #ef4444;"></i>Belanja
                        </h4>
                        @if($belanja->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--border-color);">
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem;">
                                                No</th>
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem;">
                                                Uraian</th>
                                            <th
                                                style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem; text-align: right;">
                                                Jumlah (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($belanja as $i => $item)
                                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                                <td style="padding: 0.75rem; color: var(--text-secondary);">{{ $i + 1 }}</td>
                                                <td style="padding: 0.75rem; font-weight: 500; color: var(--text-primary);">
                                                    {{ $item->uraian }}</td>
                                                <td
                                                    style="padding: 0.75rem; text-align: right; font-weight: 600; color: #ef4444;">
                                                    {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr style="background: #fef2f2;">
                                            <td colspan="2"
                                                style="padding: 0.75rem; font-weight: 700; color: var(--text-primary);">
                                                Total Belanja</td>
                                            <td
                                                style="padding: 0.75rem; text-align: right; font-weight: 800; color: #ef4444; font-size: 1.05rem;">
                                                {{ number_format($totalBelanja, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p style="color: var(--text-muted); text-align: center; padding: 1rem 0;">Belum ada data belanja
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Back to Home --}}
    <section style="padding: 3rem 0; background: var(--bg-light); text-align: center;">
        <a href="{{ route('home') }}"
            style="color: var(--primary-color); text-decoration: none; font-weight: 600; font-size: 1rem;">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
        </a>
    </section>

    {{-- Chart.js --}}
    @if(count($chartLabels) > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const colors = [
                    '#0ea5e9', '#06b6d4', '#06b6d4', '#3b82f6', '#8b5cf6',
                    '#ec4899', '#f59e0b', '#ef4444', '#6366f1', '#84cc16',
                    '#f97316', '#0ea5e9'
                ];

                const labels = @json($chartLabels);
                const values = @json($chartValues);

                new Chart(document.getElementById('belanjaChart'), {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: colors.slice(0, labels.length),
                            borderWidth: 2,
                            borderColor: '#fff',
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 16,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { family: 'Inter', size: 12 }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let value = context.parsed;
                                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        let pct = ((value / total) * 100).toFixed(1);
                                        return context.label + ': Rp ' + value.toLocaleString('id-ID') + ' (' + pct + '%)';
                                    }
                                }
                            }
                        },
                        cutout: '55%'
                    }
                });
            });
        </script>
    @endif
</div>
