<div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-layer-group"></i>
                SIDEWA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pengumuman">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-login" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="hero-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1>Selamat Datang di <span style="color: var(--primary-color);">SIDEWA</span></h1>
                        <p>Sistem Informasi Desa terpadu yang memudahkan pelayanan administrasi dan informasi untuk
                            seluruh warga desa. Akses layanan kapan saja, di mana saja.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn-hero-primary">
                                <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                            </a>
                            <a href="#layanan" class="btn-hero-secondary">
                                <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        <img src="https://illustrations.popsy.co/emerald/home-office.svg" alt="SIDEWA Illustration"
                            style="max-height: 450px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="layanan">
        <div class="container">
            <div class="section-title">
                <h2>Layanan Kami</h2>
                <p>Berbagai layanan digital untuk memudahkan kebutuhan administrasi dan informasi warga desa</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Pengajuan Surat</h3>
                        <p>Ajukan berbagai jenis surat keterangan secara online tanpa perlu datang ke kantor desa</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Pengaduan</h3>
                        <p>Sampaikan keluhan atau aspirasi Anda langsung kepada perangkat desa</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3>Pengumuman</h3>
                        <p>Dapatkan informasi terbaru tentang berbagai kegiatan dan pengumuman desa</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Kegiatan Desa</h3>
                        <p>Pantau progress kegiatan pembangunan dan program desa secara transparan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Detail Section -->
    <section class="services-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 style="font-size: 2rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1rem;">
                        Kemudahan Layanan Administrasi Desa
                    </h2>
                    <p style="color: var(--text-muted); margin-bottom: 2rem;">
                        Dengan SIDEWA, semua kebutuhan administrasi desa dapat dilakukan secara digital dengan mudah dan
                        cepat.
                    </p>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="service-content">
                            <h4>Layanan 24/7</h4>
                            <p>Akses layanan kapan saja tanpa terbatas jam kerja kantor desa</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="service-content">
                            <h4>Akses dari Mana Saja</h4>
                            <p>Gunakan dari smartphone atau komputer Anda dengan mudah</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="service-content">
                            <h4>Aman & Terpercaya</h4>
                            <p>Data Anda terjaga keamanannya dengan sistem yang terenkripsi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://illustrations.popsy.co/emerald/app-launch.svg" alt="Services"
                        style="max-width: 100%;">
                </div>
            </div>
        </div>
    </section>

    <!-- Pengumuman Section -->
    <section class="features-section" id="pengumuman">
        <div class="container">
            <div class="section-title">
                <h2>Pengumuman Terbaru</h2>
                <p>Informasi penting dan pengumuman dari desa untuk warga</p>
            </div>
            <div class="row g-4">
                @forelse($pengumumans as $pengumuman)
                    <div class="col-md-4">
                        <div class="feature-card" style="text-align: left;">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span
                                    style="background: var(--bg-light); color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="fas fa-calendar me-1"></i>{{ $pengumuman->tanggal->format('d M Y') }}
                                </span>
                            </div>
                            <h3 style="font-size: 1.1rem;">{{ $pengumuman->judul }}</h3>
                            <p>{{ Str::limit($pengumuman->isi, 100) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p style="color: var(--text-muted);">Belum ada pengumuman terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Kegiatan Section -->
    <section class="services-section" id="kegiatan">
        <div class="container">
            <div class="section-title">
                <h2>Kegiatan Desa</h2>
                <p>Progres kegiatan dan program pembangunan desa</p>
            </div>
            <div class="row g-4">
                @forelse($kegiatans as $kegiatan)
                    <div class="col-md-6">
                        <div class="service-item" style="flex-direction: column; align-items: stretch; gap: 1rem;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="mb-1">{{ $kegiatan->nama_kegiatan }}</h4>
                                    <p class="mb-0">{{ Str::limit($kegiatan->deskripsi, 80) }}</p>
                                </div>
                                <span
                                    style="background: var(--bg-light); color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; white-space: nowrap;">
                                    {{ $kegiatan->progres }}%
                                </span>
                            </div>
                            <div class="progress" style="height: 8px; background: var(--border-color);">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $kegiatan->progres }}%; background: var(--primary-color);"
                                    aria-valuenow="{{ $kegiatan->progres }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p style="color: var(--text-muted);">Belum ada kegiatan aktif</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Bergabung dengan SIDEWA Sekarang</h2>
            <p>Daftarkan diri Anda untuk menikmati kemudahan layanan administrasi desa secara digital</p>
            <a href="{{ route('register') }}" class="btn-cta">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-layer-group me-2"></i>SIDEWA</h5>
                    <p>Sistem Informasi Desa yang memudahkan pelayanan administrasi dan informasi untuk seluruh warga
                        desa.</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#layanan">Pengajuan Surat</a></li>
                        <li class="mb-2"><a href="#layanan">Pengaduan</a></li>
                        <li class="mb-2"><a href="#pengumuman">Pengumuman</a></li>
                        <li class="mb-2"><a href="#kegiatan">Kegiatan</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. Desa No. 123</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>(021) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@sidewa.desa.id</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5>Jam Operasional</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">Senin - Jumat: 08:00 - 16:00</li>
                        <li class="mb-2">Sabtu: 08:00 - 12:00</li>
                        <li class="mb-2">Minggu: Libur</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SIDEWA. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>