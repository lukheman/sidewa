<?php

namespace App\Livewire\KepalaDesa;

use App\Enum\StatusPengaduan;
use App\Models\Pengaduan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Laporan Pengaduan - Kepala Desa SIDEWA')]
class PengaduanIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    #[Url(as: 'start')]
    public string $startDate = '';

    #[Url(as: 'end')]
    public string $endDate = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatedStartDate(): void
    {
        $this->resetPage();
    }

    public function updatedEndDate(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Pengaduan::query()
            ->with(['masyarakat', 'user'])
            ->when($this->search, function ($query) {
                $query->where('isi_pengaduan', 'like', '%' . $this->search . '%')
                    ->orWhereHas('masyarakat', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->startDate, function ($query) {
                $query->whereDate('tanggal_pengaduan', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('tanggal_pengaduan', '<=', $this->endDate);
            })
            ->orderBy('tanggal_pengaduan', 'desc')
            ->paginate(10);

        // Stats for summary cards
        $stats = [
            'total' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', StatusPengaduan::PENDING)->count(),
            'proses' => Pengaduan::where('status', StatusPengaduan::PROSES)->count(),
            'selesai' => Pengaduan::where('status', StatusPengaduan::SELESAI)->count(),
            'ditolak' => Pengaduan::where('status', StatusPengaduan::DITOLAK)->count(),
        ];

        return view('livewire.kepala-desa.pengaduan-index', [
            'pengaduans' => $data,
            'stats' => $stats,
            'statuses' => StatusPengaduan::cases(),
        ]);
    }
}
