<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content -->

    <div class="card card-responsive mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data SPP</h5>
            <span class="badge bg-label-primary float-end" type="button" data-bs-toggle="modal"
                data-bs-target="#modalTambahSPP">
                <i class="fa-solid fa-person-circle-plus me-1"></i>
                Tambah
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tahun Ajaran</th>
                            <th>Kelas X</th>
                            <th>Kelas XI</th>
                            <th>Kelas XII</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sppList as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->tahun_ajaran }}</td>
                                <td>Rp. {{ number_format($list->spp1, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($list->spp2, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($list->spp3, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $list->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <a type="button" id="btn-hapus" href="/spp/hapus-SPP/{{ $list->id }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                @foreach ($sppList as $list)
                    <div class="modal fade" id="modalEditUser{{ $list->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data SPP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="spp/updateSPP" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                        <div class="mb-3">
                                            <label class="form-label">Tahun Ajaran</label>
                                            <input type="text" name="tahun_ajaran" class="form-control"
                                                value="{{ $list->tahun_ajaran }}" disabled autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelas X</label>
                                            <input type="number" name="spp1" class="form-control"
                                                placeholder="Rp 1.000.000" value="{{ $list->spp1 }}"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelas XI</label>
                                            <input type="number" name="spp2" class="form-control"
                                                placeholder="Rp 1.000.000" value="{{ $list->spp2 }}"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelas XII</label>
                                            <input type="number" name="spp3" class="form-control"
                                                placeholder="Rp 1.000.000" value="{{ $list->spp3 }}"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTambahSPP" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data SPP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="spp/simpanSPP" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control"
                                placeholder="{{ date('Y') }}" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas X</label>
                            <input type="number" name="spp1" class="form-control" placeholder="Rp 1.000.000"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas XI</label>
                            <input type="number" name="spp2" class="form-control" placeholder="Rp 1.000.000"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas XII</label>
                            <input type="number" name="spp3" class="form-control" placeholder="Rp 1.000.000"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- / Content -->
</x-layout>
