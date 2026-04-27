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
            'pengajuanPending' => PengajuanSurat::where('status', StatusPengajuanSurat::PENDING)->count(),
            'pengajuanDiproses' => PengajuanSurat::where('status', StatusPengajuanSurat::DIPROSES)->count(),
            'pengajuanDisetujui' => PengajuanSurat::where('status', StatusPengajuanSurat::DISETUJUI)->count(),
            'totalPengaduan' => App\Models\Pengaduan::count(),
            'pengaduanPending' => App\Models\Pengaduan::where('status', 'pending')->count(),
            'totalMasyarakat' => \App\Models\Masyarakat::count(),
            'totalPengumuman' => \App\Models\Pengumuman::count(),
            'kegiatanAktif' => \App\Models\Kegiatan::where('progres', '<', 100)->count(),
            'recentPengajuan' => PengajuanSurat::with(['masyarakat', 'jenisSurat'])->latest('tanggal_pengajuan')->take(5)->get(),
            'recentPengaduan' => App\Models\Pengaduan::with('masyarakat')->latest('tanggal_pengaduan')->take(5)->get(),
            'recentPengumuman' => \App\Models\Pengumuman::latest('tanggal')->take(3)->get(),
        ]);
    }
}
