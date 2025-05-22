<div>
    <div class="mb-3">
        <a href="{{ asset('assets/import-excel/format-student.xlsx') }}" download class="btn btn-warning btn-sm mb-2 me-2"
            type="button">
            <i class="fa-solid fa-download me-1"></i>
            Download Format Import
        </a>
        <a href="/student-eksport-excel" class="btn btn-danger btn-sm mb-2 me-2" type="button">
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
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Students</h5>
            <a href="{{ route('student.create') }}" class="badge bg-label-primary" type="button">
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
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Tahun Masuk</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentList as $list)
                            @php
                                $kelas = new \App\Models\ClassRoom();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->nis }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->gender }}</td>
                                <td>{{ $kelas->now_class($list->tahun_masuk, $list->class->name_class) }} </td>
                                <td>{{ $list->tahun_masuk }}</td>
                                <td>
                                    <a href="/student/transaksi/{{ $list->id }}" type="button"
                                        class="btn btn-primary btn-sm">
                                        <i class="bx bx-credit-card"></i>
                                    </a>
                                    <a href="{{ route('student.edit', $list->id) }}" type="button"
                                        class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditStudent{{ $list->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel3">Edit Data Students</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="updateStudent" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $list->id }}">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Nis</label>
                                                        <input type="text" name="nis" class="form-control"
                                                            placeholder="Enter Nis" value="{{ $list->nis }}"
                                                            autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Nama" value="{{ $list->name }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="gender" class="form-label">Jenis
                                                            Kelamin</label>
                                                        <select class="form-select" id="gender" name="gender"
                                                            aria-label="Default select example">
                                                            <option value="Laki-Laki"
                                                                @if ($list->gender == 'Laki-Laki') selected @endif>
                                                                Laki-Laki</option>
                                                            <option value="Perempuan"
                                                                @if ($list->gender == 'Perempuan') selected @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="class_id" class="form-label">Class</label>
                                                        <select class="form-select" id="class_id" name="class_id"
                                                            aria-label="Default select example">
                                                            @foreach ($classList as $las)
                                                                <option value="{{ $las->id }}"
                                                                    @if ($list->class_id == $las->id) selected @endif>
                                                                    {{ $las->name_class }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control"
                                                            value="{{ $list->tanggal_lahir }}" autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Tahun Masuk</label>
                                                        <input type="text" name="tahun_masuk" class="form-control"
                                                            placeholder="Tahun Masuk"
                                                            value="{{ $list->tahun_masuk }}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="telp">No Telepon</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">
                                                            IND (+62)
                                                        </span>
                                                        <input type="text" class="form-control" name="telp"
                                                            placeholder="81234567890" value="{{ $list->telp }}"
                                                            aria-label="81234567890" id="telp"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Alamat</label>
                                                    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="2">{{ $list->alamat }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="save" class="btn btn-primary"
                                                    id="btn-save">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

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
                <form action="student-import-excel" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih FIle</label>
                            <input type="file" name="excel" class="form-control"
                                accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                placeholder="Enter Nama" autocomplete="off" required>
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
</div>
