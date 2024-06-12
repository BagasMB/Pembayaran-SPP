<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

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
                                    @php
                                        $cek1 = $list->spp1;
                                        $plus = $list->tahun_masuk + 1;
                                        $cetak = $list->tahun_masuk . '/' . $plus;
                                    @endphp
                                    <a href="{{ route('student.pembayaran', ['student_id' => $list->id, 'class' => 1, 'thn1' => $list->tahun_masuk, 'thn2' => $plus]) }}"
                                        class="btn btn-{{ $cek1 < 1 ? 'danger' : 'info' }} btn-sm"><strong>{{ $cetak }}</strong></a>
                                    @if ($kelas > 1)
                                        @php
                                            $cek2 = $list->spp2;
                                            $plus1 = $list->tahun_masuk + 1;
                                            $plus2 = $list->tahun_masuk + 2;
                                            $cetak = $plus1 . '/' . $plus2;
                                        @endphp
                                        <a href="{{ route('student.pembayaran', ['student_id' => $list->id, 'class' => 2, 'thn1' => $plus1, 'thn2' => $plus2]) }}"
                                            class="btn btn-{{ $cek2 < 1 ? 'danger' : 'info' }} btn-sm"><strong>{{ $cetak }}</strong></a>
                                    @endif
                                    @if ($kelas > 2)
                                        @php
                                            $cek3 = $list->spp3;
                                            $plus1 = $list->tahun_masuk + 2;
                                            $plus2 = $list->tahun_masuk + 3;
                                            $cetak = $plus1 . '/' . $plus2;
                                        @endphp
                                        <a href="{{ route('student.pembayaran', ['student_id' => $list->id, 'class' => 3, 'thn1' => $plus1, 'thn2' => $plus2]) }}"
                                            class="btn btn-{{ $cek3 < 1 ? 'danger' : 'info' }} btn-sm"><strong>{{ $cetak }}</strong></a>
                                    @endif
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
        </div>
    </div>

</x-layout>
