<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('SIDEWA - Sistem Informasi Desa')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page', [
            'pengumumans' => Pengumuman::latest('tanggal')->take(3)->get(),
            'kegiatans' => Kegiatan::where('progres', '<', 100)->latest('tanggal_mulai')->take(4)->get(),
        ]);
    }
}
