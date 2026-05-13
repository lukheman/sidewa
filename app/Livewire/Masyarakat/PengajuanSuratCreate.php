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
    
    public array $dynamicFields = [];
    public array $data_tambahan = [];

    public function mount(): void
    {
        $this->tanggal_pengajuan = date('Y-m-d');
    }

    public function updatedJenisSuratId($value): void
    {
        $this->dynamicFields = [];
        $this->data_tambahan = [];
        
        if ($value) {
            $jenisSurat = JenisSurat::find($value);
            if ($jenisSurat && is_array($jenisSurat->form_fields)) {
                $this->dynamicFields = $jenisSurat->form_fields;
                foreach ($this->dynamicFields as $field) {
                    $this->data_tambahan[$field['name']] = '';
                }
            }
        }
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
        $rules = [
            'jenis_surat_id' => ['required', 'exists:jenis_surat,id'],
            'tanggal_pengajuan' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ];

        $messages = $this->messages;

        // Dynamic validation
        foreach ($this->dynamicFields as $field) {
            $rules['data_tambahan.' . $field['name']] = ['required'];
            $messages['data_tambahan.' . $field['name'] . '.required'] = $field['label'] . ' wajib diisi.';
        }

        $validated = $this->validate($rules, $messages);

        PengajuanSurat::create([
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => StatusPengajuanSurat::PENDING->value,
            'masyarakat_id' => Auth::guard('masyarakat')->id(),
            'data_tambahan' => $this->data_tambahan,
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
