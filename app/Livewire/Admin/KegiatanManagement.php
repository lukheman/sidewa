<?php

namespace App\Livewire\Admin;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Kegiatan')]
class KegiatanManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $nama_kegiatan = '';
    public string $deskripsi = '';
    public string $tanggal_mulai = '';
    public string $tanggal_selesai = '';
    public int $progres = 0;

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public function mount(): void
    {
        $this->tanggal_mulai = date('Y-m-d');
        $this->tanggal_selesai = date('Y-m-d', strtotime('+7 days'));
    }

    protected function rules(): array
    {
        return [
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'progres' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->editingId = null;
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $this->editingId = $id;
        $this->nama_kegiatan = $kegiatan->nama_kegiatan;
        $this->deskripsi = $kegiatan->deskripsi;
        $this->tanggal_mulai = $kegiatan->tanggal_mulai->format('Y-m-d');
        $this->tanggal_selesai = $kegiatan->tanggal_selesai->format('Y-m-d');
        $this->progres = $kegiatan->progres;
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();
        $validated['user_id'] = Auth::id();

        if ($this->editingId) {
            $kegiatan = Kegiatan::findOrFail($this->editingId);
            $kegiatan->update($validated);
            session()->flash('success', 'Kegiatan berhasil diperbarui.');
        } else {
            Kegiatan::create($validated);
            session()->flash('success', 'Kegiatan berhasil ditambahkan.');
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
            Kegiatan::destroy($this->deletingId);
            session()->flash('success', 'Kegiatan berhasil dihapus.');
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
        $this->nama_kegiatan = '';
        $this->deskripsi = '';
        $this->tanggal_mulai = date('Y-m-d');
        $this->tanggal_selesai = date('Y-m-d', strtotime('+7 days'));
        $this->progres = 0;
        $this->editingId = null;
    }

    public function render()
    {
        $data = Kegiatan::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('nama_kegiatan', 'like', '%' . $this->search . '%');
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('livewire.admin.kegiatan-management', [
            'kegiatans' => $data,
        ]);
    }
}
