@extends('Form-Check.layout.main')
@section('title', 'Detail Submission Material CRC')
@section('content')

<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Detail Submission Material CRC
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
                    <h4 class="card-title">Detail Form Daily Checklist Kedatangan Material FM.WH.02.01</h4>
                    <p class="card-description">Detail dari submission material CRC yang telah diinput sebelumnya.</p>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>PENERIMA</label>
                            <input type="text" class="form-control" value="{{ $submission->user_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>NOMOR DOKUMEN</label>
                            <input type="text" class="form-control" value="{{ $submission->shift_leader }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>TANGGAL SURAT JALAN</label>
                            <input type="text" class="form-control" value="{{ $submission->date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jam Checklist</label>
                            <input type="text" class="form-control" value="{{ $submission->clock_in }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>PENGIRIM/SUPPLIER</label>
                            <ul>
                                @php
                                $supplier = $submission->supplier;

                                // Remove double quotes and split the string by '|'
                                $supp = explode('|', str_replace('"', '', $supplier));
                                @endphp
                                @foreach($supp as $s)
                                    <li>{{ $s }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" value="{{ $submission->ket_awal }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Cuaca</label>
                            <input type="text" class="form-control" value="{{ $submission->cuaca }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Barang Sesuai Surat Jalan</label>
                            <input type="text" class="form-control" value="{{ $submission->sesuai }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Kondisi Kemasan Baik</label>
                            <input type="text" class="form-control" value="{{ $submission->baik }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto Barang Sesuai</label>
                            <div class="row">
                                @php
                                $foto1 = $submission->foto1;

                                // Remove double quotes and split the string by '|'
                                $foto = explode('|', str_replace('"', '', $foto1));
                                @endphp
                                @foreach($foto as $f)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/crc/'.$f) }}" class="img-fluid" alt="Foto Barang">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Barang Tidak Sesuai</label>
                            <div class="row">
                                @php
                                $foto2 = $submission->foto2;

                                // Remove double quotes and split the string by '|'
                                $foto2 = explode('|', str_replace('"', '', $foto2));
                                @endphp
                                @foreach($foto2 as $f)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/crc/'.$f) }}" class="img-fluid" alt="Foto Barang">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label>Foto Lainnya</label>
                            <div class="row">
                                @foreach($submission->foto as $foto)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/crc/'.$foto) }}" class="img-fluid" alt="Foto Lainnya">
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
