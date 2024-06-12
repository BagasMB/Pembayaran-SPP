<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="/update-config" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6 mb-3">
                        <div class="input-group input-group-merge">
                            <input type="hidden" class="form-control" name="id" value="{{ $config->id }}"
                                autocomplete="off" />
                            <input type="hidden" class="form-control" name="logo" value="{{ $config->logo }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" name="name" value="{{ $config->name }}"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-sm-2 col-form-label">Judul</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="judul" class="form-control" value="{{ $config->judul }}"
                                    autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $config->email }}"
                                autocomplete="off" />
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $config->phone }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ $config->alamat }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
