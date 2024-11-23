<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Checklist</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px; /* Adjust the width as needed */
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .no-urut {
            text-align: right;
        }
        .container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .img-preview {
            max-width: 100%;
            height: auto;
            border: 1px solid #000;
            margin: 5px;
        }
        .button-print {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        /* Print Styles */
        @media print {
           .button-print{
            display: none;
           }
            
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="logo">
            <style>
                #zoomable-image {
                    transition: transform 0.3s ease; /* Smooth zoom transition */
                    cursor: pointer; /* Shows pointer cursor on hover */
                    width: 30%;
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
        <div class="title">
            CHECKLIST KENDARAAN
        </div>
        <div class="no-urut">
            <p>FM.WH.07.03</p>
            NO. URUT: {{$data->no_urut}}<br>
            TGL: {{$data->tanggal}}<br>
            IN (JAM): {{$data->jam}} <br>
        </div>
    </div>

    <table class="table table-striped mt-4 mr-5">
        <!-- Section A: Data Ekspedisi -->
        <tr>
            <th></th>
            <th>DESKRIPSI</th>
            <th>ISI</th>
            <th>KET</th>
        </tr>
        <tr>
            <td><strong>A</strong></td>
            <td><strong>DATA EKSPEDISI:</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>NAMA EKSPEDISI</td>
            <td>{{$data->nama_ekspedisi}}</td>
            <td>{{$data->ket_nama_ekspedisi}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>NO MOBIL</td>
            <td>{{$data->no_mobil}} </td>
            <td>{{$data->ket_no_mobil}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>NO KONTAINER</td>
            <td>{{$data->no_kontainer}} </td>
            <td>{{$data->ket_no_kontainer}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>TUJUAN</td>
            <td>{{$data->tujuan}}</td>
            <td>{{$data->ket_tujuan}}</td>
        </tr>

        <!-- Section B: Data Driver -->
        <tr>
            <td><strong>B</strong></td>
            <td><strong>DATA DRIVER:</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>NAMA SOPIR/KENEK</td>
            <td>{{$data->nama_sopir}}  </td>
            <td>{{$data->ket_nama_sopir}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>HELM</td>
            <td>{{$data->helm}}</td>
            <td>{{$data->ket_helm}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>CELANA PANJANG</td>
            <td>{{$data->celana_panjang}}</td>
            <td>{{$data->ket_celana_panjang}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>BAJU LENGAN PANJANG</td>
            <td>{{$data->baju_lengan_panjang}}</td>
            <td>{{$data->ket_baju_lengan_panjang}}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>SEPATU</td>
            <td>{{$data->sepatu}}</td>
            <td>{{$data->ket_sepatu}}</td>
        </tr>

        <!-- Section C: Kelengkapan Dokumen Supir -->
        <tr>
            <td><strong>C</strong></td>
            <td><strong>KELENGKAPAN DOKUMEN SUPIR:</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>SIM / KTP</td>
            <td>{{$data->sim}}</td>
            <td>{{$data->ket_sim}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>MASA BERLAKU SIM / KTP</td>
            <td>{{$data->masa_berlaku_sim}}</td>
            <td>{{$data->ket_masa_berlaku_sim}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>STNK</td>
            <td>{{$data->stnk}}</td>
            <td>{{$data->ket_stnk}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>MASA BERLAKU STNK</td>
            <td>{{$data->masa_berlaku_stnk}}</td>
            <td>{{$data->keta_masa_berlaku_stnk}}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>KIR</td>
            <td>{{$data->kir}}</td>
            <td>{{$data->ket_kir}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>MASA BERLAKU KIR</td>
            <td>{{$data->masa_berlaku_kir}}</td>
            <td>{{$data->ket_masa_berlaku_kir}}</td>
        </tr>
        <tr>
            <td><strong>D</strong></td>
            <td><strong>KELENGKAPAN DOKUMEN PENGAMBILAN :</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>SURAT PENGANTAR EKSPEDISI / DO</td>
            <td>{{$data->surat_pengantar_ekspedisi}}</td>
            <td>{{$data->ket_surat_pengantar_ekspedisi}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>SEGEL</td>
            <td>{{$data->segel}}</td>
            <td>{{$data->ket_segel}}</td>
        </tr>
        
        <!-- Additional sections follow the same structure -->
    </table>
    <br>
    @php
        $name = \App\Models\User::where('id',$data->user_id)->value('name');
    @endphp
    RESPONDEN : {{$name}}

    <br>
    @if ($data->no_mobil_foto == null && $data->no_kontainer_foto == null)
    @else
    BUKTI FOTO 
    <div class="container">
        <div style="flex: 1; padding: 10px;">
            No Mobil
                <br>
            <img src="{{ asset('storage/' . $data->no_mobil_foto) }}" alt="No Mobil Foto" class="img-preview">
        </div>
        <div style="flex: 1; padding: 10px;">
            No Containerbr
            <br>
            <img src="{{ asset('storage/' . $data->no_kontainer_foto) }}" alt="No Kontainer Foto" class="img-preview">
        </div>
    </div>
    @endif

    <button class="button-print" onclick="window.print();">Print</button>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>