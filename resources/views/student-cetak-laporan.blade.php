<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header,
        .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h2,
        .invoice-header h4,
        .invoice-header p {
            margin: 0;
        }

        .invoice-header h2 {
            margin-bottom: 10px;
        }

        .invoice-header h4 {
            margin-bottom: 5px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #000000;
            padding: 8px;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .invoice-footer {
            margin-top: 30px;
        }

        .invoice-footer p {
            margin: 5px 0;
        }

        .invoice-footer .signature {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>{{ $config->judul }}</h2>
            <p>{{ $config->alamat }}</p>
            <p>Telp/Fax. {{ $config->phone }} Email: {{ $config->email }}</p>
            <h5>DATA PEMBAYARAN KELAS {{ $namekelas }}</h5>
        </div>
        {{-- <div class="invoice-details">
            <p><strong>Uraian Pembayaran:</strong> Pembayaran Pengembangan Sekolah</p>
            <p><strong>Nama Siswa:</strong> Basuki</p>
            <p><strong>NISN:</strong> 2001-1</p>
            <p><strong>Kelas:</strong> 2016 TAV-1</p>
        </div> --}}
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas X</th>
                    <th>Kelas XI</th>
                    <th>Kelas XII</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->nis }}</td>
                        <td>{{ $value->name }}</td>
                        <td align="right">{{ formatRupiah($value->spp1) }}</td>
                        <td align="right">{{ formatRupiah($value->spp2) }}</td>
                        <td align="right">{{ formatRupiah($value->spp3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="invoice-footer">
            <p>TTD Bendahara</p>
            <div class="signature">
                <p>(___________)</p>
            </div>
        </div> --}}
    </div>
</body>

</html>
