@extends('Form-Check.layout.main')

@section('title')
    Detail Submission EUP
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-eye"></i>
                </span> Detail Submission EUP
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Submission Details</h4>
                    <p class="card-description">Berikut adalah detail dari pengisian formulir EUP.</p>

                    <div class="mb-4">
                        <h5><b>Checker Pallet:</b></h5>
                        @php
                            $name = \App\Models\User::where('id',$submission->user_id)->value('name');
                        @endphp
                        <p>{{ $name }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Tanggal Pengecekan Pallet:</b></h5>
                        <p>{{ $submission->date }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Jenis Pengecekan:</b></h5>
                        <p>{{ $submission->jenis }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Kondisi Kaki Pallet:</b></h5>
                        <ul>
                            @php
                                // Assuming $submission->kaki_pallet contains the string
                                $kakiPalletString = $submission->kaki_pallet;

                                // Remove double quotes and split the string by '|'
                                $kakiPalletArray = explode('|', str_replace('"', '', $kakiPalletString));
                                // dd($kakiPalletArray);
                            @endphp
                                @foreach($kakiPalletArray as $kaki)

                                <ul>
                                    <li>{{ $kaki }}</li>
                                </ul>
                                @endforeach


                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5><b>Kondisi Papan Permukaan Pallet:</b></h5>
                        <p>{{ $submission->permukaan_pallet ? 'Ya' : 'Tidak' }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Kondisi Ketebalan Papan Pallet:</b></h5>
                        <p>{{ $submission->ketebalan_pallet ? 'Ya' : 'Tidak' }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Kondisi Paku pada Pallet:</b></h5>
                        <p>{{ $submission->paku_pallet ? 'Paku tidak Keluar' : 'Paku Keluar' }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Kondisi Pallet Sesuai Standar Warehouse TML:</b></h5>
                        <p>{{ $submission->sesuai }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Proses yang dilakukan:</b></h5>
                        <p>{{ $submission->action }}</p>
                    </div>
                    <div class="mb-4">
                        <h5><b>Bukti Foto:</b></h5>
                        <div class="row">
                            @php
                                $fotopath = $submission->foto7;

                                // Remove double quotes and split the string by '|'
                                $path = explode('|', str_replace('"', '', $fotopath));
                            @endphp         
                            @foreach($path as $p)
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/eup/' . $p) }}" class="img-fluid" alt="Bukti Foto">
                                </div>
                                @php
                                    // dd($path);
                                @endphp
                            @endforeach
                        </div>
                    </div>
                    @if (Auth::user()->role == 0)
                    <a href="{{ route('Form-Check.admin.eup') }}" class="btn btn-light">Back to List</a>
                    @else
                    <a href="{{ route('Form-Check.pegawai.eup') }}" class="btn btn-light">Back to List</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
