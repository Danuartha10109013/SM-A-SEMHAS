@extends('Form-Check.layout.main')
@section('title')
   Detail Form Forklift
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
                        FORKLIFT OPERATOR DAILY CHECKLIST
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