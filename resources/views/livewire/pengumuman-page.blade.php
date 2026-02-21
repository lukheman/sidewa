<div>
    {{-- Header Section --}}
    <section style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 8rem 0 4rem;">
        <div class="container">
            <div class="text-center">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem;">
                    <i class="fas fa-bullhorn me-2" style="color: var(--primary-color);"></i>Pengumuman Desa
                </h1>
                <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto 2rem;">
                    Informasi penting dan pengumuman terbaru dari pemerintah desa untuk warga
                </p>
                {{-- Search --}}
                <div class="d-flex justify-content-center">
                    <div class="input-group" style="max-width: 500px;">
                        <span class="input-group-text"
                            style="background: white; border: 2px solid var(--border-color); border-right: none; border-radius: 12px 0 0 12px;">
                            <i class="fas fa-search" style="color: var(--text-muted);"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari pengumuman..."
                            wire:model.live.debounce.300ms="search"
                            style="border: 2px solid var(--border-color); border-left: none; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem; font-size: 1rem;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pengumuman List --}}
    <section style="padding: 4rem 0; background: white;">
        <div class="container">
            <div class="row g-4">
                @forelse($pengumumans as $pengumuman)
                    <div class="col-md-6 col-lg-4" wire:key="pengumuman-{{ $pengumuman->id }}">
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 2rem; height: 100%; transition: all 0.3s ease; cursor: default;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(16, 185, 129, 0.15)'; this.style.borderColor='var(--primary-light)';"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='var(--border-color)';">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span
                                    style="background: var(--bg-light); color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="fas fa-calendar me-1"></i>{{ $pengumuman->tanggal->format('d M Y') }}
                                </span>
                            </div>
                            <h3
                                style="font-size: 1.15rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.75rem; line-height: 1.4;">
                                {{ $pengumuman->judul }}
                            </h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; margin-bottom: 1rem;">
                                {{ Str::limit($pengumuman->isi, 150) }}
                            </p>
                            @if($pengumuman->user)
                                <div class="d-flex align-items-center gap-2 mt-auto">
                                    <div
                                        style="width: 28px; height: 28px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="color: white; font-size: 0.7rem;"></i>
                                    </div>
                                    <small style="color: var(--text-muted);">{{ $pengumuman->user->name }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-bullhorn mb-3" style="font-size: 3rem; color: var(--border-color);"></i>
                        <p style="color: var(--text-muted); font-size: 1.1rem;">
                            @if($search)
                                Tidak ditemukan pengumuman dengan kata kunci "{{ $search }}"
                            @else
                                Belum ada pengumuman saat ini
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($pengumumans->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $pengumumans->links() }}
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