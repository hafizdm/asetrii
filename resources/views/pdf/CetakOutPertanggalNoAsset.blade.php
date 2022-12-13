<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            font-family: DejaVu Sans;
            
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            text-align: center;
            padding: 8px;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
            font-size: 12px;
        }
        th {
            background-color: #949994;
            color: white;
        }
        h3 {
            text-align: center;
        }
        p {
            margin: 1;
        }
        .logo {
            max-width: 25%;
            margin-bottom: 10px;
        }
        .signature-wrapper {

            text-align: right;
            margin-right: 0;
            margin-top: 25px;
            font-size: 0.8em;
        }

    </style>
</head>
<body>
        <img src="{{ public_path('assets/dist/img/rapid-logo.png') }}" alt="logo" class="logo">
    <h3>DATA BARANG KELUAR NON ASSET</h3>

    {{-- <p>Nama Departemen : {{ $division }}</p>
    <p>{{ $header }}</p>
    <p>Dicetak Tanggal: {{ date('d/m/Y') }} </p> --}}


    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Barang</th>
                <th>Merk</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Ukuran</th>
                <th>Penerima</th>
                <th>Jabatan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
                    <td>{{ $row->item->kind->name }}</td>
                    <td>{{ $row->item->merk->name }}</td>
                    <td>{{ $row->item->name }}</td>
                    <td>{{ (int)$row->amount }}</td>
                    <td>{{ $row->item->ukuran }}</td>
                    <td>{{ $row->reciever }}</td>
                    <td>{{ $row->role }}</td>
                    <td>{{ $row->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="signature-wrapper">
        <p>Berikut merupakan daftar Non-Asset tanggal {{ date('d/m/Y') }}</p>
        <table class="signature">
            <tr>
                <td style="width: 50%; text-align: center;">
                    <p>Acknowladge</p>
                    <br>
                    <br>
                    <br>
                    <p>Adi Sutopo Suharyo</p>
                    <p style="font-style: italic;">(Direktur)</p>

                </td>
                <td style="width: 50%; text-align: center;">
                    <p>Responsible</p>
                    <br>
                    <br>
                    <br>
                    <p>{{ auth()->user()->name }}</p>
                    <p style="font-style: italic;">({{auth()->user()->position  }})</p>
                </td>
        </table>
    </div> --}}

    {{-- buat kolom  --}}
</body>
</html>
