<?php

namespace App\Livewire\Pelayanan;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Pengajuan Surat Masuk - Pelayanan SIDEWA')]
class PengajuanSuratMasuk extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    // Detail modal
    public bool $showDetailModal = false;
    public ?PengajuanSurat $selectedPengajuan = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function viewDetail(int $id): void
    {
        $this->selectedPengajuan = PengajuanSurat::with(['masyarakat', 'jenisSurat', 'user'])->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedPengajuan = null;
    }

    public function updateStatus(int $id, string $status): void
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = $status;
        $pengajuan->user_id = Auth::id();
        $pengajuan->save();

        // Refresh detail modal jika sedang terbuka
        if ($this->selectedPengajuan && $this->selectedPengajuan->id === $id) {
            $this->selectedPengajuan = $pengajuan->fresh(['masyarakat', 'jenisSurat', 'user']);
        }

        session()->flash('success', 'Status pengajuan surat berhasil diubah menjadi ' . StatusPengajuanSurat::from($status)->label() . '.');
    }

    public function render()
    {
        $data = PengajuanSurat::query()
            ->with(['masyarakat', 'jenisSurat', 'user'])
            ->when($this->search, function ($query) {
                $query->whereHas('masyarakat', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('nik', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('jenisSurat', function ($q) {
                        $q->where('nama_surat', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        $stats = [
            'total' => PengajuanSurat::count(),
            'pending' => PengajuanSurat::where('status', StatusPengajuanSurat::PENDING)->count(),
            'diproses' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'disetujui' => PengajuanSurat::where('status', StatusPengajuanSurat::DISETUJUI)->count(),
        ];

        return view('livewire.pelayanan.pengajuan-surat-masuk', [
            'pengajuans' => $data,
            'stats' => $stats,
            'statuses' => StatusPengajuanSurat::cases(),
        ]);
    }
}
