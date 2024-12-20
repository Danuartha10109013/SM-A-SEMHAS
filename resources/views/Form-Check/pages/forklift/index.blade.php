@extends('Form-Check.layout.main')
@section('title')
    Form Forklift
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
            <i class="mdi mdi-home"></i>
          </span> Form forklift
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex">
            <a href="{{ Auth::user()->role == 0 ? route('Form-Check.admin.forklift.add') : route('Form-Check.pegawai.forklift.add') }}" 
               class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
            <a href="{{ route('Form-Check.admin.forklift.export') }}" 
               class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a>
        </div>
    
        <form action="{{ route('Form-Check.admin.forklift') }}" method="GET" class="ml-2" style="display: inline;">
            <input type="text" name="search" placeholder="Search By Responden" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <input type="hidden" name="direction" value="{{ $direction }}">
            <button class="btn btn-success" type="submit"> 
                Search
            </button>
        </form>
    </div>

    <form action="{{ Auth::user()->role == 0 ? route('Form-Check.admin.forklift') : route('Form-Check.pegawai.forklift') }}">
      <div class="row mb-3">
          <div class="col-md-5">
              <input class="form-control" value="{{$start}}" type="date" name="start">
          </div>
          <div class="col-md-5">
              <input class="form-control" value="{{$end}}" type="date" name="end">
          </div>
          <div class="col-md-2 align-middle">
              <button type="submit" class="btn btn-success">Filter</button>
          </div>
      </div>
  </form>

      <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Recent Response</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> No </th>
                        
                        <th> 
                          @if (Auth::user()->role==0)
                          <a href="{{ route('Form-Check.admin.forklift', ['sort' => 'jenis_forklift', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                          @else
                          <a href="{{ route('Form-Check.pegawai.forklift', ['sort' => 'jenis_forklift', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                          @endif
                            Jenis Forklift<i class="fa-solid fa-arrows-up-down"></i>
                            @if ($sort === 'jenis_forklift')
                                <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a> 
                      </th>
                      <th>Responden</th>
                        <th> 
                          @if (Auth::user()->role==0)
                          <a href="{{ route('Form-Check.admin.forklift', ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                          @else
                          <a href="{{ route('Form-Check.pegawai.forklift', ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                          @endif
                            Date<i class="fa-solid fa-arrows-up-down"></i>
                            @if ($sort === 'date')
                                <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                       </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                      <tr>
                        <td>
                          {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                        </td>
                        <td> {{ $d->jenis_forklift }} </td>
                        <td>
                            @php
                                $nama = \App\Models\User::where('id', $d->user_id)->value('name');
                            @endphp
                            {{ $nama }}
                        </td>
                        <td>{{$d->created_at}}</td>
                        <td>
                          <div class="d-flex justify-content-start align-items-center">
                              @if (Auth::user()->role == 0)
                                  <a href="{{ route('Form-Check.admin.forklift.show', $d->id) }}">
                                      <button class="btn btn-primary me-2">Detail</button>
                                  </a>
                                  <a href="{{ route('Form-Check.admin.forklift.print', $d->id) }}">
                                      <button class="btn btn-success me-2">Print</button>
                                  </a>
                                 <!-- Delete Button -->
                                  <button type="button" 
                                  class="btn btn-danger delete-button" 
                                  data-id="{{ $d->id }}" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#deleteModal">
                                  Hapus
                                  </button>

                                  <!-- Confirmation Modal -->
                                  <div class="modal fade" data-bs-backdrop="false" data-bs-keyboard="false" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                          <form id="deleteForm" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- JavaScript -->
                                  <script>
                                  document.addEventListener('DOMContentLoaded', () => {
                                  const deleteModal = document.getElementById('deleteModal');
                                  const deleteForm = deleteModal.querySelector('#deleteForm');

                                  // Attach event listeners to all delete buttons
                                  document.querySelectorAll('.delete-button').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const id = this.getAttribute('data-id');
                                        const action = `{{ route('Form-Check.admin.forklift.destroy', ':id') }}`.replace(':id', id);

                                        // Dynamically update the form's action
                                        deleteForm.setAttribute('action', action);
                                    });
                                  });
                                  });
                                  </script>

                              @else
                                  <a href="{{ route('Form-Check.pegawai.forklift.show', $d->id) }}">
                                    <button class="btn btn-primary me-2">Detail</button>
                                </a>
                                  <a href="{{ route('Form-Check.pegawai.forklift.print', $d->id) }}">
                                      <button class="btn btn-success">Print</button>
                                  </a>
                              @endif
                          </div>
                      </td>
                      
                      
                      
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <style>
                    svg .w-5 {
                      display: none;
                    }
                    .hidden{
                      display: none;
                    }
                  </style>
                </div>
                <div class="mt-3">
                  {{ $data->onEachSide(2)->links() }}
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
