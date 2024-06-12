<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card card-responsive mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Students</h5>
            <span class="badge bg-label-primary float-end" type="button" data-bs-toggle="modal"
                data-bs-target="#modalTambastudent">
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
                                $tahunSekarang = date('Y');
                                $bulanSekarang = date('m');

                                // Tentukan bulan awal tahun ajaran baru
                                $bulanMulaiTahunAjaran = 7; // Misalnya bulan Juli

                                // Hitung selisih tahun
                                $selisihTahun = $tahunSekarang - $list->tahun_masuk;

                                // Sesuaikan perhitungan jika bulan sekarang kurang dari bulan awal tahun ajaran
                                if ($bulanSekarang < $bulanMulaiTahunAjaran) {
                                    $selisihTahun--;
                                }

                                // Tambahkan 1 untuk menghitung kelas, karena siswa baru dimulai dari kelas 1
                                $kelas = $selisihTahun + 1;
                                if ($kelas == 1) {
                                    $kelas = 'X ' . $list->class['name_class'];
                                } elseif ($kelas == 2) {
                                    $kelas = 'XI ' . $list->class['name_class'];
                                } elseif ($kelas == 3) {
                                    $kelas = 'XII ' . $list->class['name_class'];
                                } else {
                                    $kelas = 'Alumni ' . $list->tahun_masuk;
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->nis }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->gender }}</td>
                                <td>{{ $kelas }}</td>
                                <td>{{ $list->tahun_masuk }}</td>
                                <td>
                                    <a href="/student/transaksi/{{ $list->id }}" type="button"
                                        class="btn btn-primary btn-sm">
                                        <i class="bx bx-credit-card"></i>
                                    </a>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditStudent{{ $list->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <a type="button" id="btn-hapus" href="delete-student/{{ $list->id }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
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
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label class="form-label">Nis</label>
                                                        <input type="text" name="nis" class="form-control"
                                                            placeholder="Enter Nis" value="{{ $list->nis }}"
                                                            autocomplete="off">
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Nama" value="{{ $list->name }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="gender" class="form-label">Jenis Kelamin</label>
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
                                                    <div class="col mb-3">
                                                        <label for="class_id" class="form-label">Class</label>
                                                        <select class="form-select" id="class_id" name="class_id"
                                                            aria-label="Default select example">
                                                            @foreach ($class as $las)
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
                                                            placeholder="Tahun Masuk" value="{{ $list->tahun_masuk }}"
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



    <div class="modal fade" id="modalTambastudent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="simpanSiswa" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Nis</label>
                                <input type="text" name="nis" class="form-control" placeholder="Enter Nis"
                                    autocomplete="off">
                            </div>
                            <div class="col">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender"
                                    aria-label="Default select example">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="class_id" class="form-label">Class</label>
                                <select class="form-select" id="class_id" name="class_id"
                                    aria-label="Default select example">
                                    @foreach ($class as $las)
                                        <option value="{{ $las->id }}">{{ $las->name_class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" autocomplete="off">
                            </div>
                            <div class="col">
                                <label class="form-label">Tahun Masuk</label>
                                <input type="text" name="tahun_masuk" class="form-control"
                                    placeholder="Tahun Masuk" autocomplete="off">
                            </div>
                        </div>
                        <div>
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="2"></textarea>
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
