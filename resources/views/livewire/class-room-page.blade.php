<div>
    <div class="mb-3">
        <a href="{{ asset('assets/import-excel/format-class.xlsx') }}" download class="btn btn-warning btn-sm mb-2 me-2"
            type="button">
            <i class="fa-solid fa-download me-1"></i>
            Download Format Import
        </a>
        <a href="/class-eksport-excel" class="btn btn-danger btn-sm mb-2 me-2" type="button">
            <i class="fa-solid fa-download me-1"></i>
            Export Excel
        </a>
        <button class="btn btn-success btn-sm mb-2 me-2" type="button" data-bs-toggle="modal"
            data-bs-target="#import-excel">
            <i class="fa-solid fa-upload me-1"></i>
            Import Excel
        </button>
    </div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Data Class</h5>
                <a href="{{ route('classroom.create') }}" class="badge bg-label-primary" type="button">
                    <i class="fa-solid fa-person-circle-plus me-1"></i>
                    Tambah
                </a>
            </div>
            <div class="form-group d-flex align-items-center justify-content-between mt-3">
                <div>
                    <label>
                        Show
                        <select wire:model.live="paginate" class="border rounded px-2 py-1 text-sm text-secondary">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </label>
                </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" wire:model="search" wire:keyup="updateSearch($event.target.value)"
                            class="form-control" placeholder="Search..." aria-label="Search..."
                            aria-describedby="basic-addon-search31">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" width="100%">
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
                                <td>{{ $classList->firstItem() + $loop->index }}</td>
                                <td>{{ $list->name_class }}</td>
                                <td>{{ $list->majors->name }}</td>
                                <td>
                                    <a href="{{ route('classroom.edit', $list->id) }}" type="button"
                                        class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    {{-- <a href="{{ route('classroom.destroy', $list->id) }}" type="button" id="btn-hapus"
                                        class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                    </a> --}}

                                    <button type="button" class="btn btn-danger btn-sm"
                                        wire:click.prevent="confirmDelete({{ $list->id }})">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Showing {{ $classList->firstItem() }} to {{ $classList->lastItem() }} of
                    {{ $classList->total() }} entries
                </div>
                <div>
                    {{ $classList->links('pagination::bootstrap-4') }}
                </div>
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
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
