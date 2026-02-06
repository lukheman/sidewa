<?php

namespace App\Livewire\Admin;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Pengumuman')]
class PengumumanManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $judul = '';
    public string $isi = '';
    public string $tanggal = '';

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public function mount(): void
    {
        $this->tanggal = date('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
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
        $pengumuman = Pengumuman::findOrFail($id);
        $this->editingId = $id;
        $this->judul = $pengumuman->judul;
        $this->isi = $pengumuman->isi;
        $this->tanggal = $pengumuman->tanggal->format('Y-m-d');
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();
        $validated['user_id'] = Auth::id();

        if ($this->editingId) {
            $pengumuman = Pengumuman::findOrFail($this->editingId);
            $pengumuman->update($validated);
            session()->flash('success', 'Pengumuman berhasil diperbarui.');
        } else {
            Pengumuman::create($validated);
            session()->flash('success', 'Pengumuman berhasil ditambahkan.');
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
            Pengumuman::destroy($this->deletingId);
            session()->flash('success', 'Pengumuman berhasil dihapus.');
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
        $this->judul = '';
        $this->isi = '';
        $this->tanggal = date('Y-m-d');
        $this->editingId = null;
    }

    public function render()
    {
        $data = Pengumuman::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('livewire.admin.pengumuman-management', [
            'pengumumans' => $data,
        ]);
    }
}
