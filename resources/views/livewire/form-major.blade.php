<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ route('major.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $majorID ? 'update' : 'save' }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nama Jurusan</label>
                    <input type="text" wire:model="name" class="form-control mb-1" id="name" name="name"
                        placeholder="Rekayasa Perangkat Lunak" autocomplete="off" />
                    @error('name')
                        <span class="text-sm text-danger font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-success mt-2">
                        {{ $majorID ? 'Edit' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
