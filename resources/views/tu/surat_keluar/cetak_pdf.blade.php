<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Surat Keluar</title>
    <style>
        body {
            font-family: sans-serif;
        }
        .rangkasurat {
            margin:0 auto;
        }
        .tengah {
            text-align : center;
            margin-top: -10px;

        }
        .alamat{
            text-align: center;
            font-size: 12px;
            margin-top: -10px;
        }
        h3 {
            text-align: center;
            font-size: 18px;
        }
        table {
            border-bottom : 5px solid # 000;
            padding: 2px;
            border-collapse: collapse;
        }
        thead{
            background-color: #C3CEF4;
        }
    </style>
</head>
<body>
    <div class = "rangkasurat">
        <table width = "100%">
                <tr>
                    <td> <img src="{{ asset('image/bps.png') }}" width="120px"> </td>
                    <td class = "tengah">
                        <h3>BADAN PUSAT STATISTIK KABUPATEN KUNINGAN</h3>
                        <p class="alamat">
                            <b>Jl. RE. Martadinata No.66, Cijoho, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45513, Indonesia</b>
                        </p>
                        <p class="alamat">
                            <b>Telp/Fax: +62 232 871662, E-Mail: bps3208@bps.go.id</b>
                        </p>
                    </td>
                </tr>
        </table >
    </div>
    <hr>
    <h3>Laporan Surat Keluar</h3>
    <p style="text-align:right; font-size:12px; margin-top:-10px;">Diambil dari: {{ Carbon\Carbon::parse($tglmulai)->isoFormat('DD-MM-Y') }} s/d {{ Carbon\Carbon::parse($tglsampai)->isoFormat('DD-MM-Y') }}</p>
    <table border="1" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Asal Surat</th>
                <th>Tanggal Surat</th>
            </tr>
        </thead>
        @foreach($suratKeluar as $data)
        <tbody>
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $data['nomor'] }}</td>
                <td>{{ $data['tujuan'] }}</td>
                <td>{{ Carbon\Carbon::parse($data['tanggal'])->isoFormat('D MMMM Y') }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <table width="100%">
        <tr>
            <td></td>
            <td width="250px" style="padding-top: 20px;">
                <p>Kepala Badan Pusat Statistik<br>Kabupaten Kuningan</p>
                <br>
                <br>
                <br>
                <p><b><u>Irna Afrianti, S.Si, M.E,</u></b></p>
            </td>
        </tr>
    </table>
</body>
</html>
