<?php

namespace App\Livewire\Admin;

use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Masyarakat')]
class MasyarakatManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    // Form fields
    public string $nik = '';
    public string $nama = '';
    public string $alamat = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    // State
    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    protected function rules(): array
    {
        $rules = [
            'nik' => ['required', 'string', 'size:16'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
        ];

        if ($this->editingId) {
            $rules['nik'][] = 'unique:masyarakat,nik,' . $this->editingId;
            if ($this->password) {
                $rules['password'] = ['confirmed', 'min:6'];
            }
        } else {
            $rules['nik'][] = 'unique:masyarakat,nik';
            $rules['password'] = ['required', 'confirmed', 'min:6'];
        }

        return $rules;
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
        $masyarakat = Masyarakat::findOrFail($id);
        $this->editingId = $id;
        $this->nik = $masyarakat->nik;
        $this->nama = $masyarakat->nama;
        $this->alamat = $masyarakat->alamat;
        $this->phone = $masyarakat->phone ?? '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->editingId) {
            $masyarakat = Masyarakat::findOrFail($this->editingId);
            $masyarakat->nik = $validated['nik'];
            $masyarakat->nama = $validated['nama'];
            $masyarakat->alamat = $validated['alamat'];
            $masyarakat->phone = $validated['phone'];

            if (!empty($this->password)) {
                $masyarakat->password = Hash::make($this->password);
            }

            $masyarakat->save();
            session()->flash('success', 'Data masyarakat berhasil diperbarui.');
        } else {
            Masyarakat::create([
                'nik' => $validated['nik'],
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);
            session()->flash('success', 'Data masyarakat berhasil ditambahkan.');
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
            Masyarakat::destroy($this->deletingId);
            session()->flash('success', 'Data masyarakat berhasil dihapus.');
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
        $this->nik = '';
        $this->nama = '';
        $this->alamat = '';
        $this->phone = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->editingId = null;
    }

    public function render()
    {
        $data = Masyarakat::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.masyarakat-management', [
            'masyarakats' => $data,
        ]);
    }
}
