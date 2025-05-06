<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        @php
            $kelas = new \App\Models\ClassRoom();
        @endphp

        <div class="card card-responsive m-5">
            <div class="card-header">
                <h5 class="mb-2">Data Transaksi Siswa</h5>
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
                    <table id="myTable" class="table table-bordered table-striped mb-3">
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
                            @forelse ($transaksi as $list)
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
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="badge bg-warning">Belum Melakukan Transaksi Sama Sekali</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Klik disini untuk
                        kembali. . .</a>
                </div>
            </div>
        </div>

    </div>


    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
