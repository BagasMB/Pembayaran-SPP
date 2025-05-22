<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ route('spp.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                @csrf
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="tahun_ajaran1" class="form-label">Tahun Ajaran 1</label>
                            <input type="text" wire:model="tahun_ajaran1" class="form-control mb-1"
                                id="tahun_ajaran1" name="tahun_ajaran1" placeholder="{{ date('Y') }}"
                                autocomplete="off" />
                            @error('tahun_ajaran1')
                                <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="tahun_ajaran2" class="form-label">Tahun Ajaran 2</label>
                            <input type="text" wire:model="tahun_ajaran2" class="form-control mb-1"
                                id="tahun_ajaran2" name="tahun_ajaran2"
                                placeholder="{{ date('Y', strtotime('+1 year')) }}" autocomplete="off" />
                            @error('tahun_ajaran2')
                                <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="spp1" class="form-label">Kelas 1</label>
                    <input type="text" wire:model="spp1" class="form-control mb-1" id="spp1" name="spp1"
                        placeholder="Rp 1.000.000" autocomplete="off" />
                    @error('spp1')
                        <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="spp2" class="form-label">Kelas 2</label>
                    <input type="text" wire:model="spp2" class="form-control mb-1" id="spp2" name="spp2"
                        placeholder="Rp 1.000.000" autocomplete="off" />
                    @error('spp2')
                        <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="spp3" class="form-label">Kelas 3</label>
                    <input type="text" wire:model="spp3" class="form-control mb-1" id="spp3" name="spp3"
                        placeholder="Rp 1.000.000" autocomplete="off" />
                    @error('spp3')
                        <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-success mt-2">
                        {{ $sppID ? 'Edit' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
