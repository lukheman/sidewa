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
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; height: 100%; transition: all 0.3s ease;"
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
</div>