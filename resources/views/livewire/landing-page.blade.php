<div>

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
                            <a href="{{ route('admin.login') }}" class="btn-hero-primary">
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
            <div class="text-center mt-4">
                <a href="{{ route('pengumuman') }}" class="btn-hero-secondary"
                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; font-size: 1rem;">
                    <i class="fas fa-bullhorn"></i> Lihat Semua Pengumuman
                </a>
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
            <div class="text-center mt-4">
                <a href="{{ route('kegiatan') }}"
                    style="background: white; color: var(--primary-color); border: 2px solid var(--primary-color); border-radius: 12px; padding: 0.75rem 2rem; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-calendar-alt"></i> Lihat Semua Kegiatan
                </a>
            </div>
        </div>
    </section>

    <!-- Lokasi Desa Section -->
    <section class="services-section" id="lokasi">
        <div class="container">
            <div class="section-title">
                <h2>Lokasi Desa</h2>
                <p>Temukan lokasi kantor Desa Watalara di peta</p>
            </div>
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-8">
                    <div
                        style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; min-height: 400px;">
                        <div id="map" style="width: 100%; height: 100%; min-height: 400px;"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div
                        style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); height: 100%; display: flex; flex-direction: column; justify-content: center;">
                        <h3
                            style="font-size: 1.3rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                            <i class="fas fa-building" style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                            Kantor Desa Watalara
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                                <div
                                    style="width: 40px; height: 40px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--primary-color);"></i>
                                </div>
                                <div>
                                    <h5
                                        style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        Alamat</h5>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Desa Watalara,
                                        Kecamatan Baula, Kabupaten Kolaka, Sulawesi Tenggara</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                                <div
                                    style="width: 40px; height: 40px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-phone" style="color: var(--primary-color);"></i>
                                </div>
                                <div>
                                    <h5
                                        style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        Telepon</h5>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">(021) 123-4567
                                    </p>
                                </div>
                            </div>
                            <!-- <div style="display: flex; align-items: flex-start; gap: 1rem;"> -->
                            <!--     <div -->
                            <!--         style="width: 40px; height: 40px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"> -->
                            <!--         <i class="fas fa-envelope" style="color: var(--primary-color);"></i> -->
                            <!--     </div> -->
                            <!--     <div> -->
                            <!--         <h5 -->
                            <!--             style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;"> -->
                            <!--             Email</h5> -->
                            <!--         <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;"> -->
                            <!--             info@sidewa.desa.id</p> -->
                            <!--     </div> -->
                            <!-- </div> -->
                            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                                <div
                                    style="width: 40px; height: 40px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-clock" style="color: var(--primary-color);"></i>
                                </div>
                                <div>
                                    <h5
                                        style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">
                                        Jam Kerja</h5>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Sen-Jum: 08:00 -
                                        16:00<br>Sabtu: 08:00 - 12:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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


    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Koordinat Desa Watalara, Kec. Baula, Kab. Kolaka
            var lat = -4.08;
            var lng = 121.68;

            var map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19,
            }).addTo(map);

            var customIcon = L.divIcon({
                html: '<div style="background: linear-gradient(135deg, #10b981, #059669); width: 36px; height: 36px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"></div>',
                iconSize: [36, 36],
                iconAnchor: [18, 36],
                popupAnchor: [0, -36],
                className: ''
            });

            L.marker([lat, lng], { icon: customIcon })
                .addTo(map)
                .bindPopup('<b style="font-size: 14px;">🏛️ Kantor Desa Watalara</b><br>Kec. Baula, Kab. Kolaka')
                .openPopup();
        });
    </script>

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
                        <li class="mb-2"><a href="{{ route('pengumuman') }}">Pengumuman</a></li>
                        <li class="mb-2"><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Desa Watalara, Kec. Baula, Kab.
                            Kolaka</li>
                        <!-- <li class="mb-2"><i class="fas fa-phone me-2"></i>(021) 123-4567</li> -->
                        <!-- <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@sidewa.desa.id</li> -->
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
