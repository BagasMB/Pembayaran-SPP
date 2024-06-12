<html>

<head>
    <title>{{ $title . $transaksi->student->name }}</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
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
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
    <center>
        <table style='font-size:17pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='CENTER' vertical-align:top>
                <b>PEMBAYARAN SPP</b></br>
                <span style='color:black; text-align: center; font-size:12pt;'>
                    JL XXXXXXXXXXX <br>
                    Telp . 088888888888
                </span>
            </td>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
        </table>
        <table style='font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td align='left'>
                <span style='color:black;font-size:13pt'>
                    No Trans : {{ $transaksi->nota }}<br>
                    Student : {{ $transaksi->student->name }}
                </span>
            </td>
            <td align='right'>
                <span style='color:black;font-size:13pt'>
                    Jam : <br>
                    Tanggal :
                </span>
            </td>
        </table>
        <table cellspacing='0' cellpadding='0' style='font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan='4'>
                    <div style='text-align:left'>Total Pembayaran....................... : Rp.</div>
                </td>
                <td style='text-align:right; font-size:12pt;'> </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:left; color:black'>Bayar........................................... : Rp.
                    </div>
                </td>
                <td style='text-align:right; font-size:12pt; color:black'> </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:left; color:black'>Kembalian................................... : Rp.</div>
                </td>
                <td style='text-align:right; font-size:12pt; color:black'>
                </td>
            </tr>

            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>

        </table>
        <table style='font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>----- TERIMAKASIH -----</br></td>
            </tr>
        </table>
    </center>
</body>

</html>