@extends('Kendaraan.layout.main')

@section('title')
    Dashboard ||
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dashboard</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('Kendaraan.pegawai.check.add') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Add Checklist
                        </a>
                    </div>
                    <form action="{{route('Kendaraan.pegawai.dashboard')}}" method="GET" class="ml-2">
                        <input type="text" name="search" placeholder="Search by No Pol" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-danger ml-2">Search</button>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TGL</th>
                                <th>IN (Jam)</th>
                                <th>Action</th>
                                <th>NO. URUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->created_at->format('d-m-Y') }}</td> 
                                    <td>{{ $record->jam }}</td>     
                                    <td>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $record->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $record->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <a href="{{route('Kendaraan.pegawai.print',$record->id)}}" class="btn btn-warning">
                                            <i class="fa fa-print"></i>print
                                        </a>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $record->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $record->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('Kendaraan.pegawai.kendaraan.delete',$record->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel-{{ $record->id }}">Delete Record</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this record?
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
                                        <div class="modal fade" id="editModal-{{ $record->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="editModalLabel-{{ $record->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('Kendaraan.pegawai.kendaraan.update',$record->id)}}" enctype="multipart/form-data" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel-{{ $record->id }}">Edit Record</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Add form fields here with pre-filled data -->
                                                            <div class="form-group">
                                                                <label for="edit_no_urut_{{ $record->id }}">No Urut</label>
                                                                <input type="text" class="form-control" id="edit_no_urut_{{ $record->id }}" name="no_urut" value="{{ $record->no_urut }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_date_{{ $record->id }}">Date</label>
                                                                <input type="date" class="form-control" id="edit_date_{{ $record->id }}" name="date" value="{{ $record->created_at->format('Y-m-d') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_date_{{ $record->id }}">Jam</label>
                                                                <input type="time" class="form-control" id="edit_jam_{{ $record->id }}" name="jam" value="{{ $record->jam }}">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_nama_ekspedisi_{{ $record->id }}">Nama Ekspedisi</label>
                                                                        <input type="nama_ekspedisi" class="form-control" id="edit_nama_ekspedisi_{{ $record->id }}" name="nama_ekspedisi" value="{{ $record->nama_ekspedisi }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_no_mobil_{{ $record->id }}">No Mobil</label>
                                                                        <input type="no_mobil" class="form-control" id="edit_no_mobil_{{ $record->id }}" name="no_mobil" value="{{ $record->no_mobil }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_no_kontainer_{{ $record->id }}">No Kontainer</label>
                                                                        <input type="no_kontainer" class="form-control" id="edit_no_kontainer_{{ $record->id }}" name="no_kontainer" value="{{ $record->no_kontainer }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_tujuan_{{ $record->id }}">Tujuan</label>
                                                                        <input type="tujuan" class="form-control" id="edit_tujuan_{{ $record->id }}" name="tujuan" value="{{ $record->tujuan }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_nama_sopir_{{ $record->id }}">Nama Sopir</label>
                                                                        <input type="nama_sopir" class="form-control" id="edit_nama_sopir_{{ $record->id }}" name="nama_sopir" value="{{ $record->nama_sopir }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_nama_sopir_{{ $record->id }}">Helm</label>
                                                                        <select name="helm" class="form-control">
                                                                            <option value="ADA" {{ $record->helm == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                                            <option value="TIDAK ADA" {{ $record->helm == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_celana_panjang_{{ $record->id }}">celana_panjang</label>
                                                                        <select name="celana_panjang" class="form-control">
                                                                            <option value="ADA" {{ $record->celana_panjang == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                                            <option value="TIDAK ADA" {{ $record->celana_panjang == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_baju_lengan_panjang_{{ $record->id }}">baju_lengan_panjang</label>
                                                                        <select name="baju_lengan_panjang" class="form-control">
                                                                            <option value="ADA" {{ $record->baju_lengan_panjang == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                                            <option value="TIDAK ADA" {{ $record->baju_lengan_panjang == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_sepatu_{{ $record->id }}">sepatu</label>
                                                                        <select name="sepatu" class="form-control">
                                                                            <option value="ADA" {{ $record->sepatu == 'ADA' ? 'selected' : '' }}>ADA</option>
                                                                            <option value="TIDAK ADA" {{ $record->sepatu == 'TIDAK ADA' ? 'selected' : '' }}>TIDAK ADA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_sim_{{ $record->id }}">sim</label>
                                                                        <input type="sim" class="form-control" id="edit_sim_{{ $record->id }}" name="sim" value="{{ $record->sim }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_masa_berlaku_sim_{{ $record->id }}">masa_berlaku_sim</label>
                                                                        <select name="masa_berlaku_sim" class="form-control">
                                                                            <option value="YA" {{ $record->masa_berlaku_sim == 'YA' ? 'selected' : '' }}>YA</option>
                                                                            <option value="TDK" {{ $record->masa_berlaku_sim == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_stnk_{{ $record->id }}">stnk</label>
                                                                        <input type="stnk" class="form-control" id="edit_stnk_{{ $record->id }}" name="stnk" value="{{ $record->stnk }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_masa_berlaku_stnk_{{ $record->id }}">masa_berlaku_stnk</label>
                                                                        <select name="masa_berlaku_stnk" class="form-control">
                                                                            <option value="YA" {{ $record->masa_berlaku_stnk == 'YA' ? 'selected' : '' }}>YA</option>
                                                                            <option value="TDK" {{ $record->masa_berlaku_stnk == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_kir_{{ $record->id }}">kir</label>
                                                                        <input type="kir" class="form-control" id="edit_kir_{{ $record->id }}" name="kir" value="{{ $record->kir }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_masa_berlaku_kir_{{ $record->id }}">masa_berlaku_kir</label>
                                                                        <select name="masa_berlaku_kir" class="form-control">
                                                                            <option value="YA" {{ $record->masa_berlaku_kir == 'YA' ? 'selected' : '' }}>YA</option>
                                                                            <option value="TDK" {{ $record->masa_berlaku_kir == 'TDK' ? 'selected' : '' }}>TDK</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_surat_pengantar_ekspedisi_{{ $record->id }}">surat_pengantar_ekspedisi</label>
                                                                        <input type="surat_pengantar_ekspedisi" class="form-control" id="edit_surat_pengantar_ekspedisi_{{ $record->id }}" name="surat_pengantar_ekspedisi" value="{{ $record->surat_pengantar_ekspedisi }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_segel_{{ $record->id }}">segel</label>
                                                                        <input type="segel" class="form-control" id="edit_segel_{{ $record->id }}" name="segel" value="{{ $record->segel }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_nama_ekspedisi_{{ $record->id }}">Ket Nama Ekspedisi</label>
                                                                        <input type="ket_nama_ekspedisi" class="form-control" id="edit_ket_nama_ekspedisi_{{ $record->id }}" name="ket_nama_ekspedisi" value="{{ $record->ket_nama_ekspedisi }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_no_mobil_{{ $record->id }}">Ket No Mobil</label>
                                                                        <input type="ket_no_mobil" class="form-control" id="edit_ket_no_mobil_{{ $record->id }}" name="ket_no_mobil" value="{{ $record->ket_no_mobil }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_no_kontainer_{{ $record->id }}">ket_no_kontainer</label>
                                                                        <input type="ket_no_kontainer" class="form-control" id="edit_ket_no_kontainer_{{ $record->id }}" name="ket_no_kontainer" value="{{ $record->ket_no_kontainer }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_tujuan_{{ $record->id }}">ket_tujuan</label>
                                                                        <input type="ket_tujuan" class="form-control" id="edit_ket_tujuan_{{ $record->id }}" name="ket_tujuan" value="{{ $record->ket_tujuan }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_nama_supir_{{ $record->id }}">ket_nama_supir</label>
                                                                        <input type="ket_nama_supir" class="form-control" id="edit_ket_nama_supir_{{ $record->id }}" name="ket_nama_supir" value="{{ $record->ket_nama_supir }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_helm_{{ $record->id }}">ket_helm</label>
                                                                        <input type="ket_helm" class="form-control" id="edit_ket_helm_{{ $record->id }}" name="ket_helm" value="{{ $record->ket_helm }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_celana_panjang_{{ $record->id }}">ket_celana_panjang</label>
                                                                        <input type="ket_celana_panjang" class="form-control" id="edit_ket_celana_panjang_{{ $record->id }}" name="ket_celana_panjang" value="{{ $record->ket_celana_panjang }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_baju_lengan_panjang_{{ $record->id }}">ket_baju_lengan_panjang</label>
                                                                        <input type="ket_baju_lengan_panjang" class="form-control" id="edit_ket_baju_lengan_panjang_{{ $record->id }}" name="ket_baju_lengan_panjang" value="{{ $record->ket_baju_lengan_panjang }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_sepatu_{{ $record->id }}">ket_sepatu</label>
                                                                        <input type="ket_sepatu" class="form-control" id="edit_ket_sepatu_{{ $record->id }}" name="ket_sepatu" value="{{ $record->ket_sepatu }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_sim_{{ $record->id }}">ket_sim</label>
                                                                        <input type="ket_sim" class="form-control" id="edit_ket_sim_{{ $record->id }}" name="ket_sim" value="{{ $record->ket_sim }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_masa_berlku_sim_{{ $record->id }}">ket_masa_berlku_sim</label>
                                                                        <input type="date" class="form-control" id="edit_ket_masa_berlku_sim_{{ $record->id }}" name="ket_masa_berlaku_sim" value="{{ $record->ket_masa_berlaku_sim }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_stnk_{{ $record->id }}">ket_stnk</label>
                                                                        <input type="ket_stnk" class="form-control" id="edit_ket_stnk_{{ $record->id }}" name="ket_stnk" value="{{ $record->ket_stnk }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_masa_berlaku_stnk_{{ $record->id }}">ket_masa_berlaku_stnk</label>
                                                                        <input type="date" class="form-control" id="edit_ket_masa_berlaku_stnk_{{ $record->id }}" name="ket_masa_berlaku_stnk" value="{{ $record->ket_masa_berlaku_stnk }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_kir_{{ $record->id }}">ket_kir</label>
                                                                        <input type="ket_kir" class="form-control" id="edit_ket_kir_{{ $record->id }}" name="ket_kir" value="{{ $record->ket_kir }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_masa_berlaku_kir_{{ $record->id }}">ket_masa_berlaku_kir</label>
                                                                        <input type="ket_masa_berlaku_kir" class="form-control" id="edit_ket_masa_berlaku_kir_{{ $record->id }}" name="ket_masa_berlaku_kir" value="{{ $record->ket_masa_berlaku_kir }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_surat_pengantar_ekspedisi_{{ $record->id }}">ket_surat_pengantar_ekspedisi</label>
                                                                        <input type="ket_surat_pengantar_ekspedisi" class="form-control" id="edit_ket_surat_pengantar_ekspedisi_{{ $record->id }}" name="ket_surat_pengantar_ekspedisi" value="{{ $record->ket_surat_pengantar_ekspedisi }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_ket_segel_{{ $record->id }}">ket_segel</label>
                                                                        <input type="ket_segel" class="form-control" id="edit_ket_segel_{{ $record->id }}" name="ket_segel" value="{{ $record->ket_segel }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_no_mobil_foto_{{ $record->id }}">No Mobil Foto</label>
                                                                        <input type="file" class="form-control" id="edit_no_mobil_foto_{{ $record->id }}" name="no_mobil_foto" value="{{ $record->no_mobil_foto }}">
                                                                    </div>
                                                                    <img src="{{ asset('storage/' . $record->no_mobil_foto) }}" alt="No Mobil Foto" class="img-preview">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_no_kontainer_foto_{{ $record->id }}">No Kontainer Foto</label>
                                                                        <input type="file" class="form-control" id="edit_no_kontainer_foto_{{ $record->id }}" name="no_kontainer_foto" value="{{ $record->no_kontainer_foto }}">
                                                                    </div>
                                                                    <img src="{{ asset('storage/' . $record->no_kontainer_foto) }}" alt="No Kontainer Foto" class="img-preview">
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
                                    <td>{{ $record->no_urut }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
