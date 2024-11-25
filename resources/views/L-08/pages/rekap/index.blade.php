@extends('L-08.layout.main')
@section('title')
    Packing L-08 ||
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
        </span> Rekap Packing
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <!-- Button to trigger modal -->
    <div class="d-flex justify-content-between mb-3">
      <!-- "Add New" button on the left -->
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">Add New</a>
  
      <!-- Search form on the right -->
      <form action="{{ route('L-08.admin.rekap') }}" method="GET" class="d-flex">
          <input type="text" name="search" value="{{ $search }}" style="background-color: white" class="form-control me-2" placeholder="Search">
          <button type="submit" class="btn btn-secondary">
              <i class="fa fa-search"></i>
          </button>
      </form>
  </div>
  
  
    <!-- Modal Structure -->
    <div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadExcelModalLabel">Upload Excel File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('L-08.admin.rekap.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="excelFile" class="form-label">Select Excel File</label>
                            <input type="file" class="form-control" id="excelFile" name="excel" accept=".xlsx, .xls">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
      <p class="fw-bold mt-3 ml-3">Acuan Table</p>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>No SO</th>
                <th>Total Done</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
                
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->no_so}}</td>
                <td>{{$countdone}}</td>
                <td>{{$countall}}</td>
                <td>
                  <a href="{{route('L-08.admin.rekap.detail',$d->no_so)}}" class="btn btn-success">Detail</a>
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