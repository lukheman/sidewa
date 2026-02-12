<?php

namespace App\Livewire\Masyarakat;

use App\Enum\StatusPengaduan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Buat Pengaduan - Portal Masyarakat SIDEWA')]
class PengaduanCreate extends Component
{
    public string $isi_pengaduan = '';
    public string $tanggal_pengaduan = '';

    public function mount(): void
    {
        $this->tanggal_pengaduan = date('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'isi_pengaduan' => ['required', 'string', 'min:10'],
            'tanggal_pengaduan' => ['required', 'date'],
        ];
    }

    protected $messages = [
        'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
        'isi_pengaduan.min' => 'Isi pengaduan minimal 10 karakter.',
        'tanggal_pengaduan.required' => 'Tanggal pengaduan wajib diisi.',
    ];

    public function submit(): void
    {
        $validated = $this->validate();

        Pengaduan::create([
            'isi_pengaduan' => $validated['isi_pengaduan'],
            'tanggal_pengaduan' => $validated['tanggal_pengaduan'],
            'status' => StatusPengaduan::PENDING->value,
            'masyarakat_id' => Auth::guard('masyarakat')->id(),
        ]);

        session()->flash('success', 'Pengaduan berhasil dikirim. Kami akan segera menindaklanjuti.');
        $this->redirect(route('masyarakat.pengaduan'), navigate: true);
    }

    public function render()
    {
        return view('livewire.masyarakat.pengaduan-create');
    }
}
