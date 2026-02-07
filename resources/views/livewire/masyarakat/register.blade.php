<div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg"
        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); padding: 1rem 0; position: fixed; width: 100%; top: 0; z-index: 1000;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"
                style="font-weight: 700; font-size: 1.5rem; color: #10b981; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-layer-group" style="font-size: 1.75rem;"></i>
                SIDEWA
            </a>
        </div>
    </nav>

    <!-- Register Section -->
    <section
        style="min-height: 100vh; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 2rem;">
        <div style="width: 100%; max-width: 500px;">
            <div
                style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); padding: 2.5rem; border: 1px solid rgba(255, 255, 255, 0.3);">
                <!-- Brand Logo -->
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div
                        style="width: 70px; height: 70px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 18px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);">
                        <i class="fas fa-user-plus" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h1 style="font-size: 1.5rem; font-weight: 700; color: #064e3b; margin-bottom: 0.25rem;">Registrasi
                        Masyarakat</h1>
                    <p style="color: #047857; font-size: 0.9rem;">Daftar untuk mengakses layanan desa</p>
                </div>

                <!-- Register Form -->
                <form wire:submit="submit">
                    <div class="row">
                        <!-- NIK -->
                        <div class="col-12 mb-3">
                            <label for="nik"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">NIK
                                <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-id-card"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="text" wire:model="nik" id="nik" maxlength="16"
                                    style="width: 100%; height: 48px; border: 2px solid {{ $errors->has('nik') ? '#ef4444' : '#d1fae5' }}; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="16 digit NIK">
                            </div>
                            @error('nik')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="col-12 mb-3">
                            <label for="nama"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Nama
                                Lengkap <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-user"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="text" wire:model="nama" id="nama"
                                    style="width: 100%; height: 48px; border: 2px solid {{ $errors->has('nama') ? '#ef4444' : '#d1fae5' }}; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="Nama lengkap sesuai KTP">
                            </div>
                            @error('nama')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Email
                                <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-envelope"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="email" wire:model="email" id="email"
                                    style="width: 100%; height: 48px; border: 2px solid {{ $errors->has('email') ? '#ef4444' : '#d1fae5' }}; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="email@contoh.com">
                            </div>
                            @error('email')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="phone"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">No.
                                Telepon</label>
                            <div style="position: relative;">
                                <i class="fas fa-phone"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="text" wire:model="phone" id="phone"
                                    style="width: 100%; height: 48px; border: 2px solid #d1fae5; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12 mb-3">
                            <label for="alamat"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Alamat
                                <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-map-marker-alt"
                                    style="position: absolute; left: 1rem; top: 1rem; color: #6b7280;"></i>
                                <textarea wire:model="alamat" id="alamat" rows="2"
                                    style="width: 100%; border: 2px solid {{ $errors->has('alamat') ? '#ef4444' : '#d1fae5' }}; border-radius: 10px; padding: 0.75rem 1rem 0.75rem 3rem; font-size: 1rem; background: #f8fafc; resize: none;"
                                    placeholder="Alamat lengkap"></textarea>
                            </div>
                            @error('alamat')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="password"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Password
                                <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-lock"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="password" wire:model="password" id="password"
                                    style="width: 100%; height: 48px; border: 2px solid {{ $errors->has('password') ? '#ef4444' : '#d1fae5' }}; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="Min. 8 karakter">
                            </div>
                            @error('password')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation"
                                style="display: block; margin-bottom: 0.5rem; color: #064e3b; font-weight: 500;">Konfirmasi
                                Password <span style="color: #ef4444;">*</span></label>
                            <div style="position: relative;">
                                <i class="fas fa-lock"
                                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                                <input type="password" wire:model="password_confirmation" id="password_confirmation"
                                    style="width: 100%; height: 48px; border: 2px solid #d1fae5; border-radius: 10px; padding: 0 1rem 0 3rem; font-size: 1rem; background: #f8fafc;"
                                    placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div style="display: flex; align-items: start; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <input type="checkbox" wire:model="agree_terms" id="agree_terms"
                            style="width: 1.25rem; height: 1.25rem; margin-top: 0.1rem;">
                        <label for="agree_terms" style="color: #047857; font-size: 0.9rem; cursor: pointer;">
                            Saya menyetujui <a href="#" style="color: #10b981; font-weight: 500;">Syarat & Ketentuan</a>
                        </label>
                    </div>
                    @error('agree_terms')
                        <small
                            style="color: #ef4444; display: block; margin-top: -1rem; margin-bottom: 1rem;">{{ $message }}</small>
                    @enderror

                    <!-- Register Button -->
                    <button type="submit" wire:loading.attr="disabled"
                        style="width: 100%; height: 52px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; color: white; font-size: 1rem; font-weight: 600; cursor: pointer;">
                        <span wire:loading.remove>Daftar Sekarang <i class="fas fa-arrow-right"
                                style="margin-left: 0.5rem;"></i></span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i> Memproses...
                        </span>
                    </button>
                </form>

                <!-- Login Link -->
                <div style="text-align: center; margin-top: 1.5rem; color: #047857;">
                    Sudah punya akun? <a href="{{ route('masyarakat.login') }}"
                        style="color: #10b981; font-weight: 600; text-decoration: none;">Masuk</a>
                </div>
            </div>
        </div>
    </section>
</div>