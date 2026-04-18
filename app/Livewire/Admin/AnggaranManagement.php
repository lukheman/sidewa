<?php

namespace App\Livewire\Admin;

use App\Models\AnggaranDesa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Anggaran Desa')]
class AnggaranManagement extends Component
{
    use WithPagination;

    #[Url(as: 'tahun')]
    public string $filterTahun = '';

    public string $tahun_anggaran = '';
    public string $kategori = 'pendapatan';
    public string $uraian = '';
    public string $jumlah = '';
    public string $keterangan = '';

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public function mount(): void
    {
        $this->filterTahun = (string) date('Y');
        $this->tahun_anggaran = (string) date('Y');
    }

    protected function rules(): array
    {
        return [
            'tahun_anggaran' => ['required', 'digits:4', 'integer', 'min:2020', 'max:2099'],
            'kategori' => ['required', 'in:pendapatan,belanja'],
            'uraian' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function updatedFilterTahun(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $this->resetValidation();
        $item = AnggaranDesa::findOrFail($id);
        $this->editingId = $id;
        $this->tahun_anggaran = (string) $item->tahun_anggaran;
        $this->kategori = $item->kategori;
        $this->uraian = $item->uraian;
        $this->jumlah = (string) $item->jumlah;
        $this->keterangan = $item->keterangan ?? '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();
        $validated['keterangan'] = empty($validated['keterangan']) ? null : $validated['keterangan'];

        if ($this->editingId) {
            AnggaranDesa::findOrFail($this->editingId)->update($validated);
            session()->flash('success', 'Data anggaran berhasil diperbarui.');
        } else {
            AnggaranDesa::create($validated);
            session()->flash('success', 'Data anggaran berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if ($this->deletingId) {
            AnggaranDesa::find($this->deletingId)?->delete();
            session()->flash('success', 'Data anggaran berhasil dihapus.');
        }
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    protected function resetForm(): void
    {
        $this->tahun_anggaran = $this->filterTahun ?: (string) date('Y');
        $this->kategori = 'pendapatan';
        $this->uraian = '';
        $this->jumlah = '';
        $this->keterangan = '';
        $this->editingId = null;
    }

    public function render()
    {
        $query = AnggaranDesa::query()
            ->when($this->filterTahun, fn($q) => $q->where('tahun_anggaran', $this->filterTahun))
            ->orderBy('kategori')
            ->orderBy('uraian');

        $items = $query->paginate(15);

        $totalPendapatan = AnggaranDesa::where('tahun_anggaran', $this->filterTahun ?: date('Y'))
            ->where('kategori', 'pendapatan')->sum('jumlah');
        $totalBelanja = AnggaranDesa::where('tahun_anggaran', $this->filterTahun ?: date('Y'))
            ->where('kategori', 'belanja')->sum('jumlah');

        $availableYears = AnggaranDesa::selectRaw('DISTINCT tahun_anggaran')
            ->orderByDesc('tahun_anggaran')
            ->pluck('tahun_anggaran')
            ->toArray();

        if (!in_array((int) date('Y'), $availableYears)) {
            array_unshift($availableYears, (int) date('Y'));
        }

        return view('livewire.admin.anggaran-management', [
            'items' => $items,
            'totalPendapatan' => $totalPendapatan,
            'totalBelanja' => $totalBelanja,
            'selisih' => $totalPendapatan - $totalBelanja,
            'availableYears' => $availableYears,
        ]);
    }
}
