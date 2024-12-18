<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer Operator Daily Data - Print</title>
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
            margin-left: 150px; margin-top: -100px;margin-bottom: 40px;
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
                margin-left: 100px; 
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
                font-size: 14px;
            }

            .header h2 {
                font-size: 12px;
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
    <div class="header">
        <h1>TRAILER OPERATOR DAILY DATA</h1>
        <div class="text-start">
            <h2>HARI / TANGGAL: {{ $data->date }}</h2>
            <h2>NO TRAILER/DRIVER: {{ $data->jenis_forklift }}</h2>
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
                <th>STATUS V/X/O</th>

                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['carrier', 'Pastikan kondisi Carrier Trailer bagus atau tidak', 'Bagian penghubung terlumasidan tidak ada yang menganjal'],
                    ['rantai', 'Hook pengait rantai', 'Kondisi weldingan bagus'],
                    ['ban', 'Kondisi Ban dalam keadaan baik', 'Ban tidak bocor,masih ada kembangan dan tidak retak'],
                    ['cadangan','Ban cadangan', 'Ada dan kondisi baik',],
                    ['sein', 'Lampu sein kanan dan kiri', 'Menyala jika di operasikan'],
                    ['rotating', 'Lampu Rotating', 'Menyala jika di operasikan'],
                    ['stop', 'Lampu Stop', 'Menyala jika di operasikan'],
                    ['utama', 'Lampu Utama', 'Menyala jika di operasikan'],
                    ['kota', 'Lampu Kota', 'Menyala jika di operasikan'],
                    ['connector', 'Battery Connector', 'Kencang'],
                    ['accu', 'Level Air Accu (H/L)', 'H'],
                    ['coolant', 'Level Cooland (H/L)', 'H'],
                    ['parking', 'Brake Parking', 'Berfungsi normal'],
                    ['brake', 'Brake', 'Berfungsi normal'],
                    ['horn', 'Horn', 'Berfungsi normal'],
                    ['mundur', 'Alarm mundur', 'Berfungsi normal'],
                    ['clamp', 'All U bolt clamp per', 'Kondisi baik tidak ada yang patah'],
                ];

                $items1 = [
                    ['terpal','Terpal','Ada dan tidak sobek'],
                    ['rantai_pe','Rante pengikat','Ada dan kondisi baik'],
                    ['ganjal','Ganjal ban','Ada dan kondisi baik'],
                    ['pallet','Ada dan kondisi baik','Palet/ganjalan coil + karet'],
                    ['apar','Apar','Ada dan belum expired'],
                    ['p3k','Kotak P3K','Ada dan lengkap'],
                    ['fancing','Fancing/pembatas di atas Carrier','Ada dan kondisi baik'],
                    ['triangle','Red triangle','Ada dan kondisi baik'],
                    ['tools','Tools penggantian roda','Ada dan kondisi baik'],
                ]

            @endphp
            <tr>
                <td></td>
                <td><b>Equipment</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="text-align: left">{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    <td>{{ $data->{$item[0]} }}</td>    
                    <td>{{ $data->{"ket_{$item[0]}"} }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td><b>Aksesoris</b></td>
                <td></td>
                <td></td>
                <td></td>  
            </tr>
            @foreach ($items1 as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td style="text-align: left">{{ $item[1] }}</td>
                <td>{{ $item[2] }}</td>
                <td>{{ $data->{$item[0]} }}</td>    
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
