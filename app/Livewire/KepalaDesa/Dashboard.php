<?php

namespace App\Livewire\KepalaDesa;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Dashboard - Kepala Desa SIDEWA')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.kepala-desa.dashboard', [
            'totalPengajuan' => PengajuanSurat::count(),
            'menungguVerifikasi' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'disetujui' => PengajuanSurat::where('status', StatusPengajuanSurat::SIAP_AMBIL)->count(),
            'selesai' => PengajuanSurat::where('status', StatusPengajuanSurat::SELESAI)->count(),
            'ditolak' => PengajuanSurat::where('status', StatusPengajuanSurat::DITOLAK)->count(),
            'totalPengaduan' => Pengaduan::count(),
            'recentPengajuan' => PengajuanSurat::with(['masyarakat', 'jenisSurat'])
                ->where('status', StatusPengajuanSurat::DIPROSES)
                ->latest('tanggal_pengajuan')
                ->take(5)
                ->get(),
        ]);
    }
}
