<?php

namespace App\Livewire\KepalaDesa;

use App\Models\Masyarakat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Laporan Data Masyarakat - Kepala Desa')]
class LaporanMasyarakat extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $jenisKelamin = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedJenisKelamin(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Masyarakat::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            })
            ->when($this->jenisKelamin, function ($query) {
                $query->where('jenis_kelamin', $this->jenisKelamin);
            })
            ->orderBy('created_at', 'desc');

        return view('livewire.kepala-desa.laporan-masyarakat', [
            'masyarakats' => $query->paginate(10),
            'totalData' => $query->count()
        ]);
    }
}
