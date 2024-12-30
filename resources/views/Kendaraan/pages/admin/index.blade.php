@extends('Kendaraan.layout.main')
@section('title')
    Kelola Chceklist Kendaraan ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Kelola Checklist Kendaraan
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      <div class="d-flex justify-content-start mb-3">
        @if (Auth::user()->role == 1)
        <a href="{{ route('Kendaraan.admin.check.add') }}" class="btn btn-primary me-2"><i class="fa fa-plus"></i> Add New</a>
        @endif
        <a href="{{ route('Kendaraan.admin.export') }}" class="btn btn-warning"><i class="mdi mdi-export"></i> Export All Data</a>
    </div>
    
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>In (Jam)</th>
                  <th>No Urut</th>
                  <th>Responden</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$d->tanggal}}</td>
                  <td>{{$d->jam}}</td>
                  <td>{{$d->no_urut}}</td>
                  <td>
                    @php
                      $name = \App\Models\User::where('id',$d->user_id)->value('name');
                    @endphp
                    {{$name}}
                  </td>
                  <td>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $d->id }}">
                      <i class="mdi mdi-eye"></i> Detail
                    </a>
                  
                    <a href="{{route('Kendaraan.admin.print',$d->id)}}" class="btn btn-warning"><i class="mdi mdi-printer"></i> Print</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $d->id }}">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $d->id }}">
                      <i class="fa fa-trash"></i> Delete
                  </a>

                  <div class="modal fade" id="viewModal-{{ $d->id }}" data-bs-backdrop="false" tabindex="-3" aria-labelledby="viewModalLabel-{{ $d->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel-{{ $d->id }}">Details for ID: {{ $d->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                              <div class="header-container">
                                  <div class="logo">
                                      <img src="{{ asset('Logo TML.png') }}" width="35px" alt="Logo">
                                  </div>
                                  <div class="title">
                                      CHECKLIST KENDARAAN
                                  </div>
                                  
                                      <div class="no-urut">
                                        <p>FM.WH.07.03</p>
                                        NO. URUT: {{$d->no_urut}}<br>
                                        TGL: {{$d->tanggal}}<br>
                                        IN (Jam): {{$d->jam}} <br>
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
                                          <td>Nama Ekspedisi</td>
                                          <td>{{$d->nama_ekspedisi}}</td>
                                          <td>{{$d->ket_nama_ekspedisi}}</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>No Mobil (Foto)</td>
                                          <td>{{$d->no_mobil}} </td>
                                          <td>{{$d->ket_no_mobil}}</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>No Kontainer (Foto)</td>
                                          <td>{{$d->no_kontainer}} </td>
                                          <td>{{$d->ket_no_kontainer}}</td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td>Tujuan</td>
                                          <td>{{$d->tujuan}}</td>
                                          <td>{{$d->ket_tujuan}}</td>
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
                                          <td>Nama Sopir/Kenek</td>
                                          <td>{{$d->nama_sopir}}  </td>
                                          <td>{{$d->ket_nama_sopir}}</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>Helm</td>
                                          <td>
                                            {{$d->helm}}
                                          </td>
                                          <td>{{$d->ket_helm}}</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>Celana Panjang</td>
                                          <td>
                                            {{$d->celana_panjang}}
                                          </td>
                                          <td>{{$d->ket_celana_panjang}}</td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td>Baju Lengan Panjang</td>
                                          <td>
                                            {{$d->baju_lengan_panjang}}
                                          </td>
                                          <td>{{$d->ket_baju_lengan_panjang}}</td>
                                      </tr>
                                      <tr>
                                          <td>5</td>
                                          <td>Sepatu</td>
                                          <td>
                                            {{$d->sepatu}}
                                          </td>
                                          <td>{{$d->ket_sepatu}}</td>
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
                                          <td>{{$d->sim}}</td>
                                          <td>{{$d->ket_sim}}</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>Masa Berlaku SIM / KTP</td>
                                          <td>
                                            {{$d->masa_berlaku_sim}}
                                          </td>
                                          <td>{{$d->ket_masa_berlaku_sim}}</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>STNK</td>
                                          <td>{{$d->stnk}}</td>
                                          <td>{{$d->ket_stnk}}</td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td>Masa Berlaku STNK</td>
                                          <td>
                                            {{$d->masa_berlaku_stnk}}
                                          </td>
                                          <td>{{$d->keta_masa_berlaku_stnk}}</td>
                                      </tr>
                                      <tr>
                                          <td>5</td>
                                          <td>KIR</td>
                                          <td>{{$d->kir}}</td>
                                          <td>{{$d->ket_kir}}</td>
                                      </tr>
                                      <tr>
                                          <td>6</td>
                                          <td>MASA BERLAKU KIR</td>
                                          <td>
                                            {{$d->masa_berlaku_kir}}

                                          </td>
                                          <td>{{$d->ket_masa_berlaku_kir}}</td>
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
                                          <td>{{$d->surat_pengantar_ekspedisi}}</td>
                                          <td>{{$d->ket_surat_pengantar_ekspedisi}}</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>SEGEL</td>
                                          <td>{{$d->segel}}</td>
                                          <td>{{$d->ket_segel}}</td>
                                      </tr>
                                      
                                      <!-- Additional sections follow the same structure -->
                                  </table>
                                  <br>
                                  @php
                                      $name = \App\Models\User::where('id',$d->user_id)->value('name');
                                  @endphp
                                  Responden : {{$name}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                  
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $d->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <form action="{{route('Kendaraan.admin.kendaraan.delete',$d->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel-{{ $d->id }}">Delete d</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete this d?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="editModalLabel-{{ $d->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('Kendaraan.admin.kendaraan.update',$d->id)}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $d->id }}">Edit d</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Add form fields here with pre-filled data -->
                                        <div class="form-group">
                                            <label for="edit_no_urut_{{ $d->id }}">No Urut</label>
                                            <input type="text" class="form-control" id="edit_no_urut_{{ $d->id }}" name="no_urut" value="{{ $d->no_urut }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_date_{{ $d->id }}">Date</label>
                                            <input type="date" class="form-control" id="edit_date_{{ $d->id }}" name="date" value="{{ $d->created_at->format('Y-m-d') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_date_{{ $d->id }}">Jam</label>
                                            <input type="time" class="form-control" id="edit_jam_{{ $d->id }}" name="jam" value="{{ $d->jam }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_nama_ekspedisi_{{ $d->id }}">Nama Ekspedisi</label>
                                                    <input type="nama_ekspedisi" class="form-control" id="edit_nama_ekspedisi_{{ $d->id }}" name="nama_ekspedisi" value="{{ $d->nama_ekspedisi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_no_mobil_{{ $d->id }}">No Mobil</label>
                                                    <input type="no_mobil" class="form-control" id="edit_no_mobil_{{ $d->id }}" name="no_mobil" value="{{ $d->no_mobil }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_no_kontainer_{{ $d->id }}">No Kontainer</label>
                                                    <input type="no_kontainer" class="form-control" id="edit_no_kontainer_{{ $d->id }}" name="no_kontainer" value="{{ $d->no_kontainer }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_tujuan_{{ $d->id }}">Tujuan</label>
                                                    <input type="tujuan" class="form-control" id="edit_tujuan_{{ $d->id }}" name="tujuan" value="{{ $d->tujuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_nama_sopir_{{ $d->id }}">Nama Sopir</label>
                                                    <input type="nama_sopir" class="form-control" id="edit_nama_sopir_{{ $d->id }}" name="nama_sopir" value="{{ $d->nama_sopir }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_nama_sopir_{{ $d->id }}">Helm</label>
                                                    <select name="helm" class="form-control">
                                                        <option value="ADA" {{ $d->helm == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                        <option value="TIDAK ADA" {{ $d->helm == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_celana_panjang_{{ $d->id }}">celana_panjang</label>
                                                    <select name="celana_panjang" class="form-control">
                                                        <option value="ADA" {{ $d->celana_panjang == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                        <option value="TIDAK ADA" {{ $d->celana_panjang == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_baju_lengan_panjang_{{ $d->id }}">baju_lengan_panjang</label>
                                                    <select name="baju_lengan_panjang" class="form-control">
                                                        <option value="ADA" {{ $d->baju_lengan_panjang == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                        <option value="TIDAK ADA" {{ $d->baju_lengan_panjang == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_sepatu_{{ $d->id }}">sepatu</label>
                                                    <select name="sepatu" class="form-control">
                                                        <option value="ADA" {{ $d->sepatu == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                        <option value="TIDAK ADA" {{ $d->sepatu == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_sim_{{ $d->id }}">sim</label>
                                                    <input type="sim" class="form-control" id="edit_sim_{{ $d->id }}" name="sim" value="{{ $d->sim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_masa_berlaku_sim_{{ $d->id }}">masa_berlaku_sim</label>
                                                    <select name="masa_berlaku_sim" class="form-control">
                                                        <option value="YA" {{ $d->masa_berlaku_sim == 'YA' ? 'selected' : '' }}>YA</option>
                                                        <option value="TDK" {{ $d->masa_berlaku_sim == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_stnk_{{ $d->id }}">stnk</label>
                                                    <input type="stnk" class="form-control" id="edit_stnk_{{ $d->id }}" name="stnk" value="{{ $d->stnk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_masa_berlaku_stnk_{{ $d->id }}">masa_berlaku_stnk</label>
                                                    <select name="masa_berlaku_stnk" class="form-control">
                                                        <option value="YA" {{ $d->masa_berlaku_stnk == 'YA' ? 'selected' : '' }}>YA</option>
                                                        <option value="TDK" {{ $d->masa_berlaku_stnk == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_kir_{{ $d->id }}">kir</label>
                                                    <input type="kir" class="form-control" id="edit_kir_{{ $d->id }}" name="kir" value="{{ $d->kir }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_masa_berlaku_kir_{{ $d->id }}">masa_berlaku_kir</label>
                                                    <select name="masa_berlaku_kir" class="form-control">
                                                        <option value="YA" {{ $d->masa_berlaku_kir == 'YA' ? 'selected' : '' }}>YA</option>
                                                        <option value="TDK" {{ $d->masa_berlaku_kir == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_surat_pengantar_ekspedisi_{{ $d->id }}">surat_pengantar_ekspedisi</label>
                                                    <input type="surat_pengantar_ekspedisi" class="form-control" id="edit_surat_pengantar_ekspedisi_{{ $d->id }}" name="surat_pengantar_ekspedisi" value="{{ $d->surat_pengantar_ekspedisi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_segel_{{ $d->id }}">segel</label>
                                                    <input type="segel" class="form-control" id="edit_segel_{{ $d->id }}" name="segel" value="{{ $d->segel }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_ket_nama_ekspedisi_{{ $d->id }}">Ket Nama Ekspedisi</label>
                                                    <input type="ket_nama_ekspedisi" class="form-control" id="edit_ket_nama_ekspedisi_{{ $d->id }}" name="ket_nama_ekspedisi" value="{{ $d->ket_nama_ekspedisi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_no_mobil_{{ $d->id }}">Ket No Mobil</label>
                                                    <input type="ket_no_mobil" class="form-control" id="edit_ket_no_mobil_{{ $d->id }}" name="ket_no_mobil" value="{{ $d->ket_no_mobil }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_no_kontainer_{{ $d->id }}">ket_no_kontainer</label>
                                                    <input type="ket_no_kontainer" class="form-control" id="edit_ket_no_kontainer_{{ $d->id }}" name="ket_no_kontainer" value="{{ $d->ket_no_kontainer }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_tujuan_{{ $d->id }}">ket_tujuan</label>
                                                    <input type="ket_tujuan" class="form-control" id="edit_ket_tujuan_{{ $d->id }}" name="ket_tujuan" value="{{ $d->ket_tujuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_nama_supir_{{ $d->id }}">ket_nama_supir</label>
                                                    <input type="ket_nama_supir" class="form-control" id="edit_ket_nama_supir_{{ $d->id }}" name="ket_nama_supir" value="{{ $d->ket_nama_supir }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_helm_{{ $d->id }}">ket_helm</label>
                                                    <input type="ket_helm" class="form-control" id="edit_ket_helm_{{ $d->id }}" name="ket_helm" value="{{ $d->ket_helm }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_celana_panjang_{{ $d->id }}">ket_celana_panjang</label>
                                                    <input type="ket_celana_panjang" class="form-control" id="edit_ket_celana_panjang_{{ $d->id }}" name="ket_celana_panjang" value="{{ $d->ket_celana_panjang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_baju_lengan_panjang_{{ $d->id }}">ket_baju_lengan_panjang</label>
                                                    <input type="ket_baju_lengan_panjang" class="form-control" id="edit_ket_baju_lengan_panjang_{{ $d->id }}" name="ket_baju_lengan_panjang" value="{{ $d->ket_baju_lengan_panjang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_sepatu_{{ $d->id }}">ket_sepatu</label>
                                                    <input type="ket_sepatu" class="form-control" id="edit_ket_sepatu_{{ $d->id }}" name="ket_sepatu" value="{{ $d->ket_sepatu }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_sim_{{ $d->id }}">ket_sim</label>
                                                    <input type="ket_sim" class="form-control" id="edit_ket_sim_{{ $d->id }}" name="ket_sim" value="{{ $d->ket_sim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_masa_berlku_sim_{{ $d->id }}">ket_masa_berlku_sim</label>
                                                    <input type="date" class="form-control" id="edit_ket_masa_berlku_sim_{{ $d->id }}" name="ket_masa_berlaku_sim" value="{{ $d->ket_masa_berlaku_sim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_stnk_{{ $d->id }}">ket_stnk</label>
                                                    <input type="ket_stnk" class="form-control" id="edit_ket_stnk_{{ $d->id }}" name="ket_stnk" value="{{ $d->ket_stnk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_masa_berlaku_stnk_{{ $d->id }}">ket_masa_berlaku_stnk</label>
                                                    <input type="date" class="form-control" id="edit_ket_masa_berlaku_stnk_{{ $d->id }}" name="ket_masa_berlaku_stnk" value="{{ $d->ket_masa_berlaku_stnk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_kir_{{ $d->id }}">ket_kir</label>
                                                    <input type="ket_kir" class="form-control" id="edit_ket_kir_{{ $d->id }}" name="ket_kir" value="{{ $d->ket_kir }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_masa_berlaku_kir_{{ $d->id }}">ket_masa_berlaku_kir</label>
                                                    <input type="ket_masa_berlaku_kir" class="form-control" id="edit_ket_masa_berlaku_kir_{{ $d->id }}" name="ket_masa_berlaku_kir" value="{{ $d->ket_masa_berlaku_kir }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_surat_pengantar_ekspedisi_{{ $d->id }}">ket_surat_pengantar_ekspedisi</label>
                                                    <input type="ket_surat_pengantar_ekspedisi" class="form-control" id="edit_ket_surat_pengantar_ekspedisi_{{ $d->id }}" name="ket_surat_pengantar_ekspedisi" value="{{ $d->ket_surat_pengantar_ekspedisi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_ket_segel_{{ $d->id }}">ket_segel</label>
                                                    <input type="ket_segel" class="form-control" id="edit_ket_segel_{{ $d->id }}" name="ket_segel" value="{{ $d->ket_segel }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_no_mobil_foto_{{ $d->id }}">No Mobil Foto</label>
                                                    <input type="file" class="form-control" id="edit_no_mobil_foto_{{ $d->id }}" name="no_mobil_foto" value="{{ $d->no_mobil_foto }}">
                                                </div>
                                                <img src="{{ asset('storage/' . $d->no_mobil_foto) }}" alt="No Mobil Foto" class="img-preview">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_no_kontainer_foto_{{ $d->id }}">No Kontainer Foto</label>
                                                    <input type="file" class="form-control" id="edit_no_kontainer_foto_{{ $d->id }}" name="no_kontainer_foto" value="{{ $d->no_kontainer_foto }}">
                                                </div>
                                                <img src="{{ asset('storage/' . $d->no_kontainer_foto) }}" alt="No Kontainer Foto" class="img-preview">
                                            </div>
                                        </div>
                                        
                                        <style>
                                            .img-preview {
                                            border: 2px solid #ddd; /* Light gray border */
                                            border-radius: 8px; /* Rounded corners */
                                            padding: 5px; /* Padding around the image */
                                            max-width: 100%; /* Ensure the image is responsive */
                                            height: auto; /* Maintain aspect ratio */
                                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Slight shadow for depth */
                                        }

                                        </style>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      
    </div>
    


    </div>
</div>
@endsection