@extends('Open-Packing.layout.main')
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
          <h4 class="card-title">Perintah Open Packing</h4>
          <h5 class="card-title">22665</h5>
            <p>No GM : {{$gm}}</p>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">

                {{-- <a href="{{ Auth::user()->role == 0 ? route('Open-Packing.admin.packing.add.gm',$gm) : route('Open-Packing.pegawai.packing.add') }}" 
                   class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan Product</a> --}}
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="badge badge-gradient-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
            </div>
        
            {{-- <form action="{{ route('Form-Check.admin.crane') }}" method="GET" class="ml-2" style="display: inline;">
                <input type="text" name="search" placeholder="Search By Responden" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="direction" value="{{ $direction }}">
                <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                    <label class="badge badge-gradient-danger" style="text-decoration: none;">Search</label>
                </button>
            </form> --}}
        </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Atribute / Batch </th>
                  <th> Berat Label </th>
                  <th> Berat Aktual </th>
                  <th> Selisih </th>
                  <th> Persentase </th>
                  <th> Keterangan </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->attribute}} </td>
                    <td> {{$d->b_label}} </td>
                    <td> {{$d->b_aktual}} </td>
                    <td> {{$d->selisih}} </td>
                    @if ($d->persentase >= 0)
                    <td style="color: green">{{$d->persentase}} %</td>
                    @elseif ($d->persentase <= -0.25)
                        <td style="color: red">{{$d->persentase}} %</td>
                    @else
                        <td style="color: green">{{$d->persentase}} %</td>
                    @endif
                    <td>{{$d->keterangan}}</td>
                    <td><a href="{{route('Open-Packing.admin.packing.edit',$d->id)}}">
                      <label class="btn btn-primary">
                        <i class="fas fa-edit"></i> 
                      </label></a>
                      <!-- Tombol Hapus -->
                      <a href="#" 
                      class="delete-button" 
                      data-bs-toggle="modal" 
                      data-bs-target="#deleteModal" 
                      data-id="{{ $d->id }}"><label class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </label>
                      </a>

                      <!-- Modal -->
                      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" data-bs-backdrop="false" data-bs-keyboard="false" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <a href="#" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
                        </div>
                      </div>
                      </div>
                      </div>

                      <!-- JavaScript -->
                      <script>
                      document.addEventListener('DOMContentLoaded', () => {
                        const deleteModal = document.getElementById('deleteModal');
                        const confirmDeleteButton = deleteModal.querySelector('#confirmDeleteButton');

                        document.querySelectorAll('.delete-button').forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                const deleteUrl = `{{ route('Open-Packing.admin.packing.delete', ':id') }}`.replace(':id', id);
                                confirmDeleteButton.setAttribute('href', deleteUrl);
                            });
                        });
                      });
                      </script>

                      
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
@endsection