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
                        <div class="col-12">
                            <label for="jenis_surat_id" class="form-label">Jenis Surat <span
                                    style="color: var(--danger-color);">*</span></label>
                            <select class="form-select @error('jenis_surat_id') is-invalid @enderror"
                                id="jenis_surat_id" wire:model.live="jenis_surat_id">
                                <option value="">Pilih Jenis Surat</option>
                                @foreach($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_surat }}</option>
                                @endforeach
                            </select>
                            @error('jenis_surat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div wire:loading wire:target="jenis_surat_id" class="text-primary mt-2" style="font-size: 0.85rem;">
                                <i class="fas fa-spinner fa-spin me-1"></i> Memuat form khusus...
                            </div>
                        </div>

                        {{-- Dynamic Fields --}}
                        @if(count($dynamicFields) > 0)
                            <div class="col-12 mt-2">
                                <div class="p-4" style="background: var(--bg-secondary); border-radius: 8px; border: 1px solid var(--border-color);">
                                    <h6 class="mb-3" style="color: var(--primary-color); font-weight: 600;">
                                        <i class="fas fa-clipboard-list me-2"></i>Data Spesifik Surat
                                    </h6>
                                    <div class="row g-3">
                                        @foreach($dynamicFields as $field)
                                            <div class="col-12 col-md-6">
                                                <label for="field_{{ $field['name'] }}" class="form-label">{{ $field['label'] }} <span style="color: var(--danger-color);">*</span></label>
                                                
                                                @if(isset($field['type']) && $field['type'] === 'textarea')
                                                    <textarea class="form-control @error('data_tambahan.' . $field['name']) is-invalid @enderror" 
                                                        id="field_{{ $field['name'] }}" wire:model="data_tambahan.{{ $field['name'] }}" rows="3"></textarea>
                                                @elseif(isset($field['type']) && $field['type'] === 'date')
                                                    <input type="date" class="form-control @error('data_tambahan.' . $field['name']) is-invalid @enderror" 
                                                        id="field_{{ $field['name'] }}" wire:model="data_tambahan.{{ $field['name'] }}">
                                                @elseif(isset($field['type']) && $field['type'] === 'number')
                                                    <input type="number" class="form-control @error('data_tambahan.' . $field['name']) is-invalid @enderror" 
                                                        id="field_{{ $field['name'] }}" wire:model="data_tambahan.{{ $field['name'] }}">
                                                @else
                                                    <input type="text" class="form-control @error('data_tambahan.' . $field['name']) is-invalid @enderror" 
                                                        id="field_{{ $field['name'] }}" wire:model="data_tambahan.{{ $field['name'] }}">
                                                @endif
                                                
                                                @error('data_tambahan.' . $field['name'])
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

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