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
      @if (Auth::user()->role == 0)
        <form action="{{ route('L-08.admin.rekap') }}" method="GET" class="d-flex">
      @else
        <form action="{{ route('L-08.pegawai.rekap') }}" method="GET" class="d-flex">
      @endif
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
                            <input type="file" class="form-control" id="excelFile" name="excel" >
                        </div>
                        <div class="mb-3">
                            <label for="excelFile" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control" id="excelFile" name="keterangan"></textarea>
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

    <p>Download template untuk acuan penambahan data <a href="{{route('download.file','Template Rekap Kontainer.xlsx')}}">Klik Disini</a></p>

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
                <td>@php
                  // Get the count of grouped 'no_so' where 'packing' is 'YES'
                $countdone = \App\Models\RekapM::select('no_so', $d->no_so)
                    ->groupBy('no_so')
                    ->where('packing', 'YES')
                    ->count();
                @endphp
                {{$countdone}}</td>
                <td>{{$countall}}</td>
                <td>
                  @if (Auth::user()->role == 0)
                    <a href="{{route('L-08.admin.rekap.detail',$d->no_so)}}" class="btn btn-success">Detail</a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $d->no_so }}">
                        Delete
                      </button>
                    @else
                    <a href="{{route('L-08.pegawai.rekap.detail',$d->no_so)}}" class="btn btn-success">Detail</a>
                    @endif

                    <div class="modal fade" id="deleteModal-{{ $d->no_so }}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $d->no_so }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel-{{ $d->no_so }}">Confirm Delete</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  Are you sure you want to delete this record?
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <a href="{{ route('L-08.admin.rekap.delete', $d->no_so) }}" class="btn btn-danger">Delete</a>
                              </div>
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
@endsection