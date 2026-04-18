<?php

namespace App\Livewire;

use App\Models\AnggaranDesa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('Penggunaan Anggaran Desa - SIDEWA')]
class TransparansiAnggaranPage extends Component
{
    #[Url(as: 'tahun')]
    public string $selectedTahun = '';

    public function mount(): void
    {
        if (empty($this->selectedTahun)) {
            $this->selectedTahun = (string) date('Y');
        }
    }

    public function render()
    {
        $tahun = $this->selectedTahun ?: date('Y');

        $pendapatan = AnggaranDesa::where('tahun_anggaran', $tahun)
            ->where('kategori', 'pendapatan')
            ->orderBy('jumlah', 'desc')
            ->get();

        $belanja = AnggaranDesa::where('tahun_anggaran', $tahun)
            ->where('kategori', 'belanja')
            ->orderBy('jumlah', 'desc')
            ->get();

        $totalPendapatan = $pendapatan->sum('jumlah');
        $totalBelanja = $belanja->sum('jumlah');

        $availableYears = AnggaranDesa::selectRaw('DISTINCT tahun_anggaran')
            ->orderByDesc('tahun_anggaran')
            ->pluck('tahun_anggaran')
            ->toArray();

        if (!in_array((int) date('Y'), $availableYears)) {
            array_unshift($availableYears, (int) date('Y'));
        }

        // Prepare chart data for belanja breakdown
        $chartLabels = $belanja->pluck('uraian')->toArray();
        $chartValues = $belanja->pluck('jumlah')->map(fn($v) => (float) $v)->toArray();

        return view('livewire.transparansi-anggaran-page', [
            'pendapatan' => $pendapatan,
            'belanja' => $belanja,
            'totalPendapatan' => $totalPendapatan,
            'totalBelanja' => $totalBelanja,
            'selisih' => $totalPendapatan - $totalBelanja,
            'availableYears' => $availableYears,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
        ]);
    }
}
