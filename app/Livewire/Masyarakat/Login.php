<?php

namespace App\Livewire\Masyarakat;

use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('Login Masyarakat - SIDEWA')]
class Login extends Component
{
    public string $login = ''; // Can be email or NIK
    public string $password = '';
    public bool $remember = false;

    protected function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    protected $messages = [
        'login.required' => 'Email atau NIK harus diisi.',
        'password.required' => 'Password harus diisi.',
    ];

    public function submit()
    {
        $this->validate();

        // Determine if login is email or NIK
        $field = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        $credentials = [
            $field => $this->login,
            'password' => $this->password,
        ];

        if (Auth::guard('masyarakat')->attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('masyarakat.dashboard'));
        }

        $this->addError('login', 'Email/NIK atau password salah.');
    }

    public function render()
    {
        return view('livewire.masyarakat.login');
    }
}
