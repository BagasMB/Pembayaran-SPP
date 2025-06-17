<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="updateConfig">
                    <div class="col-sm-6 mb-3 d-none">
                        <input type="hidden" wire:model="id" />
                        <input type="hidden" wire:model="logo" />
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Nama</label>
                            <input type="text" class="form-control" wire:model.defer="name" autocomplete="off" />
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Judul</label>
                            <input type="text" class="form-control" wire:model.defer="judul" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" wire:model.defer="email" autocomplete="off" />
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Phone</label>
                            <input type="text" class="form-control" wire:model.defer="phone" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3">
                            <label class="col-form-label">Alamat</label>
                            <input type="text" class="form-control" wire:model.defer="alamat" autocomplete="off" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
