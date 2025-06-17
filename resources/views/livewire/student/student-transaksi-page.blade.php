<div>
    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-2">Data Transaksi Siswa</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-start">
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless">
                        <tr>
                            <td>Nis </td>
                            <td>:</td>
                            <td>{{ $student->nis }} </td>
                        </tr>
                        <tr>
                            <td>Nama Siswa </td>
                            <td>:</td>
                            <td>{{ $student->name }} </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin </td>
                            <td>:</td>
                            <td>{{ $student->gender }} </td>
                        </tr>
                        <tr>
                            <td>Kelas </td>
                            <td>:</td>
                            <td>{{ $kelas_now }} </td>
                        </tr>
                        <tr>
                            <td>Jurusan </td>
                            <td>:</td>
                            <td>{{ $student->class->majors->name }} </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr class="my-3 mb-4">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Bayar</th>
                            <th>Tahun Ajaran</th>
                            <th>Nominal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $list)
                            <tr>
                                <td>{{ $list->nota }}</td>
                                <td>{{ formatDate($list->tanggal_bayar, 'l, d F Y') }}
                                </td>
                                <td>{{ $list->tahun_ajaran }}</td>
                                <td>{{ formatRupiah($transactionTotals[$list->id] ?? 0) }}</td>
                                <td>
                                    <a href="/student/cetak-nota/{{ $list->student_id }}/{{ $list->id }}"
                                        type="button" class="btn btn-primary btn-sm" target="_blank">
                                        Cetak Nota
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
