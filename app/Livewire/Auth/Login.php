<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;

use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('Login - SIDEWA')]
class Login extends Component
{
    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule([])]
    public string $password = '';

    public bool $remember = false;

    public function submit()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();

            if (Auth::user()->role->value === 'pelayanan') {
                return redirect()->to(route('pelayanan.dashboard'));
            }

            if (Auth::user()->role->value === 'kepala_desa') {
                return redirect()->to(route('kepala-desa.dashboard'));
            }

            return redirect()->to(route('dashboard'));
        }

        $this->addError('email', __('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
