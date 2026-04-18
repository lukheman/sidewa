<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use App\Models\Masyarakat;
use App\Models\Pengumuman;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('SIDEWA - Sistem Informasi Desa')]
class LandingPage extends Component
{
    public function render()
    {
        // Demographics data
        $totalMasyarakat = Masyarakat::count();
        $laki = Masyarakat::where('jenis_kelamin', 'L')->count();
        $perempuan = Masyarakat::where('jenis_kelamin', 'P')->count();

        // Age groups
        $now = Carbon::now();
        $ageGroups = [
            '0-17' => Masyarakat::whereNotNull('tanggal_lahir')
                ->whereDate('tanggal_lahir', '>', $now->copy()->subYears(18))->count(),
            '18-30' => Masyarakat::whereNotNull('tanggal_lahir')
                ->whereDate('tanggal_lahir', '<=', $now->copy()->subYears(18))
                ->whereDate('tanggal_lahir', '>', $now->copy()->subYears(31))->count(),
            '31-45' => Masyarakat::whereNotNull('tanggal_lahir')
                ->whereDate('tanggal_lahir', '<=', $now->copy()->subYears(31))
                ->whereDate('tanggal_lahir', '>', $now->copy()->subYears(46))->count(),
            '46-60' => Masyarakat::whereNotNull('tanggal_lahir')
                ->whereDate('tanggal_lahir', '<=', $now->copy()->subYears(46))
                ->whereDate('tanggal_lahir', '>', $now->copy()->subYears(61))->count(),
            '60+' => Masyarakat::whereNotNull('tanggal_lahir')
                ->whereDate('tanggal_lahir', '<=', $now->copy()->subYears(61))->count(),
        ];

        return view('livewire.landing-page', [
            'pengumumans' => Pengumuman::latest('tanggal')->take(3)->get(),
            'kegiatans' => Kegiatan::where('progres', '<', 100)->latest('tanggal_mulai')->take(4)->get(),
            'totalMasyarakat' => $totalMasyarakat,
            'laki' => $laki,
            'perempuan' => $perempuan,
            'ageGroups' => $ageGroups,
        ]);
    }
}
