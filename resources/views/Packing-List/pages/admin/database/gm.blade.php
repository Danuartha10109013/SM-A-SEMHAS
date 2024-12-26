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
          <h4 class="card-title">Database</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Packing-List.admin.gm.add') : route('Packing-List.pegawai.gm.add') }}" 
                   class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan Database </a>
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="btn btn-success" style="text-decoration:  none; font-size: 15px">Export Excel</a> --}}
                   <form class="ml-2" action="{{route('Packing-List.admin.gm.excel.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excel">
                    <button type="submit" class="btn btn-success">Save</button>
                   </form>
            </div>
        
            <form action="{{ route('Packing-List.admin.gm') }}" method="GET" class="ml-2" style="display: inline;">
              <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
              <input type="hidden" name="sort" value="{{ request('sort') }}">
              <input type="hidden" name="direction" value="{{ request('direction') }}">
              <button type="submit" style="border: none; padding: 0; cursor: pointer;"> 
                  <label class="btn btn-danger" style="text-decoration: none;">Search</label>
              </button>
          </form>
        </div>
        <p>template untuk upload selain dari bravo <a href="{{route('download.file','Template Packing List.xlsx')}}">Download</a>
          <form class="ml-2" action="{{route('Packing-List.admin.gm.excel.store1')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="excel">
          <button type="submit" class="btn btn-success">Save</button>
         </form></p>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Kode </th>
                  <th> Nama Produk </th>
                  <th> QTY </th>
                  <th> UOM </th>
                  <th> No Coil </th>
                  <th> Panjang </th>
                  <th> Storage Bin </th>
                  <th> 
                    <a href="{{ route('Packing-List.admin.gm', [
                        'sort' => 'date', 
                        'direction' => request('direction') == 'asc' ? 'desc' : 'asc', 
                        'search' => request('search')  // Use request('search') directly here
                    ]) }}">
                        tanggal <i class="fa-solid fa-arrows-up-down"></i>
                        @if ($sort == 'date')
                            <i class="fa fa-sort-{{ $direction == 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>  
                </th>
                
                  <th> Action </th>
                  <th> Pengirim </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->kode}} </td>
                    <td> {{$d->nama_produk}} </td>
                    <td> {{$d->qty}} </td>
                    <td> {{$d->uom}} </td>
                    <td>{{$d->attribute}}</td>
                    <td>{{$d->panjang}}</td>
                    <td>{{$d->storage_bin}}</td>
                    <td>{{$d->date}}</td>
                    <td><a href="{{route('Packing-List.admin.gm.edit',$d->id)}}">
                      <label class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                      </label></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $d->id }}">
                        <i class="fas fa-trash"></i> Delete
                      </button>

                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>
                      <script>
                        $('#deleteModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget); // Button that triggered the modal
                            var id = button.data('id'); // Extract the ID from data-* attributes
                            var actionUrl = "{{ route('Packing-List.admin.gm.delete', ':id') }}";
                            actionUrl = actionUrl.replace(':id', id);
                            $('#deleteForm').attr('action', actionUrl);
                        });
                    </script>
                    
                    </td>
                    <td>
                      @php
                        $name = \App\Models\User::where('id',$d->user_id)->value('name');
                      @endphp
                      {{$name}} 
                    </td>

                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
          </div>
                
                
                <div class="container mt-3">
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
                                  <form action="{{ route('Packing-List.admin.gm.clear') }}" method="POST">
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