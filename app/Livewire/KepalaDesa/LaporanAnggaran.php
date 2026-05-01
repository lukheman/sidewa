<?php

namespace App\Livewire\KepalaDesa;

use App\Models\AnggaranDesa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Laporan Anggaran Desa - Kepala Desa')]
class LaporanAnggaran extends Component
{
    #[Url(as: 'tahun')]
    public string $filterTahun = '';

    public function mount(): void
    {
        if (empty($this->filterTahun)) {
            $this->filterTahun = (string) date('Y');
        }
    }

    public function updatedFilterTahun(): void
    {
        // No need to reset page, we'll list all for the year
    }

    public function render()
    {
        $availableYears = AnggaranDesa::selectRaw('DISTINCT tahun_anggaran')
            ->orderByDesc('tahun_anggaran')
            ->pluck('tahun_anggaran')
            ->toArray();

        if (!in_array((int) date('Y'), $availableYears)) {
            array_unshift($availableYears, (int) date('Y'));
        }

        $pendapatan = AnggaranDesa::where('tahun_anggaran', $this->filterTahun)
            ->where('kategori', 'pendapatan')
            ->orderBy('uraian')
            ->get();

        $belanja = AnggaranDesa::where('tahun_anggaran', $this->filterTahun)
            ->where('kategori', 'belanja')
            ->orderBy('uraian')
            ->get();

        $totalPendapatan = $pendapatan->sum('jumlah');
        $totalBelanja = $belanja->sum('jumlah');
        $selisih = $totalPendapatan - $totalBelanja;

        return view('livewire.kepala-desa.laporan-anggaran', [
            'availableYears' => $availableYears,
            'pendapatan' => $pendapatan,
            'belanja' => $belanja,
            'totalPendapatan' => $totalPendapatan,
            'totalBelanja' => $totalBelanja,
            'selisih' => $selisih,
        ]);
    }
}
