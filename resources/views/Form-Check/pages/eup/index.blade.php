@extends('Form-Check.layout.main')
@section('title')
    Form EUP
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
          </span> Form Material EUP
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
            <a href="{{ Auth::user()->role == 0 ? route('Form-Check.admin.eup.add') : route('Form-Check.pegawai.eup.add') }}" 
               class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
            <a href="{{ route('Form-Check.admin.forklift.export') }}" 
               class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a>
        </div>
    
        <form action="{{ route('Form-Check.admin.eup') }}" method="GET" class="ml-2" style="display: inline;">
            <input type="text" name="search" placeholder="Search By Responden" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <input type="hidden" name="direction" value="{{ $direction }}">
            <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                <label class="btn btn-danger" style="text-decoration: none;">Search</label>
            </button>
        </form>
    </div>
      
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
                        <th> <a href="{{ route('Form-Check.admin.eup', ['sort' => 'jenis', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                          Jenis<i class="fa-solid fa-arrows-up-down"></i>
                          @if ($sort === 'jenis')
                              <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                          @endif
                      </a> </th>
                        <th> Responden </th>
                        <th> 
                          <a href="{{ route('Form-Check.admin.eup', ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
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
                        <td>
                            {{$d->jenis }}
                        </td>
                      
                        <td>
                            @php
                                $nama = \App\Models\User::where('id', $d->user_id)->value('name');
                            @endphp
                            {{ $nama }}
                        </td>
                        <td>{{ $d->date }}</td>

                        
                        <td>
                          @if (Auth::user()->role == 0)
                          <a href="{{route('Form-Check.admin.eup.show', $d->id)}}"> <label class="btn btn-primary">detail</label></a>
                           <a href="{{route('Form-Check.admin.eup.print', $d->id)}}"> <label class="btn btn-success">print</label></a>
                           <form action="{{ route('Form-Check.admin.eup.destroy', $d->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                          @else
                           <a href="{{route('Form-Check.pegawai.eup.show', $d->id)}}"> <label class="btn btn-primary">detail</label></a>
                          @endif
                          </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <!-- Pagination Links -->
                  {{ $data->links() }}
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
