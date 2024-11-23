@extends('Form-Check.layout.main')

@section('title', 'Detail Submission Material RESIN')

@section('content')
<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Detail Submission Material RESIN
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
                    <h4 class="card-title">Detail Form Submission Material RESIN</h4>
                    <p class="card-description">Detail dari submission material RESIN yang telah diinput sebelumnya.</p>

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

                        {{-- Image Sections with Modal --}}
                        <div class="form-group">
                            <label>Foto Barang Sesuai</label>
                            <div class="row">
                                @foreach(\App\Models\Resin_ImageM::where('resin_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/resin/' . $foto) }}" 
                                                 class="img-fluid img-thumbnail" 
                                                 alt="Foto Barang Sesuai"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal{{ md5($foto) }}">
                                        </div>

                                        {{-- Modal for Image --}}
                                        <div class="modal fade" id="imageModal{{ md5($foto) }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Foto Barang Sesuai</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/resin/' . $foto) }}" class="img-fluid" alt="Foto Barang Sesuai">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        {{-- Repeat for other image categories --}}
                        <div class="form-group">
                            <label>Foto Barang Tidak Sesuai</label>
                            <div class="row">
                                @foreach(\App\Models\Resin_ImageM::where('resin_id', $submission->id)->get() as $item)
                                    @foreach(json_decode($item->foto1, true) ?? [] as $foto)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/resin/' . $foto) }}" 
                                                 class="img-fluid img-thumbnail" 
                                                 alt="Foto Barang Tidak Sesuai"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal{{ md5($foto) }}">
                                        </div>

                                        {{-- Modal for Image --}}
                                        <div class="modal fade" id="imageModal{{ md5($foto) }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Foto Barang Tidak Sesuai</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/resin/' . $foto) }}" class="img-fluid" alt="Foto Barang Tidak Sesuai">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        {{-- Add more sections for other image categories as needed --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
