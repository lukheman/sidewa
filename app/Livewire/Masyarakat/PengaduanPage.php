<?php

namespace App\Livewire\Masyarakat;

use App\Enum\StatusPengaduan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Pengaduan Saya - Portal Masyarakat SIDEWA')]
class PengaduanPage extends Component
{
    use WithPagination;

    public bool $showDetailModal = false;
    public ?Pengaduan $selectedPengaduan = null;

    public string $filterStatus = '';

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function viewDetail(int $id): void
    {
        $this->selectedPengaduan = Pengaduan::with('user')
            ->where('masyarakat_id', Auth::guard('masyarakat')->id())
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedPengaduan = null;
    }

    public function render()
    {
        $masyarakatId = Auth::guard('masyarakat')->id();

        $pengaduans = Pengaduan::query()
            ->where('masyarakat_id', $masyarakatId)
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengaduan', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Pengaduan::where('masyarakat_id', $masyarakatId)->count(),
            'pending' => Pengaduan::where('masyarakat_id', $masyarakatId)->where('status', StatusPengaduan::PENDING)->count(),
            'proses' => Pengaduan::where('masyarakat_id', $masyarakatId)->where('status', StatusPengaduan::PROSES)->count(),
            'selesai' => Pengaduan::where('masyarakat_id', $masyarakatId)->where('status', StatusPengaduan::SELESAI)->count(),
        ];

        return view('livewire.masyarakat.pengaduan', [
            'pengaduans' => $pengaduans,
            'stats' => $stats,
            'statuses' => StatusPengaduan::cases(),
        ]);
    }
}
