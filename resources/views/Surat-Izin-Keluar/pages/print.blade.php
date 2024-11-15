<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Ijin Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
            margin: 0 0 10px 0;
            font-size: 14px;
        }
        .header {
            text-align: end;
            margin-bottom: 15px;
            font-size: 12px;
        }
        .content {
            margin-bottom: 15px;
            font-size: 12px;
        }
        .label {
            display: inline-block;
            width: 120px;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .line {
            display: inline-block;
            border-bottom: 1px dotted #000;
            width: 70%;
            margin-left: 40px;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            font-size: 12px;
        }
        .signatures div {
            text-align: center;
            width: 30%;
        }
        .signatures img {
            max-width: 80px;
            margin-top: 10px;
        }
        .signatures p {
            margin-top: 10px;
        }

        /* Print specific styles */
        @media print {
            @page {
                size: 16.6cm 10.5cm;
                margin: 0.5cm;
                orientation: landscape;
            }

            body {
                margin-left: 1cm;
                padding: 0;
                background-color: white;
                display: block;
            }

            .container {
                width: 100%;
                padding: 0;
                box-sizing: border-box;
            }

            h2 {
                font-size: 12px;
            }

            .header p {
                font-size: 10px;
                text-align: right;
            }
            

            .content {
                font-size: 10px;
                line-height: 1.4;
            }

            .label {
                font-size: 10px;
                width: 110px;
            }

            .line {
                width: 60%;
                margin-left: 20px;
            }

            .signatures p {
                font-size: 10px;
            }

            .signatures img {
                max-width: 60px;
            }

            /* Adjust layout for better fit */
            .signatures {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
            }

            .signatures div {
                width: 30%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>{{$data->date}}</p>
        </div>
        <h2>Surat Ijin Keluar</h2>
        <p class="nomor"><center style="font-size: 10px">Nomor: {{$data->kode_sik}}</center></p>

        <div class="content">
            Dengan ini diijinkan keluar pabrik pada pukul: {{$data->diizinkan}}<br><br>
            <span class="label">Nama / Bagian</span>: <span class="line"> {{$data->bagian}}</span><br>
            <span class="label">Keperluan</span>: <span class="line"> {{$data->keperluan}}</span><br>
            <span class="label">Kendaraan No.</span>: <span class="line"> {{$data->no_kendaraan}}</span><br>
            <span class="label">Pengemudi</span>: <span class="line"> {{$data->pengemudi}}</span><br>
            <span class="label">Muatan</span>: <span class="line"> {{$data->muatan}}</span><br>
        </div>

        <div class="signatures">
            <div>
                <p>Pemberi Ijin,<br>
                    <img src="{{asset($data->pemberi_izin_ttd)}}" alt=""/>
                </p>
                <p>( {{$data->pemberi_izin}} )</p>
            </div>
            <div>
                <p>Pengemudi,<br>
                    <img src="{{asset($data->pengemudi_ttd)}}" alt=""/>
                </p>
                <p>( {{$data->pengemudi}} )</p>
            </div>
            <div>
                <p>Security,<br>
                    <img src="{{asset($data->satpam_ttd)}}" alt=""/>
                </p>
                <p>( {{$data->satpam}} )</p>
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
