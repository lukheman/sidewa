<div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); padding: 1rem 0; position: fixed; width: 100%; top: 0; z-index: 1000;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" style="font-weight: 700; font-size: 1.5rem; color: #10b981; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-layer-group" style="font-size: 1.75rem;"></i>
                SIDEWA
            </a>
        </div>
    </nav>

    <!-- Register Section -->
    <section style="min-height: 100vh; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 2rem;">
        <div style="width: 100%; max-width: 450px;">
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); padding: 3rem; border: 1px solid rgba(255, 255, 255, 0.3);">
                <!-- Brand Logo -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);">
                        <i class="fas fa-user-plus" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; color: #064e3b; margin-bottom: 0.5rem;">Buat Akun</h1>
                    <p style="color: #047857; font-size: 0.95rem;">Daftar untuk menggunakan SIDEWA</p>
                </div>

                <!-- Register Form -->
                <form wire:submit="submit">
                    <!-- Name Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="name" style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Nama Lengkap</label>
                        <div style="position: relative;">
                            <i class="fas fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="text" wire:model="name" id="name" 
                                style="width: 100%; height: 52px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                placeholder="Masukkan nama lengkap" autofocus>
                        </div>
                        @error('name')
                            <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="email" style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Email</label>
                        <div style="position: relative;">
                            <i class="fas fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="email" wire:model="email" id="email" 
                                style="width: 100%; height: 52px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                placeholder="Masukkan email">
                        </div>
                        @error('email')
                            <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="password" style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Password</label>
                        <div style="position: relative;">
                            <i class="fas fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="password" wire:model="password" id="password" 
                                style="width: 100%; height: 52px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 3rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword('password', 'toggleIcon1')" 
                                style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                                <i class="fas fa-eye" id="toggleIcon1"></i>
                            </button>
                        </div>
                        @error('password')
                            <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div style="margin-bottom: 1rem;">
                        <label for="password_confirmation" style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Konfirmasi Password</label>
                        <div style="position: relative;">
                            <i class="fas fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="password" wire:model="password_confirmation" id="password_confirmation" 
                                style="width: 100%; height: 52px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 3rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                placeholder="Konfirmasi password">
                            <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')" 
                                style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                                <i class="fas fa-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div style="display: flex; align-items: start; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <input type="checkbox" wire:model="agree_terms" id="agree_terms" 
                            style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1fae5; border-radius: 6px; cursor: pointer; margin-top: 0.1rem;">
                        <label for="agree_terms" style="color: #047857; cursor: pointer; font-size: 0.9rem;">
                            Saya menyetujui <a href="#" style="color: #10b981; text-decoration: none; font-weight: 500;">Syarat & Ketentuan</a> serta <a href="#" style="color: #10b981; text-decoration: none; font-weight: 500;">Kebijakan Privasi</a>
                        </label>
                    </div>
                    @error('agree_terms')
                        <small style="color: #ef4444; margin-top: -1rem; margin-bottom: 1rem; display: block;">{{ $message }}</small>
                    @enderror

                    <!-- Register Button -->
                    <button type="submit" wire:loading.attr="disabled"
                        style="width: 100%; height: 56px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; color: white; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                        <span wire:loading.remove>Daftar Sekarang <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i></span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i> Memproses...
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div style="display: flex; align-items: center; margin: 1.5rem 0; color: #6b7280; font-size: 0.875rem;">
                    <div style="flex: 1; height: 1px; background: #d1fae5;"></div>
                    <span style="padding: 0 1rem;">atau</span>
                    <div style="flex: 1; height: 1px; background: #d1fae5;"></div>
                </div>

                <!-- Sign In Link -->
                <div style="text-align: center; color: #047857;">
                    Sudah punya akun? <a href="{{ route('login') }}" style="color: #10b981; font-weight: 600; text-decoration: none;">Masuk</a>
                </div>

                <!-- Back to Home -->
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none; font-size: 0.9rem;">
                        <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</div>