<?php

namespace App\Livewire\Masyarakat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Profil - Portal Masyarakat SIDEWA')]
class Profile extends Component
{
    public string $nama = '';
    public string $email = '';
    public string $alamat = '';
    public string $phone = '';
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $showPasswordSection = false;

    public function mount(): void
    {
        $masyarakat = Auth::guard('masyarakat')->user();
        $this->nama = $masyarakat->nama;
        $this->email = $masyarakat->email ?? '';
        $this->alamat = $masyarakat->alamat;
        $this->phone = $masyarakat->phone ?? '';
    }

    protected function rules(): array
    {
        $masyarakatId = Auth::guard('masyarakat')->id();

        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:masyarakat,email,' . $masyarakatId],
            'alamat' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:15'],
        ];
    }

    protected $messages = [
        'current_password.current_password' => 'Password saat ini tidak sesuai.',
        'nama.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.unique' => 'Email sudah digunakan.',
        'alamat.required' => 'Alamat wajib diisi.',
    ];

    public function togglePasswordSection(): void
    {
        $this->showPasswordSection = !$this->showPasswordSection;
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation(['current_password', 'password', 'password_confirmation']);
    }

    public function updateProfile(): void
    {
        $validated = $this->validate();

        $masyarakat = Auth::guard('masyarakat')->user();
        $masyarakat->nama = $validated['nama'];
        $masyarakat->email = $validated['email'];
        $masyarakat->alamat = $validated['alamat'];
        $masyarakat->phone = $validated['phone'];
        $masyarakat->save();

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $masyarakat = Auth::guard('masyarakat')->user();

        // Verify current password
        if (!Hash::check($this->current_password, $masyarakat->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }

        $masyarakat->password = Hash::make($this->password);
        $masyarakat->save();

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->showPasswordSection = false;

        session()->flash('success', 'Password berhasil diperbarui.');
    }

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

        return view('livewire.masyarakat.profile', [
            'masyarakat' => $masyarakat,
        ]);
    }
}
