<?php

namespace App\Livewire\Admin;

use App\Enum\StatusPengaduan;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Pengaduan')]
class PengaduanManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    public string $isi_pengaduan = '';
    public string $tanggal_pengaduan = '';
    public string $status = 'pending';
    public ?int $masyarakat_id = null;

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public function mount(): void
    {
        $this->tanggal_pengaduan = date('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'isi_pengaduan' => ['required', 'string'],
            'tanggal_pengaduan' => ['required', 'date'],
            'status' => ['required', 'in:' . implode(',', StatusPengaduan::values())],
            'masyarakat_id' => ['required', 'exists:masyarakat,id'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
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
        $pengaduan = Pengaduan::findOrFail($id);
        $this->editingId = $id;
        $this->isi_pengaduan = $pengaduan->isi_pengaduan;
        $this->tanggal_pengaduan = $pengaduan->tanggal_pengaduan->format('Y-m-d');
        $this->status = $pengaduan->status->value;
        $this->masyarakat_id = $pengaduan->masyarakat_id;
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        // Set user_id jika status bukan pending
        if ($validated['status'] !== StatusPengaduan::PENDING->value) {
            $validated['user_id'] = Auth::id();
        }

        if ($this->editingId) {
            $pengaduan = Pengaduan::findOrFail($this->editingId);
            $pengaduan->update($validated);
            session()->flash('success', 'Pengaduan berhasil diperbarui.');
        } else {
            Pengaduan::create($validated);
            session()->flash('success', 'Pengaduan berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function updateStatus(int $id, string $status): void
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $status;
        $pengaduan->user_id = Auth::id();
        $pengaduan->save();
        session()->flash('success', 'Status pengaduan berhasil diubah.');
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
            Pengaduan::destroy($this->deletingId);
            session()->flash('success', 'Pengaduan berhasil dihapus.');
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
        $this->isi_pengaduan = '';
        $this->tanggal_pengaduan = date('Y-m-d');
        $this->status = StatusPengaduan::PENDING->value;
        $this->masyarakat_id = null;
        $this->editingId = null;
    }

    public function render()
    {
        $data = Pengaduan::query()
            ->with(['masyarakat', 'user'])
            ->when($this->search, function ($query) {
                $query->where('isi_pengaduan', 'like', '%' . $this->search . '%')
                    ->orWhereHas('masyarakat', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengaduan', 'desc')
            ->paginate(10);

        $masyarakats = Masyarakat::orderBy('nama')->get();

        return view('livewire.admin.pengaduan-management', [
            'pengaduans' => $data,
            'masyarakats' => $masyarakats,
            'statuses' => StatusPengaduan::cases(),
        ]);
    }
}
