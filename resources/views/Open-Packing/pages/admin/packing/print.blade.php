<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Packing Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid black;
            padding: 10px;
        }
        .header img {
            height: 70px;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header-left div {
            margin-left: 10px;
        }
        .header-title {
            text-align: center;
            flex-grow: 2;
        }
        .header-title h2 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header-title p {
            margin: 0;
            font-size: 10px;
        }
        .header-right {
            text-align: right;
            font-size: 10px;
        }
        .shift-info {
            font-size: 12px;
            text-align: right;
            margin-top: -10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .print-button {
            margin-top: 20px;
            text-align: center;
        }
        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        @media print {
    .print-button {
        display: none; /* Hide the print button during printing */
    }
}
        
    </style>
    <script>
        function printDocument() {
            window.print();
        }
    </script>
</head>
<body>

<div class="header">
    <div class="header-left">
        <img src="{{ asset('Logo_TML.png') }}" alt="Company Logo">
        <div>
        </div>
    </div>
    <div class="header-title">
        <h2>PERINTAH OPEN-PACKING</h2>
    </div>
    <div class="header-right">
        <p><strong>FM.WH.03.03</strong></p>
        <p>CRC</p>
        {{-- @if ($jenis == 'CRC')
        <p>CRC / <del>Resin</del> / <del>Alkali</del> <del>Zinc Ingot</del> <del>Alumunium</del> </p>
        @elseif ($jenis == 'RESIN')
        <p><del>CRC</del> / Resin / <del>Alkali</del> <del>Zinc Ingot</del> <del>Alumunium</del> </p>
        @elseif ($jenis == 'ALKALI')
        <p><del>CRC</del> / <del>Resin</del> / Alkali <del>Zinc Ingot</del> <del>Alumunium</del> </p>
        @elseif ($jenis == 'ZINC')
        <p><del>CRC</del> / <del>Resin</del> / <del>Alkali</del> Zinc Ingot <del>Alumunium</del> </p>
        @elseif ($jenis == 'ALUMUNIUM')
        <p><del>CRC</del> / <del>Resin</del> / <del>Alkali</del> / <del>Zinc Ingot</del> / Alumunium </p>
        @endif --}}
        <p style="font-style: italic"><strong> SHIFT: {{$shift}} </strong></p>
    </div>
</div>



<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Attribute / Batch</th>
            <th>Berat Label</th>
            <th>Berat Aktual</th>
            <th>Selisih</th>
            <th>Persentase</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->attribute}}</td>
                <td>{{$d->b_label}}</td>
                <td>{{$d->b_aktual}}</td>
                <td>{{$d->selisih}}</td>
                @if ($d->persentase >= 0)
                    <td style="color: green">{{$d->persentase}} %</td>
                @elseif ($d->persentase <= -0.25)
                    <td style="color: red">{{$d->persentase}} %</td>
                @else
                    <td style="color: green">{{$d->persentase}} %</td>
                @endif
                <td>{{$d->keterangan}}</td>

            </tr>
        @endforeach
    </tbody>
</table>
<div style="position: space between">
    
    <P style="text-align: left"> Shfit Leader : {{$leader}}</P>
    <p style="text-align: right">Tanggal: {{$date->format('d/m/Y')}}</p>
</div>


<div class="print-button">
    <button onclick="printDocument()">Print</button>
</div>

</body>
</html>
