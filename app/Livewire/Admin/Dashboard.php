<?php

namespace App\Livewire\Admin;

use App\Models\Kegiatan;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Dashboard - SIDEWA')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalMasyarakat' => Masyarakat::count(),
            'totalPengumuman' => Pengumuman::count(),
            'totalPengaduan' => Pengaduan::count(),
            'totalPengajuanSurat' => PengajuanSurat::count(),
            'pengaduanPending' => Pengaduan::where('status', 'pending')->count(),
            'pengajuanDiajukan' => PengajuanSurat::where('status', 'diajukan')->count(),
            'kegiatanAktif' => Kegiatan::where('progres', '<', 100)->count(),
            'recentPengaduan' => Pengaduan::with('masyarakat')->latest('tanggal_pengaduan')->take(5)->get(),
            'recentPengajuan' => PengajuanSurat::with(['masyarakat', 'jenisSurat'])->latest('tanggal_pengajuan')->take(5)->get(),
            'recentPengumuman' => Pengumuman::latest('tanggal')->take(3)->get(),
        ]);
    }
}
