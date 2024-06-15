<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content -->

    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang Di Aplikasi SPPKU 🎉</h5>
                            <p class="mb-4">
                                Anda Login Sebagai {{ Auth::user()->role }}
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                            </p>

                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                Badges</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="assets/img/icons/unicons/chart-success.png" alt="chart success"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Student</span>
                            <h3 class="card-title mb-2">{{ $cont_student }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">SPP</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $cont_spp }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card card-responsive">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-2">Data Transaksi Siswa Terbaru</h5>
                        {{-- <span class="badge bg-label-primary float-end" type="button" data-bs-toggle="modal"
                            data-bs-target="#cetaklaporan">
                            <i class="fa-solid fa-file-export me-1"></i>
                            Cetak Laporan
                        </span> --}}
                    </div>
                </div>
                <div class="card-body">
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
        </div>
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Transaksi Bulan</h5>
                                        <span class="badge bg-label-warning rounded-pill">
                                            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}
                                        </span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        {{-- <small class="text-success text-nowrap fw-semibold">
                                            <i class="bx bx-chevron-up"></i> 68.2%</small> --}}
                                        <p class="mb-0">Rp. {{ number_format($transbulan, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="d-block mb-1">Class</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $cont_class }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Transaksi Hari Ini</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $jmltransaksiToday }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- / Content -->

    <div class="modal fade" id="cetaklaporan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dashboard-laporan" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggal1" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="tanggal2" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="print" class="btn btn-primary">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
