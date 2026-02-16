<div>
    {{-- Page Header --}}
    <x-admin.page-header title="Ajukan Surat" subtitle="Buat permohonan surat baru">
        <x-slot:actions>
            <x-admin.button variant="outline" icon="fas fa-arrow-left" href="{{ route('masyarakat.pengajuan-surat') }}">
                Kembali
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center gap-2">
                    <i class="fas fa-file-alt" style="color: var(--primary-color);"></i>
                    Form Pengajuan Surat
                </div>

                <form wire:submit="submit" class="mt-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="jenis_surat_id" class="form-label">Jenis Surat <span
                                    style="color: var(--danger-color);">*</span></label>
                            <select class="form-select @error('jenis_surat_id') is-invalid @enderror"
                                id="jenis_surat_id" wire:model="jenis_surat_id">
                                <option value="">Pilih Jenis Surat</option>
                                @foreach($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_surat }}</option>
                                @endforeach
                            </select>
                            @error('jenis_surat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                                id="tanggal_pengajuan" wire:model="tanggal_pengajuan">
                            @error('tanggal_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="keterangan" class="form-label">Keterangan / Keperluan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                wire:model="keterangan" rows="5"
                                placeholder="Tuliskan keterangan atau keperluan surat (opsional)..."></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <x-admin.alert variant="info" class="mt-3">
                        Pengajuan surat akan diproses oleh petugas desa. Anda akan diberitahu ketika surat
                        sudah siap diambil.
                    </x-admin.alert>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <x-admin.button type="button" variant="secondary"
                            href="{{ route('masyarakat.pengajuan-surat') }}">
                            Batal
                        </x-admin.button>
                        <x-admin.button type="submit" variant="primary" icon="fas fa-paper-plane">
                            Kirim Pengajuan
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
