<?php

namespace App\Livewire\Masyarakat;

use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.guest-layout')]
#[Title('Registrasi Masyarakat - SIDEWA')]
class Register extends Component
{
    public string $nik = '';
    public string $nama = '';
    public string $email = '';
    public string $alamat = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $agree_terms = false;

    protected function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'size:16', 'unique:masyarakat,nik'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:masyarakat,email'],
            'alamat' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'agree_terms' => ['accepted'],
        ];
    }

    protected $messages = [
        'nik.required' => 'NIK harus diisi.',
        'nik.size' => 'NIK harus 16 digit.',
        'nik.unique' => 'NIK sudah terdaftar.',
        'nama.required' => 'Nama lengkap harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'alamat.required' => 'Alamat harus diisi.',
        'password.required' => 'Password harus diisi.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'agree_terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
    ];

    public function submit()
    {
        $validated = $this->validate();

        $masyarakat = Masyarakat::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('masyarakat')->login($masyarakat);

        session()->regenerate();

        return redirect()->route('masyarakat.dashboard');
    }

    public function render()
    {
        return view('livewire.masyarakat.register');
    }
}
