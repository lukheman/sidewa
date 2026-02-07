<?php

namespace App\Livewire\Masyarakat;

use App\Enum\StatusPengaduan;
use App\Enum\StatusPengajuanSurat;
use App\Models\Pengaduan;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Dashboard - Portal Masyarakat SIDEWA')]
class Dashboard extends Component
{
    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('masyarakat.login');
    }

    public function render()
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        // Get statistics
        $totalPengaduan = Pengaduan::where('masyarakat_id', $masyarakat->id)->count();
        $pendingPengaduan = Pengaduan::where('masyarakat_id', $masyarakat->id)
            ->where('status', StatusPengaduan::PENDING->value)
            ->count();

        $totalPengajuan = PengajuanSurat::where('masyarakat_id', $masyarakat->id)->count();
        $siapAmbil = PengajuanSurat::where('masyarakat_id', $masyarakat->id)
            ->where('status', StatusPengajuanSurat::SIAP_AMBIL->value)
            ->count();

        // Get recent data
        $recentPengaduans = Pengaduan::where('masyarakat_id', $masyarakat->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentPengajuans = PengajuanSurat::where('masyarakat_id', $masyarakat->id)
            ->with('jenisSurat')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get latest pengumuman
        $pengumumans = Pengumuman::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('livewire.masyarakat.dashboard', [
            'masyarakat' => $masyarakat,
            'totalPengaduan' => $totalPengaduan,
            'pendingPengaduan' => $pendingPengaduan,
            'totalPengajuan' => $totalPengajuan,
            'siapAmbil' => $siapAmbil,
            'recentPengaduans' => $recentPengaduans,
            'recentPengajuans' => $recentPengajuans,
            'pengumumans' => $pengumumans,
        ]);
    }
}
