<?php

namespace App\Livewire\Admin;

use App\Models\JenisSurat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Jenis Surat')]
class JenisSuratManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $nama_surat = '';
    public string $keterangan = '';

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    protected function rules(): array
    {
        return [
            'nama_surat' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
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
        $jenisSurat = JenisSurat::findOrFail($id);
        $this->editingId = $id;
        $this->nama_surat = $jenisSurat->nama_surat;
        $this->keterangan = $jenisSurat->keterangan ?? '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->editingId) {
            $jenisSurat = JenisSurat::findOrFail($this->editingId);
            $jenisSurat->update($validated);
            session()->flash('success', 'Jenis surat berhasil diperbarui.');
        } else {
            JenisSurat::create($validated);
            session()->flash('success', 'Jenis surat berhasil ditambahkan.');
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
            JenisSurat::destroy($this->deletingId);
            session()->flash('success', 'Jenis surat berhasil dihapus.');
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
        $this->nama_surat = '';
        $this->keterangan = '';
        $this->editingId = null;
    }

    public function render()
    {
        $data = JenisSurat::query()
            ->when($this->search, function ($query) {
                $query->where('nama_surat', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama_surat')
            ->paginate(10);

        return view('livewire.admin.jenis-surat-management', [
            'jenisSurats' => $data,
        ]);
    }
}
