@extends('Packing-List.layout.main')


@section('title')
    Open Packing ||
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
          <h4 class="card-title">Hasil Scan</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Packing-List.admin.list.add') : route('Packing-List.pegawai.list.add') }}" 
                   class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px"><i class="mdi mdi-qrcode"></i>Scan </a>
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
            </div>
        
            <form action="{{ route('Packing-List.admin.list') }}" method="GET" class="ml-2" style="display: inline;">
                <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
                <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                    <label class="btn btn-danger" style="text-decoration: none;">Search</label>
                </button>
            </form>
        </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> No </th>
                  <th> No Coil </th>
                  <th> Kerangan </th>
                  <th> Date </th>
                  <th> Panjang </th>
                  <th> Action </th>
                  <th> Kondisi </th>
                  <th> Tujuan </th>
                  <th> Responden </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->attribute}} </td>
                    <td> {{$d->keterangan}} </td>
                    <td> {{$d->created_at}} </td>
                    <td>{{$d->panjang}}</td>
                    <td><a href="{{route('Packing-List.admin.list.edit',$d->id)}}">
                      <label class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                      </label></a>
                      <a href="#" 
                        class="btn " 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal{{$d->id}}">
                        <label class="btn btn-danger">
                          <i class="fas fa-trash"></i> Delete
                        </label>
                      </a>

                      <!-- Modal untuk Setiap Item -->
                      <div class="modal fade" id="deleteModal{{$d->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$d->id}}" aria-hidden="true" data-bs-backdrop="false" data-bs-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel{{$d->id}}">Konfirmasi Hapus</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Apakah Anda yakin ingin menghapus item ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <a href="{{route('Packing-List.admin.list.delete', $d->id)}}" class="btn btn-danger">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td> {{$d->kondisi}} </td>
                    <td> {{$d->tujuan}} </td>
                    <td>
                      @php
                        $name = \App\Models\User::where('id',$d->user_id)->value('name');
                      @endphp
                      {{$name}} </td>

                    
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          <div class="container">
            <h2>Clear All Data?</h2>
            <p>Are you sure you want to clear all data? This action cannot be undone.</p>
        
            <div class="alert alert-warning">
                <strong>Warning:</strong> This will remove all records permanently!
            </div>
        
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clearDataModal">
                Yes, Clear All Data
            </button>
        
            <!-- Modal -->
            <div class="modal fade" id="clearDataModal" tabindex="-1" aria-labelledby="clearDataModalLabel" aria-hidden="true" data-bs-backdrop="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="clearDataModalLabel">Confirm Clear All Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to clear all data? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{route('Packing-List.admin.list.clearall')}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Yes, Clear All Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          
          <!-- Bootstrap CSS and JS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          
        </div>
      </div>
    </div>
  </div>
@endsection