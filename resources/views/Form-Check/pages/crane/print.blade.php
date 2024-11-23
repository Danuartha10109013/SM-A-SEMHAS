<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crane Operator Daily checklist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 10px;
        }

        .header {
            margin-top: -100px;
            margin-bottom: 40px;
        }
        .header h1 {
            text-align: center;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .header h2 {
            margin-left: 150px; 
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

        /* Custom CSS layout to mimic Bootstrap's grid */
        .container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .left  {
            width: 60%; /* Left section for notes */
        }
        .right{
            width: 40%; /* Right section for operator and team leader */
        }

        .notes {
            margin: 0;
        }

        .tabelin table {
            width: 100%;
            table-layout: fixed;
        }

        .tabelin td {
            height: 30px; /* Set a consistent height */
        }

        .catatan-row td {
            height: 50px; /* Adjust height as necessary */
            vertical-align: top; /* Align text to the top */
        }

        
        .logo {
            margin-bottom: 20px
        }
        .end {
            text-align: end;margin-top: -90px; margin-bottom: 80px
        }

        @media print {
            title{
                display: none;
            }
            .header{
            /* margin-left: 100px;  */
            text-align: center;
            margin-top: -70px;
            margin-bottom: 10px;
            }
            .logo {
            margin-bottom: 0px;
            margin-top: 20px
                
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

            /* Ensure the container layout stays intact when printed */
            .container {
                display: flex;
                justify-content: space-between;
            }

            .left, .right {
                display: block;
                width: 100%; /* Full width for print */
            }
            .download-button {
                display: none; /* Hide the button when printing */
            }
        }
    </style>
</head>
<body>

    <div class="logo">
        <style>
            #zoomable-image {
                transition: transform 0.3s ease; /* Smooth zoom transition */
                cursor: pointer; /* Shows pointer cursor on hover */
                width: 10%;
            }
        </style>
    <div class="container mt-5">
            <img id="zoomable-image" src="{{ asset('Logo_TML.png') }}" alt="Logo">
        </div>
    
        <script>
            const img = document.getElementById('zoomable-image');
    
            img.addEventListener('wheel', function (e) {
                e.preventDefault(); // Prevent page scroll
    
                const scaleFactor = 0.1; // Scale increment/decrement factor
                let currentScale = 1;
    
                if (e.deltaY < 0) { // Zoom in (scroll up)
                    currentScale += scaleFactor;
                } else { // Zoom out (scroll down)
                    currentScale -= scaleFactor;
                }
    
                // Set a minimum and maximum scale to prevent image from becoming too small or too large
                currentScale = Math.min(Math.max(0.5, currentScale), 2);
    
                img.style.transform = `scale(${currentScale})`;
            });
        </script>
    </div>
    <div style="" class="header">
        <h1>
            CRANE OPERATOR DAILY CHECKLIST
        </h1>
        <div style="text-align: left" class="text-start">
            <h2>HARI / TANGGAL: {{ $data->date }}</h2>
            <h2>KAPASITAS / AREA CRANE: {{ $data->jenis_crane }}</h2>
        </div>
    </div>
    <div class="end">
        <p style="">FM.MT.10.01</p>
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
                    ['start', 'Pengecekan Tombol Start', 'Berfungsi Normal'],
                    ['switch', 'Pengecekan Tombol Switch On-Off', 'Berfungsi Normal'],
                    ['up', 'Pengecekan Tombol Up', 'Berfungsi Normal'],
                    ['down', 'Pengecekan Tombol Down', 'Berfungsi Normal'],
                    ['ctravel', 'Pengecekan Tombol Cross Travel', 'Berfungsi Normal'],
                    ['ltravel', 'Pengecekan Tombol Long Travel', 'Berfungsi Normal'],
                    ['emergency', 'Pengecekan Tombol Emergency', 'Berfungsi Normal'],
                    ['speed1', 'Pengecekan Tombol Speed 1', 'Berfungsi Normal'],
                    ['speed2', 'Pengecekan Tombol Speed 2', 'Berfungsi Normal'],
                    ['block', 'Pengecekan Pully Bottom Block','Tidak Cacat'],
                    ['lockert', 'Pengecekan Lifting Hook Locker', 'Berfungsi Normal'],
                    ['wire', 'Pengecekan Wire Rope','Tidak Rantas'],
                    ['sltravel', 'Pengecekan Lampu Sirine Long Travel','Menyala'],
                    ['sirinelt', 'Sirine Long Travel','Bunyi'],
                    ['brakeno', 'Brake Long Travel Saat Tidak Membawa Beban', 'Berfungsi Normal'],
                    ['brakeya', 'Brake Long Travel Saat Membawa Beban', 'Berfungsi Normal'],
                    ['bcno', 'Brake Cross Travel Saat Tidak Membawa Beban', 'Berfungsi Normal'],
                    ['bcya', 'Brake Cross Travel Saat Membawa Beban', 'Berfungsi Normal'],
                    ['updno', 'Brake Up-Down saat Tidak Membawa Beban', 'Berfungsi Normal'],
                    ['updya', 'Brake Up-Down saat Membawa Beban', 'Berfungsi Normal'],
                    ['crcros', 'Cable/roda Roller untuk Cross Travel','Sesuai Jalur / Tidak ada yang lepas']
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
                    <p style="text-align: left"><span style="margin-right: 10px">Catatan:  </span>   {{$data->catatan}}</p>
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
                                {{$nama}}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <td><b>TEAM LEADER</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="margin-top: 8px;margin-bottom: 8px">
                            <td>{{$data->shift_leader}}</td>
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
