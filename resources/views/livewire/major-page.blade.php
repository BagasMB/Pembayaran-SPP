<div>
    <div class="card card-responsive mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Jurusan</h5>
            <a href="{{ route('major.create') }}" class="badge bg-label-primary float-end" type="button">
                <i class="fa-solid fa-person-circle-plus me-1"></i>
                Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Jurusan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->name }}</td>
                                <td>
                                    <a href="{{ route('major.edit', $list->id) }}" type="button"
                                        class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <a type="button" id="btn-hapus" href="" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
