<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php

        $spp1 = $spp->spp1 - $student->spp1;
        $spp2 = $spp->spp2 - $student->spp2;
        $spp3 = $spp->spp3 - $student->spp3;
        $kelas = new \App\Models\ClassRoom();
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
                                        <td align="right">{{ formatRupiah($student->spp1) }} </td>
                                        <td align="right">{{ formatRupiah($spp->spp1) }} </td>
                                        <td align="right" id="sisa_tagihan1">
                                            {{ formatRupiah($spp->spp1 - $student->spp1) }}</td>
                                    </tr>
                                @elseif ($class == 2)
                                    <tr>
                                        <td>Spp </td>
                                        <td align="right">{{ formatRupiah($student->spp2) }} </td>
                                        <td align="right">{{ formatRupiah($spp->spp2) }} </td>
                                        <td align="right" id="sisa_tagihan2">
                                            {{ formatRupiah($spp->spp2 - $student->spp2) }}</td>
                                    </tr>
                                @elseif ($class == 3)
                                    <tr>
                                        <td>Spp </td>
                                        <td align="right">{{ formatRupiah($student->spp3) }} </td>
                                        <td align="right">{{ formatRupiah($spp->spp3) }} </td>
                                        <td align="right" id="sisa_tagihan3">
                                            {{ formatRupiah($spp->spp3 - $student->spp3) }}</td>
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
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                    <input type="number" id="spp1" name="spp1"
                                                        class="form-control" value="0" required
                                                        oninput="sisaTagihan1()"
                                                        @if ($spp1 == 0) @readonly(true) @endif
                                                        autocomplete="off">
                                                </div>
                                                <input type="hidden" name="spp1_sisa" id="spp1_sisa"
                                                    value="{{ $spp1 }}" oninput="sisaTagihan1()">
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
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                    <input type="number" id="spp2" name="spp2"
                                                        class="form-control" value="0" required
                                                        oninput="sisaTagihan2()"
                                                        @if ($spp2 == 0) @readonly(true) @endif
                                                        autocomplete="off">
                                                </div>
                                                <input type="hidden" name="spp2_sisa" id="spp2_sisa"
                                                    oninput="sisaTagihan2()" value="{{ $spp2 }}">
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
                                        <input type="hidden" name="tahun_masuk"
                                            value="{{ $student->tahun_masuk }}">
                                        <input type="hidden" name="class_id" value="{{ $student->class->id }}">
                                        <tr>
                                            <td> Spp </td>
                                            <td>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                    <input type="number" name="spp3" id="spp3"
                                                        class="form-control" value="0" required
                                                        oninput="sisaTagihan3()"
                                                        @if ($spp3 == 0) @readonly(true) @endif
                                                        autocomplete="off">
                                                </div>
                                                <input type="hidden" name="spp3_sisa" id="spp3_sisa"
                                                    oninput="sisaTagihan3()" value="{{ $spp3 }}">
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
    <script>
        function formatRupiah(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        function sisaTagihan1() {
            var spp = parseFloat(document.getElementById('spp1').value) || 0;
            var spp1_sisa = parseFloat(document.getElementById('spp1_sisa').value) || 0;
            var sisa_tagihan1 = spp1_sisa - spp;

            document.getElementById('sisa_tagihan1').textContent = formatRupiah(sisa_tagihan1);
        }

        function sisaTagihan2() {
            var spp = parseFloat(document.getElementById('spp2').value) || 0;
            var spp2_sisa = parseFloat(document.getElementById('spp2_sisa').value) || 0;
            var sisa_tagihan2 = spp2_sisa - spp;

            document.getElementById('sisa_tagihan2').textContent = formatRupiah(sisa_tagihan2);
        }

        function sisaTagihan3() {
            var spp = parseFloat(document.getElementById('spp3').value) || 0;
            var spp3_sisa = parseFloat(document.getElementById('spp3_sisa').value) || 0;
            var sisa_tagihan3 = spp3_sisa - spp;

            document.getElementById('sisa_tagihan3').textContent = formatRupiah(sisa_tagihan3);
        }
    </script>

</x-layout>
