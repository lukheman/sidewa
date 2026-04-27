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
    public string $tab = 'masyarakat'; // masyarakat, pelayanan, kepala_desa
    public string $login = '';
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

        if ($this->tab === 'masyarakat') {
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
            return;
        }

        // Processing for pelayanan and kepala_desa
        $credentials = [
            'email' => $this->login,
            'password' => $this->password,
        ];

        if (Auth::guard('web')->attempt($credentials, $this->remember)) {
            $user = Auth::guard('web')->user();

            if ($this->tab === 'pelayanan' && $user->role->value === 'pelayanan') {
                session()->regenerate();
                return redirect()->intended(route('pelayanan.dashboard'));
            } elseif ($this->tab === 'kepala_desa' && $user->role->value === 'kepala_desa') {
                session()->regenerate();
                return redirect()->intended(route('kepala-desa.dashboard'));
            }

            // Correct credentials but wrong tab/role chosen
            Auth::guard('web')->logout();
            $this->addError('login', 'Akses ditolak untuk peran (' . ucfirst(str_replace('_', ' ', $this->tab)) . ') ini.');
            return;
        }

        $this->addError('login', __('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
