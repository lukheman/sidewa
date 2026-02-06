<?php

namespace App\Livewire\Admin;

use App\Enum\StatusPengajuanSurat;
use App\Models\JenisSurat;
use App\Models\Masyarakat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Pengajuan Surat')]
class PengajuanSuratManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    public string $tanggal_pengajuan = '';
    public string $status = 'diajukan';
    public string $keterangan = '';
    public ?int $masyarakat_id = null;
    public ?int $jenis_surat_id = null;

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public function mount(): void
    {
        $this->tanggal_pengajuan = date('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'tanggal_pengajuan' => ['required', 'date'],
            'status' => ['required', 'in:' . implode(',', StatusPengajuanSurat::values())],
            'keterangan' => ['nullable', 'string'],
            'masyarakat_id' => ['required', 'exists:masyarakat,id'],
            'jenis_surat_id' => ['required', 'exists:jenis_surat,id'],
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
        $pengajuan = PengajuanSurat::findOrFail($id);
        $this->editingId = $id;
        $this->tanggal_pengajuan = $pengajuan->tanggal_pengajuan->format('Y-m-d');
        $this->status = $pengajuan->status->value;
        $this->keterangan = $pengajuan->keterangan ?? '';
        $this->masyarakat_id = $pengajuan->masyarakat_id;
        $this->jenis_surat_id = $pengajuan->jenis_surat_id;
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        // Set user_id jika status bukan diajukan
        if ($validated['status'] !== StatusPengajuanSurat::DIAJUKAN->value) {
            $validated['user_id'] = Auth::id();
        }

        if ($this->editingId) {
            $pengajuan = PengajuanSurat::findOrFail($this->editingId);
            $pengajuan->update($validated);
            session()->flash('success', 'Pengajuan surat berhasil diperbarui.');
        } else {
            PengajuanSurat::create($validated);
            session()->flash('success', 'Pengajuan surat berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function updateStatus(int $id, string $status): void
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = $status;
        $pengajuan->user_id = Auth::id();
        $pengajuan->save();
        session()->flash('success', 'Status pengajuan berhasil diubah.');
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
            PengajuanSurat::destroy($this->deletingId);
            session()->flash('success', 'Pengajuan surat berhasil dihapus.');
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
        $this->tanggal_pengajuan = date('Y-m-d');
        $this->status = StatusPengajuanSurat::DIAJUKAN->value;
        $this->keterangan = '';
        $this->masyarakat_id = null;
        $this->jenis_surat_id = null;
        $this->editingId = null;
    }

    public function render()
    {
        $data = PengajuanSurat::query()
            ->with(['masyarakat', 'jenisSurat', 'user'])
            ->when($this->search, function ($query) {
                $query->whereHas('masyarakat', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('nik', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('jenisSurat', function ($q) {
                        $q->where('nama_surat', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        $masyarakats = Masyarakat::orderBy('nama')->get();
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('livewire.admin.pengajuan-surat-management', [
            'pengajuans' => $data,
            'masyarakats' => $masyarakats,
            'jenisSurats' => $jenisSurats,
            'statuses' => StatusPengajuanSurat::cases(),
        ]);
    }
}
