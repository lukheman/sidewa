<div>

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
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('home') }}#layanan"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h3>Surat</h3>
                            <p style="font-size: 0.85rem;">Ajukan surat online</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('home') }}#layanan"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3>Pengaduan</h3>
                            <p style="font-size: 0.85rem;">Sampaikan keluhan</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('pengumuman') }}"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3>Pengumuman</h3>
                            <p style="font-size: 0.85rem;">Info terbaru desa</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('kegiatan') }}"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h3>Kegiatan</h3>
                            <p style="font-size: 0.85rem;">Progress pembangunan</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('struktur-organisasi') }}"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <h3>Organisasi</h3>
                            <p style="font-size: 0.85rem;">Aparatur & Struktur</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('transparansi-anggaran') }}"
                        style="text-decoration: none; color: inherit; display: block; height: 100%;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h3>Anggaran</h3>
                            <p style="font-size: 0.85rem;">Transparansi Dana</p>
                        </div>
                    </a>
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

    <!-- Demografis Penduduk Section -->
    <section class="features-section" id="demografis">
        <div class="container">
            <div class="section-title">
                <h2>Demografis Penduduk</h2>
                <p>Data statistik kependudukan Desa Watalara</p>
            </div>

            {{-- Stat Numbers --}}
            <div class="row g-4 mb-5 justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem;">
                        <i class="fas fa-users mb-2" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <h2
                            style="font-size: 2rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.25rem;">
                            {{ number_format($totalMasyarakat) }}</h2>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Total Penduduk</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem;">
                        <i class="fas fa-male mb-2" style="font-size: 2rem; color: #3b82f6;"></i>
                        <h2 style="font-size: 2rem; font-weight: 800; color: #3b82f6; margin-bottom: 0.25rem;">
                            {{ number_format($laki) }}</h2>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Laki-laki</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem;">
                        <i class="fas fa-female mb-2" style="font-size: 2rem; color: #ec4899;"></i>
                        <h2 style="font-size: 2rem; font-weight: 800; color: #ec4899; margin-bottom: 0.25rem;">
                            {{ number_format($perempuan) }}</h2>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Perempuan</p>
                    </div>
                </div>
            </div>

            {{-- Charts --}}
            <div class="row g-4 justify-content-center" wire:ignore>
                <div class="col-md-5">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; text-align: center;">
                        <h5 style="font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                            <i class="fas fa-venus-mars me-2" style="color: var(--primary-color);"></i>Jenis Kelamin
                        </h5>
                        <div style="max-width: 280px; margin: 0 auto;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div
                        style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem;">
                        <h5 style="font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem;">
                            <i class="fas fa-chart-bar me-2" style="color: var(--primary-color);"></i>Kelompok Usia
                        </h5>
                        <canvas id="ageChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
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


    <!-- Chart.js for Demographics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gender Doughnut Chart
            const genderCtx = document.getElementById('genderChart');
            if (genderCtx) {
                new Chart(genderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $laki }}, {{ $perempuan }}],
                            backgroundColor: ['#3b82f6', '#ec4899'],
                            borderWidth: 3,
                            borderColor: '#fff',
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '55%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 16,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { family: 'Inter', size: 13, weight: '500' }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (ctx) {
                                        let total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                        let pct = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : 0;
                                        return ctx.label + ': ' + ctx.parsed.toLocaleString('id-ID') + ' (' + pct + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Age Bar Chart
            const ageCtx = document.getElementById('ageChart');
            if (ageCtx) {
                new Chart(ageCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($ageGroups)) !!},
                        datasets: [{
                            label: 'Jumlah Penduduk',
                            data: {!! json_encode(array_values($ageGroups)) !!},
                            backgroundColor: [
                                'rgba(14, 165, 233, 0.8)',
                                'rgba(59, 130, 246, 0.8)',
                                'rgba(139, 92, 246, 0.8)',
                                'rgba(245, 158, 11, 0.8)',
                                'rgba(239, 68, 68, 0.8)'
                            ],
                            borderRadius: 8,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    font: { family: 'Inter' }
                                },
                                grid: { color: 'rgba(0,0,0,0.05)' }
                            },
                            x: {
                                ticks: { font: { family: 'Inter', weight: '500' } },
                                grid: { display: false }
                            }
                        }
                    }
                });
            }
        });
    </script>

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
                html: '<div style="background: linear-gradient(135deg, #0ea5e9, #0284c7); width: 36px; height: 36px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"></div>',
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
</div>
