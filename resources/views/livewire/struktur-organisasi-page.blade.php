<div>
    {{-- Header Section --}}
    <section style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 8rem 0 4rem;">
        <div class="container">
            <div class="text-center">
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem;">
                    <i class="fas fa-sitemap me-2" style="color: var(--primary-color);"></i>Struktur Organisasi Desa
                </h1>
                <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Susunan aparatur pemerintahan desa yang siap melayani masyarakat dengan sepenuh hati
                </p>
            </div>
        </div>
    </section>

    {{-- Struktur Diagram Section --}}
    <section style="padding: 5rem 0; background: white;">
        <div class="container">
            @if($aparaturList->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-users mb-3" style="font-size: 4rem; color: var(--border-color);"></i>
                    <h3 style="color: var(--text-muted); font-weight: 600;">Data struktur organisasi belum tersedia</h3>
                    <p style="color: var(--text-secondary);">Silakan hubungi administrator untuk menambahkan data aparatur desa.</p>
                </div>
            @else
                <div class="row justify-content-center g-4">
                    {{-- We assume urutan 1 is Kepala Desa (Top Level) --}}
                    @php
                        $topLevel = $aparaturList->where('urutan', 1)->first();
                        $others = $aparaturList->where('urutan', '>', 1)->sortBy('urutan');
                    @endphp

                    @if($topLevel)
                        <div class="col-12 text-center mb-5">
                            <div class="d-inline-block" style="position: relative;">
                                <div style="background: white; border: 2px solid var(--primary-color); border-radius: 20px; padding: 2rem; width: 300px; box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15); position: relative; z-index: 2;">
                                    <div style="width: 120px; height: 120px; margin: 0 auto 1.5rem; border-radius: 50%; overflow: hidden; border: 4px solid var(--bg-light); box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
                                        @if($topLevel->foto)
                                            <img src="{{ Storage::url($topLevel->foto) }}" alt="{{ $topLevel->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div style="width: 100%; height: 100%; background: var(--bg-light); display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="font-size: 3rem; color: var(--primary-color);"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">{{ $topLevel->nama }}</h3>
                                    <div style="background: var(--primary-color); color: white; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600; display: inline-block; margin-bottom: 0.75rem;">
                                        {{ $topLevel->jabatan }}
                                    </div>
                                    @if($topLevel->nip)
                                        <div style="color: var(--text-secondary); font-size: 0.85rem;">NIP: {{ $topLevel->nip }}</div>
                                    @endif
                                </div>
                                {{-- Vertical Line connecting to others --}}
                                @if($others->isNotEmpty())
                                    <div style="position: absolute; bottom: -3rem; left: 50%; width: 2px; height: 3rem; background: var(--primary-color); transform: translateX(-50%); z-index: 1;"></div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($others->isNotEmpty())
                        {{-- Horizontal Line for others --}}
                        @if($topLevel)
                            <div class="col-12 p-0 m-0" style="position: relative; height: 2px; background: var(--primary-color); width: calc(100% - 300px); max-width: 800px; margin: 0 auto !important; z-index: 1;"></div>
                        @endif

                        <div class="col-12 mt-4">
                            <div class="row justify-content-center g-4">
                                @foreach($others as $aparatur)
                                    <div class="col-md-6 col-lg-4 text-center">
                                        {{-- Vertical line from horizontal --}}
                                        @if($topLevel)
                                            <div style="width: 2px; height: 2rem; background: var(--primary-color); margin: -1.5rem auto 0; z-index: 1;"></div>
                                        @endif
                                        
                                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem; transition: all 0.3s ease; height: 100%; position: relative; z-index: 2;"
                                            onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'; this.style.borderColor='var(--primary-light)';"
                                            onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='var(--border-color)';">
                                            <div style="width: 90px; height: 90px; margin: 0 auto 1.25rem; border-radius: 50%; overflow: hidden; border: 3px solid var(--bg-light);">
                                                @if($aparatur->foto)
                                                    <img src="{{ Storage::url($aparatur->foto) }}" alt="{{ $aparatur->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <div style="width: 100%; height: 100%; background: var(--bg-light); display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-user" style="font-size: 2.5rem; color: var(--text-muted);"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <h4 style="font-size: 1.1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">{{ $aparatur->nama }}</h4>
                                            <div style="color: var(--primary-color); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem;">
                                                {{ $aparatur->jabatan }}
                                            </div>
                                            @if($aparatur->nip)
                                                <div style="color: var(--text-secondary); font-size: 0.8rem;">NIP: {{ $aparatur->nip }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
