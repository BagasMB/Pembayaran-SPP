<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ route('classroom.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $classID ? 'update' : 'save' }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <label for="nameClass" class="form-label">Nama Class</label>
                        <input type="text" wire:model="nameClass" class="form-control" id="nameClass"
                            name="nameClass" autocomplete="off" />
                        @error('nameClass')
                            <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="major_id" class="form-label">Jurusan</label>
                        <select class="form-select" id="major_id" name="major_id" wire:model.live="major_id"
                            wire:input='major_id'>
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ $classID ? 'Edit' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
