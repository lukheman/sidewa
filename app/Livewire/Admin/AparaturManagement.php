<?php

namespace App\Livewire\Admin;

use App\Models\AparaturDesa;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Struktur Organisasi')]
class AparaturManagement extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(as: 'q')]
    public string $search = '';

    public string $nama = '';
    public string $jabatan = '';
    public string $nip = '';
    public int $urutan = 99;
    public $foto;
    public ?string $existingFoto = null;

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    protected function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50'],
            'urutan' => ['required', 'integer', 'min:1'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updatedSearch(): void
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
        $aparatur = AparaturDesa::findOrFail($id);
        $this->editingId = $id;
        $this->nama = $aparatur->nama;
        $this->jabatan = $aparatur->jabatan;
        $this->nip = $aparatur->nip ?? '';
        $this->urutan = $aparatur->urutan;
        $this->existingFoto = $aparatur->foto;
        $this->foto = null;
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $fotoPath = $this->existingFoto;
        if ($this->foto) {
            $fotoPath = $this->foto->store('aparatur', 'public');
            // Remove old photo if exists
            if ($this->existingFoto && Storage::disk('public')->exists($this->existingFoto)) {
                Storage::disk('public')->delete($this->existingFoto);
            }
        }

        $validated['foto'] = $fotoPath;
        $validated['nip'] = empty($validated['nip']) ? null : $validated['nip'];

        if ($this->editingId) {
            AparaturDesa::findOrFail($this->editingId)->update($validated);
            session()->flash('success', 'Data aparatur berhasil diperbarui.');
        } else {
            AparaturDesa::create($validated);
            session()->flash('success', 'Data aparatur berhasil ditambahkan.');
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
            $aparatur = AparaturDesa::find($this->deletingId);
            if ($aparatur) {
                if ($aparatur->foto && Storage::disk('public')->exists($aparatur->foto)) {
                    Storage::disk('public')->delete($aparatur->foto);
                }
                $aparatur->delete();
                session()->flash('success', 'Data aparatur berhasil dihapus.');
            }
        }

        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    public function removeFoto(): void
    {
        $this->foto = null;
    }

    public function removeExistingFoto(): void
    {
        $this->existingFoto = null;
    }

    protected function resetForm(): void
    {
        $this->nama = '';
        $this->jabatan = '';
        $this->nip = '';
        $this->urutan = AparaturDesa::max('urutan') + 1 ?? 1;
        $this->foto = null;
        $this->existingFoto = null;
        $this->editingId = null;
    }

    public function render()
    {
        $data = AparaturDesa::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('jabatan', 'like', '%' . $this->search . '%');
            })
            ->orderBy('urutan', 'asc')
            ->paginate(10);

        return view('livewire.admin.aparatur-management', [
            'aparaturList' => $data,
        ]);
    }
}
