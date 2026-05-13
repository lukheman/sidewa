<?php

namespace App\Livewire\Admin;

use App\Models\JenisSurat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.admin.livewire-layout')]
#[Title('Manajemen Jenis Surat')]
class JenisSuratManagement extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(as: 'q')]
    public string $search = '';

    public string $nama_surat = '';
    public string $keterangan = '';
    public $file_template;
    public array $form_fields = [];

    public ?int $editingId = null;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;
    public bool $forceDeleteMode = false;
    public int $relatedCount = 0;

    protected function rules(): array
    {
        return [
            'nama_surat' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'file_template' => ['nullable', 'file', 'mimes:docx', 'max:2048'],
            'form_fields' => ['nullable', 'array'],
            'form_fields.*.name' => ['required', 'string'],
            'form_fields.*.label' => ['required', 'string'],
            'form_fields.*.type' => ['required', 'string', 'in:text,textarea,number,date'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function addField(): void
    {
        $this->form_fields[] = ['name' => '', 'label' => '', 'type' => 'text'];
    }

    public function removeField(int $index): void
    {
        unset($this->form_fields[$index]);
        $this->form_fields = array_values($this->form_fields);
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
        $this->form_fields = is_array($jenisSurat->form_fields) ? $jenisSurat->form_fields : [];
        $this->file_template = null;
        $this->showModal = true;
    }

    public function save(): void
    {
        $validated = $this->validate();
        
        // Pastikan array ter-index ulang
        $validated['form_fields'] = array_values($this->form_fields);

        if ($this->file_template) {
            $path = $this->file_template->store('templates', 'local');
            $validated['file_template'] = $path;
        }

        if ($this->editingId) {
            $jenisSurat = JenisSurat::findOrFail($this->editingId);
            if ($this->file_template && $jenisSurat->file_template) {
                Storage::disk('local')->delete($jenisSurat->file_template);
            }
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
        $this->forceDeleteMode = false;
        $this->relatedCount = 0;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if ($this->deletingId) {
            $jenisSurat = JenisSurat::withCount('pengajuanSurats')->findOrFail($this->deletingId);

            if ($jenisSurat->pengajuan_surats_count > 0 && !$this->forceDeleteMode) {
                // Ada relasi, tampilkan konfirmasi force delete
                $this->relatedCount = $jenisSurat->pengajuan_surats_count;
                $this->forceDeleteMode = true;
                return;
            }

            // Hapus file template jika ada
            if ($jenisSurat->file_template) {
                Storage::disk('local')->delete($jenisSurat->file_template);
            }
            
            // Hapus semua pengajuan surat terkait terlebih dahulu
            $jenisSurat->pengajuanSurats()->delete();
            $jenisSurat->delete();
            session()->flash('success', 'Jenis surat berhasil dihapus.');
        }

        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->forceDeleteMode = false;
        $this->relatedCount = 0;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->forceDeleteMode = false;
        $this->relatedCount = 0;
    }

    protected function resetForm(): void
    {
        $this->nama_surat = '';
        $this->keterangan = '';
        $this->file_template = null;
        $this->form_fields = [];
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
