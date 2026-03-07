<?php

namespace App\Livewire;

use App\Models\AparaturDesa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('Struktur Organisasi Desa - SIDEWA')]
class StrukturOrganisasiPage extends Component
{
    public function render()
    {
        $aparaturList = AparaturDesa::orderBy('urutan', 'asc')->get();

        return view('livewire.struktur-organisasi-page', [
            'aparaturList' => $aparaturList,
        ]);
    }
}
