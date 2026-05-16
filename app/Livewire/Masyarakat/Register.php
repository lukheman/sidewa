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
    public string $tempat_lahir = '';
    public string $tanggal_lahir = '';
    public string $jenis_kelamin = '';
    public string $agama = '';
    public string $pekerjaan = '';
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
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'agama' => ['required', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
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
        'tempat_lahir.required' => 'Tempat lahir harus diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
        'agama.required' => 'Agama harus diisi.',
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
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'agama' => $validated['agama'],
            'pekerjaan' => $validated['pekerjaan'] ?? null,
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
