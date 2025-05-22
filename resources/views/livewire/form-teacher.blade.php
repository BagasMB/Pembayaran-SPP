<div>
    <div class="card col-md-6 card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ route('teacher.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $teacherID ? 'update' : 'save' }}">
                @csrf
                <div class="row">
                    <div class="">
                        <div class="form-group mb-3">
                            <label for="nip" class="form-label">Nip</label>
                            <input type="text" wire:model="nip" class="form-control" id="nip" name="nip"
                                autocomplete="off" />
                            @error('nip')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Guru</label>
                            <input type="text" wire:model="name" class="form-control" id="name" name="name"
                                autocomplete="off" />
                            @error('name')
                                <span class="text-sm mt-2 text-danger font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="major_id" class="form-label">Guru Jurusan</label>
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
                        {{ $teacherID ? 'Edit' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
