@extends('Form-Check.layout.main')
@section('title')
    Form Crane
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
          </span> Form Crane
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
            <a href="{{ Auth::user()->role == 0 ? route('Form-Check.admin.crane.add') : route('Form-Check.pegawai.crane.add') }}" 
               class="badge badge-gradient-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
            <a href="{{ route('Form-Check.admin.crane.export') }}" 
               class="badge badge-gradient-success" style="text-decoration: none; font-size: 15px">Export Excel</a>
        </div>
    
        <form action="{{ route('Form-Check.admin.crane') }}" method="GET" class="ml-2" style="display: inline;">
            <input type="text" name="search" placeholder="Search here" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <input type="hidden" name="direction" value="{{ $direction }}">
            <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                <label class="badge badge-gradient-danger" style="text-decoration: none;">Search</label>
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
                                    <th>No</th>
                                    <th>
                                        <a href="{{ route('Form-Check.admin.crane', ['sort' => 'jenis_crane', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                                            Jenis Crane<i class="fa-solid fa-arrows-up-down"></i>
                                            @if ($sort === 'jenis_crane')
                                                <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('Form-Check.admin.crane', ['sort' => 'shift', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                                            Shift<i class="fa-solid fa-arrows-up-down"></i>
                                            @if ($sort === 'shift')
                                                <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Responden</th>
                                    <th>
                                        <a href="{{ route('Form-Check.admin.crane', ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => $searchTerm]) }}">
                                            Date<i class="fa-solid fa-arrows-up-down"></i>
                                            @if ($sort === 'date')
                                                <i class="fa fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-truncate">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                        <td>{{ $d->jenis_crane }}</td>
                                        <td>{{ $d->shift }}</td>
                                        <td>{{ $d->user->name ?? 'Unknown' }}</td> <!-- Assuming you set up a relationship -->
                                        <td>{{ $d->date }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if (Auth::user()->role == 0)
                                                    <a href="{{ route('Form-Check.admin.crane.print', $d->id) }}" class="badge badge-gradient-success mr-2">Print</a>
                                                    <form action="{{ route('Form-Check.admin.crane.destroy', $d->id) }}" method="POST" class="ml-2" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="badge badge-gradient-danger" >
                                                          <label for="" style="border: none; padding: 0; cursor: pointer;">Hapus</label>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('Form-Check.pegawai.crane.print', $d->id) }}" class="badge badge-gradient-success">Print</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        {{ $data->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    </div>
</div>
@endsection
