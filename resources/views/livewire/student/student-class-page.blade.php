<div>

    <div class="card card-responsive mb-3">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-2">Data Siswa Kelas {{ $namekelas }} </h5>
                <a href="/student/cetak-laporan/{{ $tahun_masuk }}/{{ $class_id }}" class="btn btn-primary float-end"
                    type="button" target="_blank">
                    <i class="fa-solid fa-file-export me-1"></i>
                    Cetak Laporan
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Pembayaran</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->nis }}</td>
                                <td>{{ $list->name }}</td>
                                <td>
                                    @foreach ($this->getPaymentButtons($list) as $btn)
                                        <a href="{{ $btn['url'] }}" class="btn btn-{{ $btn['style'] }} btn-sm">
                                            <strong>{{ $btn['label'] }}</strong>
                                        </a>
                                    @endforeach
                                </td>

                                <td>
                                    <a href="/student/transaksi/{{ $list->id }}" class="btn btn-success btn-sm">
                                        <i class="bx bx-credit-card"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex pt-2">
                <div class="d-flex align-items-center">
                    <div style="width: 16px; height: 16px;" class="mx-2 bg-danger"></div>
                    <span>: Belum Bayar</span>
                </div>
                <div class="d-flex align-items-center">
                    <div style="width: 16px; height: 16px;" class="mx-2 bg-info"></div>
                    <span>: Belum Lunas</span>
                </div>
                <div class="d-flex align-items-center">
                    <div style="width: 16px; height: 16px;" class="mx-2 bg-success"></div>
                    <span>: Lunas</span>
                </div>
            </div>
        </div>
    </div>

</div>
