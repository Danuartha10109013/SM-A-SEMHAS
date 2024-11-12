<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Ijin Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 50%;
            max-width: 700px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
            margin: 0 0 10px 0;
        }
        .header {
            text-align: end;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .label {
            display: inline-block;
            width: 120px;
            margin-bottom: 15px
        }
        .line {
            display: inline-block;
            border-bottom: 1px dotted #000;
            width: 70%;
            margin-left: 40px;
        }
        .signatures {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .signatures div {
            text-align: center;
            width: 30%;
        }
        .signatures img {
            max-width: 100px;
            margin-top: 10px;
        }
        .signatures p {
            margin-top: 10px;
        }

        /* Print specific styles */
        @media print {
            @page {
                size: 16.6cm 10.5cm;
                margin: 1cm;
                orientation: landscape;
            }

            body {
                margin: 0;
                display: block;
                background-color: white;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                box-shadow: none;
            }

            h2 {
                font-size: 16px;
            }

            .header p {
                font-size: 14px;
                text-align: right;
            }

            .content {
                font-size: 14px;
            }

            .signatures p {
                font-size: 14px;
            }

            .signatures img {
                max-width: 80px;
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
        <p><center>Nomor: {{$data->kode_sik}}</center></p>

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
                    <img src="{{asset($data->pemberi_izin_ttd)}}" alt="">
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
                    <img src="{{asset($data->satpam_ttd)}}" alt="">
                </p>
                <p>( {{$data->satpam}} )</p>
            </div>
        </div>
    </div>
</body>
</html>
