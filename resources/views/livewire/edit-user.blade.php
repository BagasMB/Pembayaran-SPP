<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data User</h5>
                <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="updateUser" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="input-group input-group-merge">
                            <input type="text" wire:model="name" class="form-control" name="name"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="input-group input-group-merge">
                            <input type="text" wire:model="username" name="username" class="form-control"
                                autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control" name="email"
                            autocomplete="off" />
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">User Role</label>
                        <select wire:model="userRole" class="form-select">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ ucwords($role) }}</option>
                            @endforeach
                        </select>
                        @error('userRole')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>
