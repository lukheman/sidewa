<div>
    {{-- Page Header --}}
    <x-admin.page-header title="Buat Pengaduan" subtitle="Sampaikan keluhan atau masukan Anda">
        <x-slot:actions>
            <x-admin.button variant="outline" icon="fas fa-arrow-left" href="{{ route('masyarakat.pengaduan') }}">
                Kembali
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center gap-2">
                    <i class="fas fa-pen" style="color: var(--primary-color);"></i>
                    Form Pengaduan
                </div>

                <form wire:submit="submit" class="mt-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tanggal_pengaduan" class="form-label">Tanggal Pengaduan <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="date" class="form-control @error('tanggal_pengaduan') is-invalid @enderror"
                                id="tanggal_pengaduan" wire:model="tanggal_pengaduan">
                            @error('tanggal_pengaduan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="isi_pengaduan" class="form-label">Isi Pengaduan <span
                                    style="color: var(--danger-color);">*</span></label>
                            <textarea class="form-control @error('isi_pengaduan') is-invalid @enderror"
                                id="isi_pengaduan" wire:model="isi_pengaduan" rows="8"
                                placeholder="Tuliskan pengaduan Anda secara detail..."></textarea>
                            @error('isi_pengaduan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <x-admin.alert variant="info" class="mt-3">
                        Pengaduan Anda akan ditinjau oleh petugas desa. Pastikan informasi yang disampaikan jelas dan
                        lengkap.
                    </x-admin.alert>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <x-admin.button type="button" variant="secondary" href="{{ route('masyarakat.pengaduan') }}">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary" icon="fas fa-paper-plane">
                            Kirim Pengaduan
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
