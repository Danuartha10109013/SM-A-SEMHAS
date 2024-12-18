@extends('Form-Check.layout.main')
@section('title')
    Detail Crane
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
            <p style="">FM.MT.10.01</p>
        </div>
            <div class="row">
                <div class="col-md-2 lg-3">

                </div>
                <div class="col-md-8">
                    <h1 style="font-size: 24px;" class="fw fw-bold text-center">
                        CRANE OPERATOR DAILY CHECKLIST
                    </h1>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            
        <div style="text-align: left" class="text-start">
            <h2 style="font-size: 18px;">HARI / TANGGAL: {{ $data->date }}</h2>
            <h2 style="font-size: 18px;">KAPASITAS / AREA CRANE: {{ $data->jenis_crane }}</h2>
        </div>
    </div>

    <table class="table table-responsive table-striped">
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

    <div class="container mt-4">
        <div class="row">
            <!-- Left Section: Notes -->
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="tabelin">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><b>OPERATOR</b></th>
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
                                <th><b>TEAM LEADER</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="margin-top: 8px;margin-bottom: 8px">
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