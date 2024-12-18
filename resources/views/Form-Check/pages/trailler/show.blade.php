@extends('Form-Check.layout.main')
@section('title')
    Detail Form Trailer
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')

<div class="container">
    <div  class="header">
        <div class="text-end">
            <p style="">FM.MT.09.00</p>
        </div>
            <div class="row">
                <div class="col-md-2 lg-3">
    
                </div>
                <div class="col-md-8">
                    <h1 style="font-size: 24px;" class="fw fw-bold text-center">
                        TRAILER OPERATOR DAILY CHECKLIST
                    </h1>
                </div>
                <div class="col-md-2">
    
                </div>
            </div>
            
        <div style="text-align: left" class="text-start">
            <h2 style="font-size: 18px;">HARI / TANGGAL: {{ $data->date }}</h2>
            <h2 style="font-size: 18px;">KAPASITAS / AREA CRANE: {{ $data->jenis_forklift }}</h2>
        </div>
    </div>
    <table class="table table-responsive table-striped">
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

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <!-- Left Section: Notes -->
            <div class="left w-50">
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
    
            <!-- Right Section: Table -->
            <div class="right w-50">
                <div class="tabelin">
                    <table class="table table-bordered">
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
    </div>
</div>


@endsection