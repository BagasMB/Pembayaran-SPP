@php
    $transaction = new \App\Models\Transaction();

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
    $kelass = $selisihTahun + 1;
    if ($kelas == 1) {
        $kelas = 'X ' . $student->class->name_class;
    } elseif ($kelas == 2) {
        $kelas = 'XI ' . $student->class->name_class;
    } elseif ($kelas == 3) {
        $kelas = 'XII ' . $student->class->name_class;
    } else {
        $kelas = 'Alumni ' . $student->tahun_masuk;
    }

    // $kelas1 = substr($tahun_ajaran, 0, 4) - $student->tahun_masuk;
    // $kelas2 = substr($tahun_ajaran, 0, 4) - 1 - $student->tahun_masuk;
    // $bulan = date('m'); // cek bulan ke 7 apa bukan?

    // if ($bulan > 6) {
    //     if ($kelas1 < 1) {
    //         $kelass = 1;
    //     } elseif ($kelas1 == 1) {
    //         $kelass = 2;
    //     } elseif ($kelas1 == 2) {
    //         $kelass = 3;
    //     } else {
    //         $kelass = 4;
    //     }
    // } else {
    //     if ($kelas2 < 1) {
    //         $kelass = 1;
    //     } elseif ($kelas2 == 1) {
    //         $kelass = 2;
    //     } elseif ($kelas2 == 2) {
    //         $kelass = 3;
    //     } else {
    //         $kelass = 4;
    //     }
    // }

    if ($kelass == 1) {
        $kelass = 1;
    } elseif ($kelass == 2) {
        $kelass = 2;
    } elseif ($kelass == 3) {
        $kelass = 3;
    } else {
        $kelass = 4;
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title . $student->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice h2 {
            text-align: center;
        }

        .invoice .details {
            margin-bottom: 20px;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* .t2 {
            padding: 8px;
            border: 1px solid #000000;
        } */

        .invoice .total {
            text-align: right;
        }


        .row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .column {
            float: left;
            width: 50%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1;
            border-color: black;
        }

        /* style="padding: 8px; border: 1px solid #000000;" */
    </style>
</head>

<body>
    <div class="invoice">
        {{-- <td align='CENTER' vertical-align:top>
            <b>PEMBAYARAN SPP</b></br>
            <span style='color:black; text-align: center; font-size:12pt;'>
                JL XXXXXXXXXXX <br>
                Telp . 088888888888
            </span>
        </td> --}}
        <h2>{{ $config->judul }}</h2>
        <p style="text-align: center; margin-bottom: 2rem;margin-top: 0rem">
            {{ $config->alamat }} <br>
            Telp/Fax. {{ $config->phone }} Email: {{ $config->email }}
        </p>
        <hr>
        <p style="text-align: center">Pembayaran SPP TAHUN AJARAN {{ $transaksi->tahun_ajaran }}</p>
        <hr>

        <div class="row">
            <div class="column">
                <table>
                    <tr>
                        <td>No Nota</td>
                        <td>:</td>
                        <td>{{ $transaksi->nota }}</td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{ $transaksi->student->nis }}</td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>{{ $transaksi->student->name }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas }}</td>
                    </tr>
                </table>
            </div>
            {{-- <div class="details">
            <p><strong>Nomor Invoice:</strong> {{ $transaksi->nota }}</p>
            <p><strong>Tanggal:</strong> 3 Juni 2024</p>
        </div> --}}
            <div class="column">
                <table>
                    <tbody>
                        {{-- <tr>
                            <td>Total Pembayaran</td>
                            <td> : </td>
                            @if ($transaksi->spp1)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas1($transaksi->tahun_ajaran), 0, ',', '.') }}
                                </td>
                            @elseif($transaksi->spp2)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas2($transaksi->tahun_ajaran), 0, ',', '.') }}
                                </td>
                            @elseif($transaksi->spp3)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas3($transaksi->tahun_ajaran), 0, ',', '.') }}
                                </td>
                            @endif
                        </tr> --}}
                        {{-- <tr>
                            <td>Sudah Di Bayar</td>
                            <td> : </td>
                            @if ($kelass == 1)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas1($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($kelass == 2)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas2($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($kelass == 3)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas3($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @endif
                        </tr> --}}
                        {{-- <tr>
                            <td>Sisa Tagihan</td>
                            <td> : </td>
                            @if ($kelass == 1)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas1($transaksi->tahun_ajaran) - $transaction->stotalKelas1($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($kelass == 2)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas2($transaksi->tahun_ajaran) - $transaction->stotalKelas2($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($kelass == 3)
                                <td>RP.
                                    {{ number_format($transaction->total_kelas3($transaksi->tahun_ajaran) - $transaction->stotalKelas2($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @endif
                        </tr> --}}

                        <tr>
                            <td>Tgl. Pembayaran</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->locale('id')->translatedFormat('l, d F Y') }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>Sudah Di Bayar</td>
                            <td> : </td>
                            @if ($transaksi->spp1)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas1($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($transaksi->spp2)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas2($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @elseif ($transaksi->spp3)
                                <td>RP.
                                    {{ number_format($transaction->stotalKelas3($transaksi->student->id), 0, ',', '.') }}
                                </td>
                            @endif
                        </tr> --}}
                        <tr>
                            <td>Di Bayar</td>
                            <td> : </td>
                            @if ($transaksi->spp1)
                                <td>{{ formatRupiah($transaksi->spp1) }}
                                </td>
                            @elseif($transaksi->spp2)
                                <td>{{ formatRupiah($transaksi->spp2) }}
                                </td>
                            @elseif($transaksi->spp3)
                                <td>{{ formatRupiah($transaksi->spp3) }}
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <table style='font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>----- TERIMAKASIH -----</br></td>
            </tr>
        </table>
        {{-- <div class="total">
            <p><strong>:</strong> </p>
        </div> --}}
    </div>
</body>

</html>
