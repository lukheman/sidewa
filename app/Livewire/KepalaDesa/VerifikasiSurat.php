<?php

namespace App\Livewire\KepalaDesa;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.admin.livewire-layout')]
#[Title('Verifikasi Surat - Kepala Desa SIDEWA')]
class VerifikasiSurat extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $filterStatus = '';

    public bool $showDetailModal = false;
    public ?PengajuanSurat $selectedPengajuan = null;

    // Reject modal
    public bool $showRejectModal = false;
    public ?int $rejectId = null;
    public string $rejectNote = '';

    // Approve modal
    public bool $showApproveModal = false;
    public ?int $approveId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function viewDetail(int $id): void
    {
        $this->selectedPengajuan = PengajuanSurat::with(['masyarakat', 'jenisSurat', 'user'])->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedPengajuan = null;
    }

    /**
     * Buka modal konfirmasi approve
     */
    public function confirmApprove(int $id): void
    {
        $this->approveId = $id;
        $this->showApproveModal = true;
    }

    /**
     * Tutup modal konfirmasi approve
     */
    public function cancelApprove(): void
    {
        $this->showApproveModal = false;
        $this->approveId = null;
    }

    /**
     * Setujui pengajuan surat (diproses → disetujui)
     */
    public function approve(): void
    {
        $pengajuan = PengajuanSurat::findOrFail($this->approveId);
        $pengajuan->status = StatusPengajuanSurat::DISETUJUI->value;
        $pengajuan->user_id = Auth::id();
        $pengajuan->save();

        if ($this->selectedPengajuan && $this->selectedPengajuan->id === $this->approveId) {
            $this->selectedPengajuan = $pengajuan->fresh(['masyarakat', 'jenisSurat', 'user']);
        }

        $this->cancelApprove();
        session()->flash('success', 'Pengajuan surat berhasil disetujui.');
    }

    /**
     * Buka modal penolakan
     */
    public function confirmReject(int $id): void
    {
        $this->rejectId = $id;
        $this->rejectNote = '';
        $this->showRejectModal = true;
    }

    /**
     * Tutup modal penolakan
     */
    public function closeRejectModal(): void
    {
        $this->showRejectModal = false;
        $this->rejectId = null;
        $this->rejectNote = '';
    }

    /**
     * Tolak pengajuan surat (diproses → ditolak) dengan catatan
     */
    public function reject(): void
    {
        $this->validate([
            'rejectNote' => 'required|min:5',
        ], [
            'rejectNote.required' => 'Alasan penolakan wajib diisi.',
            'rejectNote.min' => 'Alasan penolakan minimal 5 karakter.',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($this->rejectId);
        $pengajuan->status = StatusPengajuanSurat::DITOLAK->value;
        $pengajuan->keterangan = $this->rejectNote;
        $pengajuan->user_id = Auth::id();
        $pengajuan->save();

        if ($this->selectedPengajuan && $this->selectedPengajuan->id === $this->rejectId) {
            $this->selectedPengajuan = $pengajuan->fresh(['masyarakat', 'jenisSurat', 'user']);
        }

        $this->closeRejectModal();
        session()->flash('success', 'Pengajuan surat telah ditolak.');
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
            }, function ($query) {
                // Default: tampilkan yang perlu diverifikasi + yang sudah disetujui/ditolak
                $query->whereIn('status', [
                    StatusPengajuanSurat::DIPROSES->value,
                    StatusPengajuanSurat::DISETUJUI->value,
                    StatusPengajuanSurat::DITOLAK->value,
                ]);
            })
            ->orderByRaw("FIELD(status, 'diproses', 'disetujui', 'ditolak')")
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        $stats = [
            'menunggu' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'disetujui' => PengajuanSurat::where('status', StatusPengajuanSurat::DISETUJUI)->count(),
            'ditolak' => PengajuanSurat::where('status', StatusPengajuanSurat::DITOLAK)->count(),
        ];

        return view('livewire.kepala-desa.verifikasi-surat', [
            'pengajuans' => $data,
            'stats' => $stats,
            'statuses' => StatusPengajuanSurat::cases(),
        ]);
    }
}
