<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forklift Operator Daily Checklist - Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 10px;
        }

        .header h1 {
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .notes, .tabelin {
            font-size: 10px;
        }

        .signature table {
            width: 100%;
            margin-top: 5px;
            border: none;
        }

        .signature table td {
            border: none;
            padding: 5px;
        }

        .text-center {
            text-align: left;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .left {
            width: 60%;
        }

        .right {
            width: 40%;
        }

        .notes {
            margin: 0;
        }

        .tabelin table {
            width: 100%;
            table-layout: fixed;
        }

        .tabelin td {
            height: 30px;
        }

        .catatan-row td {
            height: 50px;
            vertical-align: top;
        }

        .header {
            margin-top: -100px;margin-bottom: 40px;
        }
        .header h1{
            text-align: center
        }
        .header h2{
            margin-left: 150px; 
            font-size: 11px

        }
        .logo {
            margin-bottom: 20px;
        }

        .end {
            text-align: end;
            margin-top: -90px; 
            margin-bottom: 80px;
        }

        @media print {
            title {
                display: none;
            }

            .header {
                margin-top: -70px;
                margin-bottom: 10px;
            }

            .logo {
                margin-bottom: 0px;
                margin-top: 20px;
            }

            body {
                margin: 5px;
                font-size: 12px;
            }

            table, th, td {
                padding: 2px;
            }

            .header h1 {
                text-align: center;
                font-size: 14px;
            }

            .header h2 {
                margin-left: 100px; 
                font-size: 10px;
            }

            .notes, .tabelin {
                font-size: 10px;
            }

            .container {
                display: flex;
                justify-content: space-between;
            }

            .left, .right {
                display: block;
                width: 100%;
            }

            .download-button {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="logo">
        <img width="10%" src="{{asset('Logo_TML.png')}}" alt="Logo">
    </div>
    <div class="header">
        <h1>FORKLIFT OPERATOR DAILY CHECKLIST</h1>
        <div class="text-start">
            <h2>HARI / TANGGAL: {{ $data->date }}</h2>
            <h2>JENIS FORKLIFT: {{ $data->jenis_forklift }}</h2>
        </div>
    </div>
    <div class="end">
        <p>FM.MT.09.00</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>ITEM</th>
                <th>STANDART</th>
                <th>SHIFT 1</th>
                <th>SHIFT 2</th>
                <th>SHIFT 3</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['awal', 'Pengecekan Hour Meter Awal Shift', 'Level harus di atas L'],
                    ['akhir', 'Pengecekan Hour Meter Akhir Shift', 'Level harus di atas L'],
                    ['horn', 'Horn', 'Berfungsi normal'],
                    ['mundur', 'Alarm Mundur', 'Berfungsi normal'],
                    ['sein', 'Lampu Sein', 'Menyala'],
                    ['rotating', 'Lampu Rotating', 'Ada dan menyala'],
                    ['stop', 'Lampu Stop', 'Menyala kanan dan kiri'],
                    ['utama', 'Lampu Utama', 'Menyala kanan dan kiri'],
                    ['connector', 'Battery Connector', 'Connector harus kencang'],
                    ['accu', 'Level Air Accu (H/L)', 'Level harus di atas L'],
                    ['parking', 'Brake Parking', 'Berfungsi normal'],
                    ['brake', 'Brake', 'Berfungsi normal'],
                    ['oil', 'Engine Oil Level (H/L)', 'Level harus di atas L'],
                    ['raulic', 'Hydraulic Oil Level (H/L)', 'Level harus di atas L'],
                    ['chain', 'Kondisi Grease di Chain', 'Terlumasi grease'],
                    ['allhose', 'Kebocoran Oli (All Hose)', 'Tidak ada kebocoran'],
                    ['steering', 'Power Steering', 'Berfungsi normal'],
                    ['belts', 'Kondisi Belts Engine', 'Visual tidak ada yang retak/putus'],
                    ['cooland', 'Level Cooland (H/L)', 'Level harus di atas L'],
                    ['transmisi', 'Level Oil Transmisi (H/L)', 'Level harus di atas L'],
                    ['ban', 'Kondisi Ban', 'Masih terdapat kembangan dan tidak retak'],
                    ['fork', 'Hydraulic Fork', 'Berfungsi normal'],
                    ['teba', 'Tekanan Ban (Forklift 23 ton)', '900 Kpa (kgf/cm2)']
                ];

            @endphp
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="text-align: left">{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    @if ($data->shift == 1)
                        <td>{{ $data->{$item[0]} }}</td>
                        <td></td>
                        <td></td>
                    @elseif ($data->shift == 2)
                        <td></td>
                        <td>{{ $data->{$item[0]} }}</td>
                        <td></td>
                    @elseif ($data->shift == 3)
                        <td></td>
                        <td></td>
                        <td>{{ $data->{$item[0]} }}</td>
                    @endif
                    <td>{{ $data->{"ket_{$item[0]}"} }}</td>
                </tr>
            @endforeach
            <tr class="catatan-row">
                <td colspan="5" style="border-style: none">
                    <p style="text-align: left"><span style="margin-right: 10px">Catatan:</span> {{ $data->catatan }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="container">
        <div class="left">
            <div class="notes">
                <p><strong>KET:</strong></p>
                <ul>
                    <li>V : KONDISI BAIK</li>
                    <li>X : KONDISI TIDAK BAIK DAN CRANE TIDAK BISA DIGUNAKAN</li>
                    <li>O : KONDISI TIDAK BAIK NAMUN MASIH BISA DIGUNAKAN</li>
                </ul>
                <p><strong>NOTE:</strong> JIKA KETERANGAN (X, O) INFORMASI KE MAINTENANCE</p>
                <p>PENGECEKAN DILAKUKAN AWAL SHIFT/SEBELUM DIGUNAKAN</p>
            </div>
        </div>

        <div class="right">
            <div class="tabelin">
                <table>
                    <thead>
                        <tr>
                            <td><b>OPERATOR</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @php
                                    $nama = \App\Models\User::where('id', $data->user_id)->value('name');
                                @endphp
                                {{ $nama }}
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <td><b>TEAM LEADER</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->shift_leader }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
