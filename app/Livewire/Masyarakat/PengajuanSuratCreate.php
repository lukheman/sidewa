<?php

namespace App\Livewire\Masyarakat;

use App\Enum\StatusPengajuanSurat;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Ajukan Surat - Portal Masyarakat SIDEWA')]
class PengajuanSuratCreate extends Component
{
    public ?int $jenis_surat_id = null;
    public string $tanggal_pengajuan = '';
    public string $keterangan = '';

    public function mount(): void
    {
        $this->tanggal_pengajuan = date('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'jenis_surat_id' => ['required', 'exists:jenis_surat,id'],
            'tanggal_pengajuan' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    protected $messages = [
        'jenis_surat_id.required' => 'Jenis surat wajib dipilih.',
        'tanggal_pengajuan.required' => 'Tanggal pengajuan wajib diisi.',
    ];

    public function submit(): void
    {
        $validated = $this->validate();

        PengajuanSurat::create([
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => StatusPengajuanSurat::DIAJUKAN->value,
            'masyarakat_id' => Auth::guard('masyarakat')->id(),
        ]);

        session()->flash('success', 'Pengajuan surat berhasil dikirim. Silakan pantau statusnya.');
        $this->redirect(route('masyarakat.pengajuan-surat'), navigate: true);
    }

    public function render()
    {
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('livewire.masyarakat.pengajuan-surat-create', [
            'jenisSurats' => $jenisSurats,
        ]);
    }
}
