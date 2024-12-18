<!DOCTYPE html>
<html>
<head>
    <title>{{$id}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
        @media print {
            @page {
                size: legal; /* Tetapkan ukuran kertas ke legal */
                margin: 5mm; /* Margin kertas */
            }

            /* Memastikan ukuran halaman tidak berubah dan konten mengecil jika meluap */
            body {
                margin: 0;
                padding: 0;
                width: 100%; /* Pastikan konten menggunakan lebar penuh */
                height: 100%; /* Pastikan konten menggunakan tinggi penuh */
                overflow: hidden;
                transform-origin: top center; /* Tentukan titik asal transformasi */
                transform: scale(1); /* Sesuaikan ini untuk memperkecil ukuran konten */
            }

            /* Untuk memperkecil konten berdasarkan ukuran halaman */
            .content {
                width: 100%; /* Pastikan konten memenuhi lebar kertas */
                height: auto; /* Konten akan menyesuaikan tinggi */
                transform: scale(1); /* Sesuaikan dengan persentase pengurangan jika melebihi halaman */
                transform-origin: top center; /* Memastikan titik transformasi diatur dengan benar */
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            color: #000000;
        }
        .container {
            max-width: 1100px;
            max-height: auto;
            /* margin: auto; */
        }
        .header h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .row {
            display: flex;
            justify-content: space-between;
        }
        .section {
            margin-bottom: 20px;
        }
        table {
            width: 90%;
            height: 30%;
            border-collapse: collapse;
            margin-bottom: 9px;
        }
        table th, table td {
            border: 1px solid #000000;
            padding: 2px;
            text-align: left;
            font-size: 0.5em
        }
        table th {
            background-color: #f2f2f2;
        }
        .note {
            font-size: 7px;
            color: #555;
            margin-top: 20px;
        }
        .text-center {
            text-align: center;
        }
        .no-print {
            display: block;
        }
        td {
            text-transform: uppercase;
        }

            
        
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body id="printable-area">
    <div class="container">
        
        @foreach ($data as $d)
        <style>
            .header {
                display: flex;
                align-items: center; /* Menyelaraskan item di tengah secara vertikal */
                justify-content: center; /* Menyelaraskan item di tengah secara horizontal */
                text-align: center; /* Menyelaraskan teks di tengah */
            }
        
            .header img {
                margin-right: 15px; /* Jarak antara gambar dan teks */
            }
        
            .header h3, .header p {
                margin: 0; 
            }
        </style>
        
        <div class="header">
            <img style="width: 10%" src="{{asset('img/Logo_TML.png')}}" alt="Logo">
            <div><center>

                <h3 style="font-size: 20px;margin-left: 80px"><strong>MAPPING MUAT & CEKLIST KONTAINER & TRAILLER</strong></h3>
            </center>
            </div>
            <p style="margin-top: -70px;margin-left: 90px">FM.WH.09.04</p>
        </div>
        
        
        <hr>
        
        

        
        <div class="row">
            <div style="flex: 1; margin-right: 10px;">
                <div class="section">
                    <table>
                        
                        <tr>
                            <th>Awal Muat</th>
                            <td>{{$d->awal_muat}} - {{$d->awal_muat1}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{$d->tgl_gs}}</td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td>{{$d->customer}}</td>
                        </tr>
                        <tr>
                            <th>Kota/Negara</th>
                            <td>{{$d->kota_negara}}</td>
                        </tr>
                        <tr>
                            <th>Ekspedisi</th>
                            <td>{{$d->ekspedisi}}</td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <p><strong>KONTAINER / TRAILER / TRUK</strong></p>
                    <table>
                        <tr>
                            <th>Lantai</th>
                            <td>{{$d->lantai}}</td>
                        </tr>
                        <tr>
                            <th>Dinding</th>
                            <td>{{$d->dinding}}</td>
                        </tr>
                        <tr>
                            <th>Pengunci Kontainer</th>
                            <td>{{$d->pengunci_kontainer}}</td>
                        </tr>
                        <tr>
                            <th>Disapu</th>
                            <td>{{$d->sapu}}</td>
                        </tr>
                        <tr>
                            <th>Vacum</th>
                            <td>{{$d->vacum}}</td>
                        </tr>
                        <tr>
                            <th>Disemprot</th>
                            <td>{{$d->disemprot}}</td>
                        </tr>
                        <tr>
                            <th>Choke</th>
                            <td>{{$d->choke}}</td>
                        </tr>
                        <tr>
                            <th>Stopper / Balok</th>
                            <td>{{$d->stopper}}</td>
                        </tr>
                        <tr>
                            <th>Sling</th>
                            <td>{{$d->sling}}</td>
                        </tr>
                        <tr>
                            <th>Silica Gel</th>
                            <td>{{$d->silica_gel}}</td>
                        </tr>
                        <tr>
                            <th>Fumigasi</th>
                            <td>{{$d->fumigasi}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style="flex: 1; margin-left: 10px;">
                <div class="section">
                    
                    <table>
                        <tr>
                            <th>Selesai muat</th>
                            <td>{{$d->selesai_muat}}</td>
                        </tr>
                        <tr>
                            <th>No. Mobil</th>
                            <td>{{$d->no_mobil}}</td>
                        </tr>
                        <tr>
                            <th>No. Kontainer</th>
                            <td>{{$d->no_container}}</td>
                        </tr>
                        <tr>
                            <th>Cuaca</th>
                            <td>{{$d->cuaca}}</td>
                        </tr>
                        <tr>
                            <th>Tonase / Tare</th>
                            <td>{{$d->tonase_tare}}</td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <p><strong>TRAILER / TRUK</strong></p>
                    <table>
                        <tr>
                            <th>Kondisi Ban</th>
                            <td>{{$d->kondisi_ban}}</td>
                        </tr>
                        <tr>
                            <th>Kondisi Lantai</th>
                            <td>{{$d->kondisi_lantai}}</td>
                        </tr>
                        <tr>
                            <th>Rantai / Webbing</th>
                            <td>{{$d->rantai_webbing}}</td>
                        </tr>
                        <tr>
                            <th>Tonase</th>
                            <td>{{$d->tonase}}</td>
                        </tr>
                        <tr>
                            <th>Terpal</th>
                            <td>{{$d->terpal}}</td>
                        </tr>
                        <tr>
                            <th colspan="2"><center>{{$d->no_gs}}</center></th>
                        </tr>
                    </table>
                </div>


                

                <div class="section">
                    <table>
                        <tr>
                            <th>Catatan <small style="color: red">*</small></th>
                        </tr>
                        <tr>
                            <td>{{$d->catatan}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
        {{-- <hr> --}}
        <div class="row cc">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="text-center mb-0" style="border: 1px solid #000000; max-width:90%" class="kotak">
                    <p class="mt-3"><b >KONTAINER</b></p>
                </div>
                <style>
                     .mapping {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .mapping td {
            border: 1px solid #000000;
            padding: none;
            text-align: center;
        }
        .mapping tr {
            height: 4rem; /* Aturan khusus untuk tabel kedua */

        }
        @media print {
    .no-print {
        display: none;
    }
    .cc, .mapping {
        /* display: none;  */
        margin-left: 30px
    }
    .mapping{
        /* display: none */
        margin-left: -0.07em;
    }

}

                </style>
                {{-- <p class="text-center">DEPAN</p> --}}
                <table class="mapping kiri mb-5">
                    @foreach ($coil as $c)
                        
                    
                    <tr>
                        <td width="100px">
                            @if($c->a1)
                               <p class="mt-1"><b> {{ $c->a1 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->a1_eye.'.png')}}" alt="{{$c->a1_eye}}">
                            @else
                            {{ $c->a1 }}
                            @endif
                        </td>
                        
                        <td width="100px">
                            @if($c->b1)
                               <p class="mt-2"><b> {{ $c->b1 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->b1_eye.'.png')}}" alt="{{$c->b1_eye}}">
                            @else
                            {{ $c->b1 }}
                            @endif
                        </td>

                        <td width="100px">
                            @if($c->c1)
                               <p class="mt-2"><b> {{ $c->c1 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->c1_eye.'.png')}}" alt="{{$c->c1_eye}}">
                            @else
                            {{ $c->c1 }}
                            @endif
                        </td>
                       
                    </tr>

                    <tr>
                        <td>
                            @if($c->a2)
                               <p class="mt-2"><b> {{ $c->a2 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->a2_eye.'.png')}}" alt="{{$c->a2_eye}}">
                            @else
                            {{ $c->a2 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b2)
                               <p class="mt-2"><b> {{ $c->b2 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->b2_eye.'.png')}}" alt="{{$c->b2_eye}}">
                            @else
                            {{ $c->b2 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c2)
                               <p class="mt-2"><b> {{ $c->c2 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->c2_eye.'.png')}}" alt="{{$c->c2_eye}}">
                            @else
                            {{ $c->c2 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a3)
                               <p class="mt-2"><b> {{ $c->a3 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->a3_eye.'.png')}}" alt="{{$c->a3_eye}}">
                            @else
                            {{ $c->a3 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b3)
                               <p class="mt-2"><b> {{ $c->b3 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->b3_eye.'.png')}}" alt="{{$c->b3_eye}}">
                            @else
                            {{ $c->b3 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c3)
                               <p class="mt-2"><b> {{ $c->c3 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->c3_eye.'.png')}}" alt="{{$c->c3_eye}}">
                            @else
                            {{ $c->c3 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a4)
                               <p class="mt-2"><b> {{ $c->a4 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->a4_eye.'.png')}}" alt="{{$c->a4_eye}}">
                            @else
                            {{ $c->a4 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b4)
                               <p class="mt-2"><b> {{ $c->b4 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->b4_eye.'.png')}}" alt="{{$c->b4_eye}}">
                            @else
                            {{ $c->b4 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c4)
                               <p class="mt-2"><b> {{ $c->c4 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->c4_eye.'.png')}}" alt="{{$c->c4_eye}}">
                            @else
                            {{ $c->c4 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a5)
                               <p class="mt-2"><b> {{ $c->a5 }} </b></p>
                              
                               <img width="40%" src="{{asset('img/'.$c->a5_eye.'.png')}}" alt="{{$c->a5_eye}}">
                            @else
                            {{ $c->a5 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b5)
                               <p class="mt-2"><b> {{ $c->b5 }} </b></p>
                               
                               <img width="40%" src="{{asset('img/'.$c->b5_eye.'.png')}}" alt="{{$c->b5_eye}}">
                            @else
                            {{ $c->b5 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c5)
                               <p class="mt-2"><b> {{ $c->c5 }} </b></p>
                              
                               <img width="40%" src="{{asset('img/'.$c->c5_eye.'.png')}}" alt="{{$c->c5_eye}}">
                            @else
                            {{ $c->c5 }}
                            @endif
                        </td>
                        
                    </tr>
                    
                    
                    @endforeach
                </table>
            <p class="text-start" style="font-size: 9px;margin-top: -20px"><small style="color: red">*</small>Mapping ini mereferensikan layout koil saat berada di dalam kontainer dari <b>Tampak Atas</b></p>
            <div class="tablebaru" style="width: 90%; text-align: center;">
                <table style="width: 100%; border-collapse: collapse; margin: 0 auto; outline: none;">
                    <tbody>
                        <tr>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle;">Team Leader</td>
                            <td style="border: none; padding: 10px; text-align: center;"></td>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle;">Opr Forklift</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle; display: flex; justify-content: center; align-items: center;">
                                <img width="50%" src="{{asset($sign->signature)}}" alt="" style="max-width: 100%; height: auto;margin-left: 5em">
                            </td>
                            <td style="border: none; padding: 10px; text-align: center;"></td>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle; display: flex; justify-content: center; align-items: center;">
                                <img width="50%" src="{{asset($sign->signature1)}}" alt="" style="max-width: 100%; height: auto;margin-left: 5em">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle;">
                                {{$sign->pegawai}}
                            </td>
                            <td style="border: none; padding: 10px; text-align: center;"></td>
                            <td style="border: none; padding: 10px; text-align: center; vertical-align: middle;">
                                {{$sign->checker}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
            </div>

            
            
            <div class="col-md-3"></div>
            <button class="no-print btn btn-success mb-2" id="copyBtn">Copy No GS</button>
            <button class="no-print btn btn-primary" id="printBtn">Print</button>

            <script>
                // Function to copy $id to clipboard
                document.getElementById('copyBtn').onclick = function() {
                    var id = "{{ $id }}"; // Assuming you are passing $id from your Laravel controller to the view
                    var textarea = document.createElement('textarea');
                    textarea.value = id;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    alert('ID copied to clipboard!');
                };

                // Function to trigger the print window
                document.getElementById('printBtn').onclick = function() {
                    window.print();
                };
            </script>
                        
        </div>
        
    </div>
</body>
</html>
