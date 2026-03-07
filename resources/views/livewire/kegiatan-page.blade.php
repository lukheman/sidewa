<div>
    {{-- Header Section --}}
    <section style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 8rem 0 4rem;">
        <div class="container">
            <div class="text-center">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem;">
                    <i class="fas fa-calendar-alt me-2" style="color: var(--primary-color);"></i>Kegiatan Desa
                </h1>
                <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto 2rem;">
                    Pantau progress kegiatan pembangunan dan program desa secara transparan
                </p>
                {{-- Search --}}
                <div class="d-flex justify-content-center">
                    <div class="input-group" style="max-width: 500px;">
                        <span class="input-group-text"
                            style="background: white; border: 2px solid var(--border-color); border-right: none; border-radius: 12px 0 0 12px;">
                            <i class="fas fa-search" style="color: var(--text-muted);"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari kegiatan..."
                            wire:model.live.debounce.300ms="search"
                            style="border: 2px solid var(--border-color); border-left: none; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem; font-size: 1rem;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kegiatan List --}}
    <section style="padding: 4rem 0; background: white;">
        <div class="container">
            <div class="row g-4">
                @forelse($kegiatans as $kegiatan)
                    <div class="col-md-6" wire:key="kegiatan-{{ $kegiatan->id }}">
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; height: 100%; transition: all 0.3s ease; cursor: pointer;"
                            wire:click="openModal({{ $kegiatan->id }})"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(16, 185, 129, 0.15)'; this.style.borderColor='var(--primary-light)';"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='var(--border-color)';">
                            {{-- Title & Progress Badge --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3
                                        style="font-size: 1.15rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                                        {{ $kegiatan->nama_kegiatan }}
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span
                                            style="background: var(--bg-light); color: var(--primary-color); padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                            <i
                                                class="fas fa-calendar me-1"></i>{{ $kegiatan->tanggal_mulai->format('d M Y') }}
                                        </span>
                                        @if($kegiatan->tanggal_selesai)
                                            <span style="color: var(--text-muted); font-size: 0.75rem;">
                                                s/d {{ $kegiatan->tanggal_selesai->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <span
                                    style="background: {{ $kegiatan->isCompleted() ? 'var(--success-color)' : ($kegiatan->isInProgress() ? 'var(--primary-color)' : '#f59e0b') }}; color: white; padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.85rem; font-weight: 700; white-space: nowrap;">
                                    {{ $kegiatan->progres }}%
                                </span>
                            </div>

                            {{-- Description --}}
                            <p
                                style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; margin-bottom: 1.25rem;">
                                {{ Str::limit($kegiatan->deskripsi, 150) }}
                            </p>

                            {{-- Foto Dokumentasi --}}
                            @if(!empty($kegiatan->foto_dokumentasi))
                                <div style="margin-bottom: 1.25rem;">
                                    <h5
                                        style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">
                                        <i class="fas fa-camera me-1"></i> Dokumentasi
                                    </h5>
                                    <div class="d-flex gap-2" style="overflow-x: auto; padding-bottom: 0.5rem;">
                                        @foreach($kegiatan->foto_dokumentasi as $foto)
                                            <a href="{{ Storage::url($foto) }}" target="_blank" style="flex-shrink: 0;">
                                                <img src="{{ Storage::url($foto) }}" alt="Dokumentasi Kegiatan"
                                                    style="height: 60px; width: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Progress Bar --}}
                            <div style="margin-bottom: 1rem;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small style="color: var(--text-secondary); font-weight: 500;">Progress</small>
                                    <small style="color: var(--text-muted);">
                                        @if($kegiatan->isCompleted())
                                            <i class="fas fa-check-circle me-1" style="color: var(--success-color);"></i>Selesai
                                        @elseif($kegiatan->isInProgress())
                                            <i class="fas fa-spinner me-1" style="color: var(--primary-color);"></i>Berjalan
                                        @else
                                            <i class="fas fa-clock me-1" style="color: #f59e0b;"></i>Belum Dimulai
                                        @endif
                                    </small>
                                </div>
                                <div
                                    style="height: 10px; background: var(--border-color); border-radius: 50px; overflow: hidden;">
                                    <div
                                        style="width: {{ $kegiatan->progres }}%; height: 100%; background: {{ $kegiatan->isCompleted() ? 'var(--success-color)' : 'var(--primary-color)' }}; border-radius: 50px; transition: width 0.5s ease;">
                                    </div>
                                </div>
                            </div>

                            {{-- Responsible User --}}
                            @if($kegiatan->user)
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        style="width: 28px; height: 28px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="color: white; font-size: 0.7rem;"></i>
                                    </div>
                                    <small style="color: var(--text-muted);">Penanggung Jawab:
                                        {{ $kegiatan->user->name }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-calendar-alt mb-3" style="font-size: 3rem; color: var(--border-color);"></i>
                        <p style="color: var(--text-muted); font-size: 1.1rem;">
                            @if($search)
                                Tidak ditemukan kegiatan dengan kata kunci "{{ $search }}"
                            @else
                                Belum ada kegiatan saat ini
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($kegiatans->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $kegiatans->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Back to Home --}}
    <section style="padding: 3rem 0; background: var(--bg-light); text-align: center;">
        <a href="{{ route('home') }}"
            style="color: var(--primary-color); text-decoration: none; font-weight: 600; font-size: 1rem;">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
        </a>
    </section>

    {{-- Detail Modal --}}
    @if($showModal && $selectedKegiatan)
        <div class="modal-backdrop-custom" wire:click.self="closeModal"
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content-custom" wire:click.stop
                style="background: white; border-radius: 16px; width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; padding: 2rem; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <button type="button" wire:click="closeModal"
                    style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; font-size: 1.5rem; color: var(--text-muted); cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>

                <h3
                    style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1rem; padding-right: 2rem;">
                    {{ $selectedKegiatan->nama_kegiatan }}
                </h3>

                <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                    <span
                        style="background: var(--bg-light); color: var(--primary-color); padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                        <i class="fas fa-calendar me-2"></i>{{ $selectedKegiatan->tanggal_mulai->format('d M Y') }}
                        @if($selectedKegiatan->tanggal_selesai)
                            s/d {{ $selectedKegiatan->tanggal_selesai->format('d M Y') }}
                        @endif
                    </span>
                    <span
                        style="background: {{ $selectedKegiatan->isCompleted() ? 'var(--success-color)' : ($selectedKegiatan->isInProgress() ? 'var(--primary-color)' : '#f59e0b') }}; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 700;">
                        Progress: {{ $selectedKegiatan->progres }}%
                    </span>
                    @if($selectedKegiatan->user)
                        <span style="color: var(--text-muted); font-size: 0.85rem;">
                            <i class="fas fa-user-circle me-1"></i> PJ: {{ $selectedKegiatan->user->name }}
                        </span>
                    @endif
                </div>

                @if(!empty($selectedKegiatan->foto_dokumentasi))
                    <div class="mb-4">
                        <div id="kegiatanCarousel" class="carousel slide" data-bs-ride="carousel"
                            style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            @if(count($selectedKegiatan->foto_dokumentasi) > 1)
                                <div class="carousel-indicators">
                                    @foreach($selectedKegiatan->foto_dokumentasi as $index => $foto)
                                        <button type="button" data-bs-target="#kegiatanCarousel" data-bs-slide-to="{{ $index }}"
                                            class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif

                            <div class="carousel-inner">
                                @foreach($selectedKegiatan->foto_dokumentasi as $index => $foto)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <div
                                            style="background: #000; display: flex; align-items: center; justify-content: center; height: 350px;">
                                            <img src="{{ Storage::url($foto) }}"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                                alt="Dokumentasi {{ $index + 1 }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if(count($selectedKegiatan->foto_dokumentasi) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#kegiatanCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"
                                        style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 1.5rem;"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#kegiatanCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"
                                        style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 1.5rem;"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

                <div>
                    <h5 style="font-size: 1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.75rem;">
                        Deskripsi Kegiatan</h5>
                    <div style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.8; white-space: pre-wrap;">
                        {{ $selectedKegiatan->deskripsi }}</div>
                </div>
            </div>
        </div>
    @endif
</div>