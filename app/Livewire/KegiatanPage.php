<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.guest-layout')]
#[Title('Kegiatan Desa - SIDEWA')]
class KegiatanPage extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $kegiatans = Kegiatan::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            })
            ->latest('tanggal_mulai')
            ->paginate(8);

        return view('livewire.kegiatan-page', [
            'kegiatans' => $kegiatans,
        ]);
    }
}
