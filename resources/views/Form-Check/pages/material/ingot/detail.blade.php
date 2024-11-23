@extends('Form-Check.layout.main')
@section('title', 'Detail Submission Ingot Material CRC')
@section('content')

<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Detail Submission Ingot Material CRC
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
                    <h4 class="card-title">Detail Form Daily Checklist Kedatangan Ingot Material FM.WH.02.01</h4>
                    <p class="card-description">Detail dari submission material Ingot CRC yang telah diinput sebelumnya.</p>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>PENERIMA</label>
                            <p class="form-control-static">{{ \App\Models\User::where('id', $submission->user_id)->value('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>NOMOR DOKUMEN</label>
                            <p class="form-control-static">{{ $submission->shift_leader }}</p>
                        </div>

                        <div class="form-group">
                            <label>TANGGAL SURAT JALAN</label>
                            <p class="form-control-static">{{ $submission->date }}</p>
                        </div>
                        <div class="form-group">
                            <label>Jam Checklist</label>
                            <p class="form-control-static">{{ $submission->created_at->format('H:i:s') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Barang Sesuai Surat Jalan</label>
                            <p class="form-control-static">{{ $submission->sesuai }}</p>
                        </div>

                        {{-- Image Sections --}}
                        <div class="form-group">
                            <label>Foto Barang Sesuai</label>
                            <div class="row">
                                @foreach(\App\Models\Ingot_imageM::where('ingot_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/ingot/' . $foto) }}" class="img-fluid" alt="Foto Barang Sesuai">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Barang Tidak Sesuai</label>
                            <div class="row">
                                @foreach(\App\Models\Ingot_imageM::where('ingot_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto1, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/ingot/' . $foto) }}" class="img-fluid" alt="Foto Barang Tidak Sesuai">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Lainnya</label>
                            <div class="row">
                                @foreach(\App\Models\Ingot_imageM::where('ingot_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto3, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/ingot/' . $foto) }}" class="img-fluid" alt="Foto Lainnya">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Tambahan</label>
                            <div class="row">
                                @foreach(\App\Models\Ingot_imageM::where('ingot_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto5, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/ingot/' . $foto) }}" class="img-fluid" alt="Foto Tambahan">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
