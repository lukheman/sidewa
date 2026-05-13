<div>

    <nav class="navbar navbar-expand-lg"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); padding: 1rem 0; position: fixed; width: 100%; top: 0; z-index: 1000;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"
                style="font-weight: 700; font-size: 1.5rem; color: #0ea5e9; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-layer-group" style="font-size: 1.75rem;"></i>
                SIDEWA
            </a>
            <a href="{{ route('home') }}" style="color: #0369a1; text-decoration: none; font-weight: 500;">
                <i class="fas fa-arrow-left me-1"></i> Beranda
            </a>
        </div>
    </nav>

    <!-- Login Section -->
    <section
        style="min-height: 100vh; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 2rem;">
        <div style="width: 100%; max-width: 450px;">
            <div
                style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); padding: 3rem; border: 1px solid rgba(255, 255, 255, 0.3);">
                <!-- Brand Logo -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 10px 30px rgba(14, 165, 233, 0.4);">
                        <i class="fas fa-layer-group" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; color: #0c4a6e; margin-bottom: 0.5rem;">Selamat
                        Datang</h1>
                    <p style="color: #0369a1; font-size: 0.95rem;">Masuk ke akun SIDEWA Anda</p>
                </div>

                <!-- Tabs -->
                <div style="display: flex; background: #ecfdf5; border-radius: 12px; padding: 0.5rem; margin-bottom: 2rem;">
                    <button type="button" wire:click="$set('tab', 'masyarakat')"
                        style="flex: 1; padding: 0.75rem 0; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; {{ $tab === 'masyarakat' ? 'background: #0ea5e9; color: white; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);' : 'background: transparent; color: #0369a1;' }}">
                        Masyarakat
                    </button>
                    <button type="button" wire:click="$set('tab', 'pelayanan')"
                        style="flex: 1; padding: 0.75rem 0; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; {{ $tab === 'pelayanan' ? 'background: #0ea5e9; color: white; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);' : 'background: transparent; color: #0369a1;' }}">
                        Pelayanan
                    </button>
                    <button type="button" wire:click="$set('tab', 'kepala_desa')"
                        style="flex: 1; padding: 0.75rem 0; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; {{ $tab === 'kepala_desa' ? 'background: #0ea5e9; color: white; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);' : 'background: transparent; color: #0369a1;' }}">
                        Kepala Desa
                    </button>
                </div>

                <!-- Login Form -->
                <form wire:submit="submit">
                    <!-- Login Field -->
                    <div style="margin-bottom: 1.25rem;">
                        <label for="login"
                            style="display: block; margin-bottom: 0.5rem; color: #0c4a6e; font-weight: 500;">
                            @if($tab === 'masyarakat')
                                Email atau NIK
                            @else
                                Email
                            @endif
                        </label>
                        <div style="position: relative;">
                            <i class="fas fa-{{ $tab === 'masyarakat' ? 'user' : 'envelope' }}"
                                style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="{{ $tab === 'masyarakat' ? 'text' : 'email' }}" wire:model="login" id="login"
                                style="width: 100%; height: 56px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc; transition: all 0.3s ease;"
                                class="@error('login') border-danger @enderror" 
                                placeholder="{{ $tab === 'masyarakat' ? 'Masukkan Email atau NIK' : 'Masukkan Email Anda' }}"
                                autofocus>
                        </div>
                        @error('login')
                            <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div style="margin-bottom: 1.25rem;">
                        <label for="password"
                            style="display: block; margin-bottom: 0.5rem; color: #0c4a6e; font-weight: 500;">Password</label>
                        <div style="position: relative;">
                            <i class="fas fa-lock"
                                style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                            <input type="password" wire:model="password" id="password"
                                style="width: 100%; height: 56px; border: 2px solid #d1fae5; border-radius: 12px; padding: 0 3rem 0 3rem; font-size: 1rem; background: #f8fafc; transition: all 0.3s ease;"
                                class="@error('password') border-danger @enderror" placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()"
                                style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="checkbox" wire:model="remember" id="remember"
                                style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1fae5; border-radius: 6px; cursor: pointer;">
                            <label for="remember" style="color: #0369a1; cursor: pointer;">Ingat saya</label>
                        </div>
                        @if($tab !== 'masyarakat')
                            <a href="#" style="color: #0ea5e9; text-decoration: none; font-weight: 500;">Lupa Password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" wire:loading.attr="disabled"
                        style="width: 100%; height: 56px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); border: none; border-radius: 12px; color: white; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                        <span wire:loading.remove>Masuk <i class="fas fa-arrow-right"
                                style="margin-left: 0.5rem;"></i></span>
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

                <!-- Sign Up Link -->
                @if($tab === 'masyarakat')
                    <div style="text-align: center; color: #0369a1;">
                        Belum punya akun? <a href="{{ route('masyarakat.register') }}"
                            style="color: #0ea5e9; font-weight: 600; text-decoration: none;">Daftar Sekarang</a>
                    </div>
                @else
                    <div style="text-align: center; color: #0369a1;">
                        Belum punya akun? Hubungi administrator.
                    </div>
                @endif

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
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
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
