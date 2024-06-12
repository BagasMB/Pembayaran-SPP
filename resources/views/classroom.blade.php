<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Data Class</h5>
                <div class="d-flex align-items-center justify-content-end">
                    <a href="/class-eksport-excel" class="btn btn-danger btn-sm me-2" type="button">
                        <i class="fa-solid fa-download me-1"></i>
                        Export Excel
                    </a>
                    <button class="btn btn-success btn-sm me-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#import-excel">
                        <i class="fa-solid fa-upload me-1"></i>
                        Import Excel
                    </button>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalTambaClass">
                        <i class="fa-solid fa-person-circle-plus me-1"></i>
                        Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Class</th>
                            <th>Jurusan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classList as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->name_class }}</td>
                                <td>{{ $list->jurusan }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditClass{{ $list->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <a type="button" id="btn-hapus" href="delete-class/{{ $list->id }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($classList as $list)
                    <div class="modal fade" id="modalEditClass{{ $list->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data Class</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="updateClass" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                        <div class="mb-3">
                                            <label for="name_class" class="form-label">Nama Class</label>
                                            <input type="text" id="name_class" name="name_class" class="form-control"
                                                value="{{ $list->name_class }}" placeholder="Enter Nama"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label for="jurusan" class="form-label">Jurusan</label>
                                            <input type="text" id="jurusan" name="jurusan" class="form-control"
                                                value="{{ $list->jurusan }}" placeholder="Enter Nama"
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



    <div class="modal fade" id="modalTambaClass" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="simpanClass" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name Class</label>
                            <input type="text" name="name_class" class="form-control" placeholder="Enter Nama"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" class="form-control"
                                placeholder="Enter Nama" autocomplete="off">
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

    <div class="modal fade" id="import-excel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="class-import-excel" method="post" enctype="multipart/form-data">
                    {{-- {{ csrf_field() }} --}}
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih FIle</label>
                            <input type="file" name="excel" class="form-control"
                                accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                placeholder="Enter Nama" autocomplete="off">
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

</x-layout>
