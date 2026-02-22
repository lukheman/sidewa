<?php

namespace App\Livewire\Pelayanan;

use App\Enum\StatusPengaduan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Pengaduan Masuk - Pelayanan SIDEWA')]
class PengaduanMasuk extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    // Detail modal
    public bool $showDetailModal = false;
    public ?Pengaduan $selectedPengaduan = null;

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
        $this->selectedPengaduan = Pengaduan::with(['masyarakat', 'user'])->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedPengaduan = null;
    }

    public function updateStatus(int $id, string $status): void
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $status;
        $pengaduan->user_id = Auth::id();
        $pengaduan->save();

        // Refresh detail modal jika sedang terbuka
        if ($this->selectedPengaduan && $this->selectedPengaduan->id === $id) {
            $this->selectedPengaduan = $pengaduan->fresh(['masyarakat', 'user']);
        }

        session()->flash('success', 'Status pengaduan berhasil diubah menjadi ' . StatusPengaduan::from($status)->label() . '.');
    }

    public function render()
    {
        $data = Pengaduan::query()
            ->with(['masyarakat', 'user'])
            ->when($this->search, function ($query) {
                $query->where('isi_pengaduan', 'like', '%' . $this->search . '%')
                    ->orWhereHas('masyarakat', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('nik', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengaduan', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', StatusPengaduan::PENDING)->count(),
            'proses' => Pengaduan::where('status', StatusPengaduan::PROSES)->count(),
            'selesai' => Pengaduan::where('status', StatusPengaduan::SELESAI)->count(),
        ];

        return view('livewire.pelayanan.pengaduan-masuk', [
            'pengaduans' => $data,
            'stats' => $stats,
            'statuses' => StatusPengaduan::cases(),
        ]);
    }
}
