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
     * Setujui pengajuan surat (diproses → siap_ambil)
     */
    public function approve(int $id): void
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = StatusPengajuanSurat::SIAP_AMBIL->value;
        $pengajuan->user_id = Auth::id();
        $pengajuan->save();

        if ($this->selectedPengajuan && $this->selectedPengajuan->id === $id) {
            $this->selectedPengajuan = $pengajuan->fresh(['masyarakat', 'jenisSurat', 'user']);
        }

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
                // Default: hanya tampilkan yang perlu diverifikasi + yang sudah disetujui/ditolak
                $query->whereIn('status', [
                    StatusPengajuanSurat::DIPROSES->value,
                    StatusPengajuanSurat::SIAP_AMBIL->value,
                    StatusPengajuanSurat::DITOLAK->value,
                    StatusPengajuanSurat::SELESAI->value,
                ]);
            })
            ->orderByRaw("FIELD(status, 'diproses', 'siap_ambil', 'selesai', 'ditolak')")
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        $stats = [
            'menunggu' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'disetujui' => PengajuanSurat::where('status', StatusPengajuanSurat::SIAP_AMBIL)->count(),
            'selesai' => PengajuanSurat::where('status', StatusPengajuanSurat::SELESAI)->count(),
            'ditolak' => PengajuanSurat::where('status', StatusPengajuanSurat::DITOLAK)->count(),
        ];

        return view('livewire.kepala-desa.verifikasi-surat', [
            'pengajuans' => $data,
            'stats' => $stats,
            'statuses' => StatusPengajuanSurat::cases(),
        ]);
    }
}
