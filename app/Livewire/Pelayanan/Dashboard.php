<?php

namespace App\Livewire\Pelayanan;

use App\Enum\StatusPengajuanSurat;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Dashboard - Pelayanan SIDEWA')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pelayanan.dashboard', [
            'totalPengajuan' => PengajuanSurat::count(),
            'pengajuanDiajukan' => PengajuanSurat::where('status', StatusPengajuanSurat::DIAJUKAN)->count(),
            'pengajuanDiproses' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'pengajuanSiapAmbil' => PengajuanSurat::where('status', StatusPengajuanSurat::SIAP_AMBIL)->count(),
            'pengajuanSelesai' => PengajuanSurat::where('status', StatusPengajuanSurat::SELESAI)->count(),
            'totalPengaduan' => Pengaduan::count(),
            'pengaduanPending' => Pengaduan::where('status', 'pending')->count(),
            'recentPengajuan' => PengajuanSurat::with(['masyarakat', 'jenisSurat'])->latest('tanggal_pengajuan')->take(5)->get(),
        ]);
    }
}
