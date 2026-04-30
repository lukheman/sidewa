<?php

namespace App\Livewire\KepalaDesa;

use App\Models\Kegiatan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Laporan Kegiatan Desa - Kepala Desa')]
class LaporanKegiatan extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $status = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Kegiatan::query()
            ->when($this->search, function ($query) {
                $query->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            })
            ->when($this->status !== '', function ($query) {
                if ($this->status === 'selesai') {
                    $query->where('progres', '>=', 100);
                } elseif ($this->status === 'berjalan') {
                    $query->where('progres', '>', 0)->where('progres', '<', 100);
                } elseif ($this->status === 'belum_mulai') {
                    $query->where('progres', 0);
                }
            })
            ->orderBy('tanggal_mulai', 'desc');

        return view('livewire.kepala-desa.laporan-kegiatan', [
            'kegiatans' => $query->paginate(10),
            'totalData' => $query->count()
        ]);
    }
}
