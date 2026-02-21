<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.guest-layout')]
#[Title('Pengumuman - SIDEWA')]
class PengumumanPage extends Component
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
        $pengumumans = Pengumuman::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isi', 'like', '%' . $this->search . '%');
            })
            ->latest('tanggal')
            ->paginate(9);

        return view('livewire.pengumuman-page', [
            'pengumumans' => $pengumumans,
        ]);
    }
}
