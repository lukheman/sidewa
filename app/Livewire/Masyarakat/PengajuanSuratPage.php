<?php

namespace App\Livewire\Masyarakat;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Pengajuan Surat Saya - Portal Masyarakat SIDEWA')]
class PengajuanSuratPage extends Component
{
    use WithPagination;

    public bool $showDetailModal = false;
    public ?PengajuanSurat $selectedPengajuan = null;

    public string $filterStatus = '';

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function viewDetail(int $id): void
    {
        $this->selectedPengajuan = PengajuanSurat::with(['jenisSurat', 'user'])
            ->where('masyarakat_id', Auth::guard('masyarakat')->id())
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedPengajuan = null;
    }

    public function render()
    {
        $masyarakatId = Auth::guard('masyarakat')->id();

        $pengajuans = PengajuanSurat::query()
            ->with(['jenisSurat', 'user'])
            ->where('masyarakat_id', $masyarakatId)
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        $stats = [
            'total' => PengajuanSurat::where('masyarakat_id', $masyarakatId)->count(),
            'pending' => PengajuanSurat::where('masyarakat_id', $masyarakatId)->where('status', StatusPengajuanSurat::PENDING)->count(),
            'diproses' => PengajuanSurat::where('masyarakat_id', $masyarakatId)->where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'disetujui' => PengajuanSurat::where('masyarakat_id', $masyarakatId)->where('status', StatusPengajuanSurat::DISETUJUI)->count(),
        ];

        return view('livewire.masyarakat.pengajuan-surat', [
            'pengajuans' => $pengajuans,
            'stats' => $stats,
            'statuses' => StatusPengajuanSurat::cases(),
        ]);
    }
}
