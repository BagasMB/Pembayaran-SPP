<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php
        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');

        // Tentukan bulan awal tahun ajaran baru
        $bulanMulaiTahunAjaran = 7; // Misalnya bulan Juli

        // Hitung selisih tahun
        $selisihTahun = $tahunSekarang - $student->tahun_masuk;

        // Sesuaikan perhitungan jika bulan sekarang kurang dari bulan awal tahun ajaran
        if ($bulanSekarang < $bulanMulaiTahunAjaran) {
            $selisihTahun--;
        }

        // Tambahkan 1 untuk menghitung kelas, karena siswa baru dimulai dari kelas 1
        $kelas = $selisihTahun + 1;
        if ($kelas == 1) {
            $kelas = 'X ' . $student->class->name_class;
        } elseif ($kelas == 2) {
            $kelas = 'XI ' . $student->class->name_class;
        } elseif ($kelas == 3) {
            $kelas = 'XII ' . $student->class->name_class;
        } else {
            $kelas = 'Alumni ' . $student->tahun_masuk;
        }
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
                            <td>{{ $kelas }} </td>
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
                                <td>{{ \Carbon\Carbon::parse($list->tanggal_bayar)->locale('id')->translatedFormat('l, d F Y') }}
                                </td>
                                <td>{{ $list->tahun_ajaran }}</td>
                                <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
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
