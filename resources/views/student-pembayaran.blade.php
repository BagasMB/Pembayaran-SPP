<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php

        $spp1 = $spp->spp1 - $student->spp1;
        $spp2 = $spp->spp2 - $student->spp2;
        $spp3 = $spp->spp3 - $student->spp3;

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
                <h5 class="mb-2">Data Siswa</h5>
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
            <div class="row">
                <div class="col-xxl-6 mb-3">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>-</th>
                                    <th>Sudah DiBayar</th>
                                    <th>Tagihan Thn.{{ $tahun_ajaran }}</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($class == 1)
                                    <tr>
                                        <td>Spp </td>
                                        <td align="right">Rp. {{ number_format($student->spp1, 0, ',', '.') }} </td>
                                        <td align="right">Rp. {{ number_format($spp->spp1, 0, ',', '.') }} </td>
                                        <td align="right">Rp.
                                            {{ number_format($spp->spp1 - $student->spp1, 0, ',', '.') }}</td>
                                    </tr>
                                @elseif ($class == 2)
                                    <tr>
                                        <td>Spp </td>
                                        <td align="right">Rp. {{ number_format($student->spp2, 0, ',', '.') }} </td>
                                        <td align="right">Rp. {{ number_format($spp->spp2, 0, ',', '.') }} </td>
                                        <td align="right">Rp.
                                            {{ number_format($spp->spp2 - $student->spp2, 0, ',', '.') }}</td>
                                    </tr>
                                @elseif ($class == 3)
                                    <tr>
                                        <td>Spp </td>
                                        <td align="right">Rp. {{ number_format($student->spp3, 0, ',', '.') }} </td>
                                        <td align="right">Rp. {{ number_format($spp->spp3, 0, ',', '.') }} </td>
                                        <td align="right">Rp.
                                            {{ number_format($spp->spp3 - $student->spp3, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pembayaran</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="/student/bayar" method="POST">
                                    @csrf
                                    @if ($class == 1)
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                        <input type="hidden" name="kelas" value="{{ $class }}">
                                        <input type="hidden" name="tahun_masuk" value="{{ $student->tahun_masuk }}">
                                        <input type="hidden" name="class_id" value="{{ $student->class->id }}">
                                        <tr>
                                            <td> Spp </td>
                                            <td>
                                                <input type="number" name="spp1" class="form-control" value="0"
                                                    required @if ($spp1 == 0) @readonly(true) @endif>
                                                <input type="hidden" name="spp1_lama" value="{{ $student->spp1 }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Tanggal </td>
                                            <td>
                                                <input type="date" name="tanggal_bayar" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                        @if ($spp1 > 1)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-block">Bayar</button>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <button type="button" disabled
                                                            class="btn btn-success">Lunas</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif ($class == 2)
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                        <input type="hidden" name="kelas" value="{{ $class }}">
                                        <input type="hidden" name="tahun_masuk" value="{{ $student->tahun_masuk }}">
                                        <input type="hidden" name="class_id" value="{{ $student->class->id }}">
                                        <tr>
                                            <td> Spp </td>
                                            <td>
                                                <input type="number" name="spp2" class="form-control" value="0"
                                                    @if ($spp2 == 0) @readonly(true) @endif>
                                                <input type="hidden" name="spp2_lama" value="{{ $student->spp2 }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Tanggal </td>
                                            <td>
                                                <input type="date" name="tanggal_bayar" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                        @if ($spp2 > 1)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-block">Bayar</button>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <button type="button" disabled
                                                            class="btn btn-success">Lunas</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif ($class == 3)
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                        <input type="hidden" name="kelas" value="{{ $class }}">
                                        <input type="hidden" name="tahun_masuk" value="{{ $student->tahun_masuk }}">
                                        <input type="hidden" name="class_id" value="{{ $student->class->id }}">
                                        <tr>
                                            <td> Spp </td>
                                            <td>
                                                <input type="number" name="spp3" class="form-control"
                                                    value="0"
                                                    @if ($spp3 == 0) @readonly(true) @endif>
                                                <input type="hidden" name="spp3_lama" value="{{ $student->spp3 }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Tanggal </td>
                                            <td>
                                                <input type="date" name="tanggal_bayar" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                        @if ($spp3 > 1)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-block">Bayar</button>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <button type="button" disabled
                                                            class="btn btn-success">Lunas</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>