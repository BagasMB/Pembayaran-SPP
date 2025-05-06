<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php
        $kelas = new \App\Models\ClassRoom();
    @endphp

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
                            <td>{{ $kelas->now_class($student->tahun_masuk, $student->class->name_class) }} </td>
                        </tr>
                        <tr>
                            <td>Jurusan </td>
                            <td>:</td>
                            <td>{{ $student->class->jurusan }} </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr class="my-3 mb-4">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-bordered table-striped" width="100%">
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
                            @php
                                $transaction = new \App\Models\Transaction();
                                $total = $transaction->nominalTransaksi($list->id);
                            @endphp
                            <tr>
                                <td>{{ $list->nota }}</td>
                                <td>{{ formatDate($list->tanggal_bayar, 'l, d F Y') }}
                                </td>
                                <td>{{ $list->tahun_ajaran }}</td>
                                <td>{{ formatRupiah($total) }}</td>
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

</x-layout>
