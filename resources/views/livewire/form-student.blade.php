<div>
    <div class="card col-md-6 card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $studentID ? 'update' : 'save' }}">
                @csrf
                <div class="row">
                    <div class="">
                        <div class="form-group mb-3">
                            <label for="nis" class="form-label">Nis</label>
                            <input type="text" wire:model="nis" class="form-control" id="nis" name="nis"
                                autocomplete="off" />
                            @error('nis')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Siswa</label>
                            <input type="text" wire:model="name" class="form-control" id="name" name="name"
                                autocomplete="off" />
                            @error('name')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="class_id" class="form-label">Kelas</label>
                            <select class="form-select" id="class_id" name="class_id" wire:model.live="class_id"
                                wire:input='class_id'>
                                <option value="">Pilih Kelas</option>
                                @foreach ($class as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_class }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="gender" name="gender" wire:model.live="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" wire:model="tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir"
                                class="form-control" autocomplete="off" />
                            @error('tanggal_lahir')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                            <input type="number" wire:model="tahun_masuk" class="form-control" id="tahun_masuk"
                                name="tahun_masuk" autocomplete="off" />
                            @error('tahun_masuk')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="telp">No Telepon</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    IND (+62)
                                </span>
                                <input type="text" wire:model="telp" class="form-control" name="telp"
                                    placeholder="81234567890" aria-label="81234567890" id="telp"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                            <textarea class="form-control" wire:model="alamat" name="alamat" id="exampleFormControlTextarea1" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-success mt-2">
                        {{ $studentID ? 'Edit' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
