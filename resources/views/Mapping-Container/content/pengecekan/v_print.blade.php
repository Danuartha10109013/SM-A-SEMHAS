<!DOCTYPE html>
<html>
<head>
    <title>Mapping Muat & Ceklist Kontainer & Trailer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
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
        
            
        
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        @foreach ($data as $d)
        <div class="header text-center">
            <h3>Mapping Muat & Ceklist Kontainer & Trailer</h3>
            <p><b>No. GS{{$d->no_gs}}</b></p>
        </div>

        
        <div class="row">
            <div style="flex: 1; margin-right: 10px;">
                <div class="section">
                    
                    <table>
                        <tr>
                            <th>Awal Muat</th>
                            <td>{{$d->awal_muat}}</td>
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
                    </table>
                </div>

                <div class="section">
                    <table>
                        <tr>
                            <th>Type Stuffing</th>
                            <td>{{$d->stuffing}}</td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <table>
                        <tr>
                            <th>Catatan <small style="color: red">*</small></th>
                            <td>{{$d->catatan}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="row ">
            <div class="col-md-6">
                <div class="text-center mb-3" style="border: 1px solid #000000; max-width:90%" class="kotak">
                    <p class="mt-2"><b >KONTAINER</b></p>
                </div>
                <style>
                     .mapping {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
            /* .kiri{
                width: 0.5rem;
            } */
            /* .mapping1{
                display: flex
                width: 40%
            }
            .mapping{
                width: 40%
            }
            .mapping1, tr{
                height: 30px;
            } */
        }
                </style>
                {{-- <p class="text-center">DEPAN</p> --}}
                <table class="mapping kiri mb-5">
                    @foreach ($coil as $c)
                        
                    
                    <tr>
                        <td width="100px">
                            @if($c->a1)
                               <p class="mt-1"><b> {{ $c->a1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a1_eye.'.png')}}" alt="{{$c->a1_eye}}">
                            @else
                            {{ $c->a1 }}
                            @endif
                        </td>
                        
                        <td width="100px">
                            @if($c->b1)
                               <p class="mt-2"><b> {{ $c->b1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b1_eye.'.png')}}" alt="{{$c->b1_eye}}">
                            @else
                            {{ $c->b1 }}
                            @endif
                        </td>

                        <td width="100px">
                            @if($c->c1)
                               <p class="mt-2"><b> {{ $c->c1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c1_eye.'.png')}}" alt="{{$c->c1_eye}}">
                            @else
                            {{ $c->c1 }}
                            @endif
                        </td>
                       
                    </tr>

                    <tr>
                        <td>
                            @if($c->a2)
                               <p class="mt-2"><b> {{ $c->a2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a2_eye.'.png')}}" alt="{{$c->a2_eye}}">
                            @else
                            {{ $c->a2 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b2)
                               <p class="mt-2"><b> {{ $c->b2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b2_eye.'.png')}}" alt="{{$c->b2_eye}}">
                            @else
                            {{ $c->b2 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c2)
                               <p class="mt-2"><b> {{ $c->c2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c2_eye.'.png')}}" alt="{{$c->c2_eye}}">
                            @else
                            {{ $c->c2 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a3)
                               <p class="mt-2"><b> {{ $c->a3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a3_eye.'.png')}}" alt="{{$c->a3_eye}}">
                            @else
                            {{ $c->a3 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b3)
                               <p class="mt-2"><b> {{ $c->b3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b3_eye.'.png')}}" alt="{{$c->b3_eye}}">
                            @else
                            {{ $c->b3 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c3)
                               <p class="mt-2"><b> {{ $c->c3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c3_eye.'.png')}}" alt="{{$c->c3_eye}}">
                            @else
                            {{ $c->c3 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a4)
                               <p class="mt-2"><b> {{ $c->a4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a4_eye.'.png')}}" alt="{{$c->a4_eye}}">
                            @else
                            {{ $c->a4 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b4)
                               <p class="mt-2"><b> {{ $c->b4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b4_eye.'.png')}}" alt="{{$c->b4_eye}}">
                            @else
                            {{ $c->b4 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c4)
                               <p class="mt-2"><b> {{ $c->c4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c4_eye.'.png')}}" alt="{{$c->c4_eye}}">
                            @else
                            {{ $c->c4 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a5)
                               <p class="mt-2"><b> {{ $c->a5 }} </b></p>
                              
                               <img width="30%" src="{{asset('img/'.$c->a5_eye.'.png')}}" alt="{{$c->a5_eye}}">
                            @else
                            {{ $c->a5 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b5)
                               <p class="mt-2"><b> {{ $c->b5 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b5_eye.'.png')}}" alt="{{$c->b5_eye}}">
                            @else
                            {{ $c->b5 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c5)
                               <p class="mt-2"><b> {{ $c->c5 }} </b></p>
                              
                               <img width="30%" src="{{asset('img/'.$c->c5_eye.'.png')}}" alt="{{$c->c5_eye}}">
                            @else
                            {{ $c->c5 }}
                            @endif
                        </td>
                    </tr>
                    
                    @endforeach
                </table>
            
            </div>
            
            {{-- yang Kedua --}}
            <div class="col-md-6">
                <div class="text-center mb-3" style="border: 1px solid #000000; max-width:90%" class="kotak">
                    <p class="mt-2"><b >KONTAINER</b></p>
                </div>
                <style>
                     .mapping {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
            /* .kiri{
                width: 0.5rem;
            } */
            /* .mapping1{
                display: flex
                width: 40%
            }
            .mapping{
                width: 40%
            }
            .mapping1, tr{
                height: 30px;
            } */
        }
                </style>
                {{-- <p class="text-center">DEPAN</p> --}}
                <table class="mapping kiri mb-5">
                    @foreach ($coil as $c)
                        
                    
                    <tr>
                        <td width="100px">
                            @if($c->a1)
                               <p class="mt-1"><b> {{ $c->a1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a1_eye.'.png')}}" alt="{{$c->a1_eye}}">
                            @else
                            {{ $c->a1 }}
                            @endif
                        </td>
                        
                        <td width="100px">
                            @if($c->b1)
                               <p class="mt-2"><b> {{ $c->b1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b1_eye.'.png')}}" alt="{{$c->b1_eye}}">
                            @else
                            {{ $c->b1 }}
                            @endif
                        </td>

                        <td width="100px">
                            @if($c->c1)
                               <p class="mt-2"><b> {{ $c->c1 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c1_eye.'.png')}}" alt="{{$c->c1_eye}}">
                            @else
                            {{ $c->c1 }}
                            @endif
                        </td>
                       
                    </tr>

                    <tr>
                        <td>
                            @if($c->a2)
                               <p class="mt-2"><b> {{ $c->a2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a2_eye.'.png')}}" alt="{{$c->a2_eye}}">
                            @else
                            {{ $c->a2 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b2)
                               <p class="mt-2"><b> {{ $c->b2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b2_eye.'.png')}}" alt="{{$c->b2_eye}}">
                            @else
                            {{ $c->b2 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c2)
                               <p class="mt-2"><b> {{ $c->c2 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c2_eye.'.png')}}" alt="{{$c->c2_eye}}">
                            @else
                            {{ $c->c2 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a3)
                               <p class="mt-2"><b> {{ $c->a3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a3_eye.'.png')}}" alt="{{$c->a3_eye}}">
                            @else
                            {{ $c->a3 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b3)
                               <p class="mt-2"><b> {{ $c->b3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b3_eye.'.png')}}" alt="{{$c->b3_eye}}">
                            @else
                            {{ $c->b3 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c3)
                               <p class="mt-2"><b> {{ $c->c3 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c3_eye.'.png')}}" alt="{{$c->c3_eye}}">
                            @else
                            {{ $c->c3 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a4)
                               <p class="mt-2"><b> {{ $c->a4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->a4_eye.'.png')}}" alt="{{$c->a4_eye}}">
                            @else
                            {{ $c->a4 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b4)
                               <p class="mt-2"><b> {{ $c->b4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b4_eye.'.png')}}" alt="{{$c->b4_eye}}">
                            @else
                            {{ $c->b4 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c4)
                               <p class="mt-2"><b> {{ $c->c4 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->c4_eye.'.png')}}" alt="{{$c->c4_eye}}">
                            @else
                            {{ $c->c4 }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($c->a5)
                               <p class="mt-2"><b> {{ $c->a5 }} </b></p>
                              
                               <img width="30%" src="{{asset('img/'.$c->a5_eye.'.png')}}" alt="{{$c->a5_eye}}">
                            @else
                            {{ $c->a5 }}
                            @endif
                        </td>
                        
                        <td>
                            @if($c->b5)
                               <p class="mt-2"><b> {{ $c->b5 }} </b></p>
                               
                               <img width="30%" src="{{asset('img/'.$c->b5_eye.'.png')}}" alt="{{$c->b5_eye}}">
                            @else
                            {{ $c->b5 }}
                            @endif
                        </td>
                        <td>
                            @if($c->c5)
                               <p class="mt-2"><b> {{ $c->c5 }} </b></p>
                              
                               <img width="30%" src="{{asset('img/'.$c->c5_eye.'.png')}}" alt="{{$c->c5_eye}}">
                            @else
                            {{ $c->c5 }}
                            @endif
                        </td>
                    </tr>
                    
                   
                </table>
            
            </div>
            
        </div>
        
        </div>
        @endforeach
        

        <!-- Print Button -->
        
    </div>
</body>
</html>
