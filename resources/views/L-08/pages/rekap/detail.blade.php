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
   

    <div class="card">
        <div class="card-body">
          <p class="fw-bold ">No SO : {{$so}}</p>
          <form action="{{ route('L-08.admin.rekap.detail', $so) }}" method="GET">
            <input type="text" name="search" placeholder="Search by Attribute" value="{{ request()->search }}">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Packing</th>
                <th>Layout</th>
                <th>SO</th>
                <th>Attribute</th>
                <th>Description</th>
                <th>Net</th>
                <th>Gros</th>
                <th>Length</th>
                <th>Stuffing</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
                
              <tr>
                <td class="align-middle">{{$loop->iteration}}</td>
                <td class="align-middle">
                    @if ($d->packing == 'YES')
                    <p class="text-success btn" >
                        {{$d->packing}}</td>
                    </p>
                    @endif
                <td class="align-middle">{{$d->layout}}</td>
                <td class="align-middle">{{$d->no_so}}</td>
                <td class="align-middle">{{$d->attribute}}</td>
                <td class="align-middle">{{$d->desc}}</td>
                <td class="align-middle">{{$d->net}}</td>
                <td class="align-middle">{{$d->gross}}</td>
                <td class="align-middle">{{$d->length}}</td>
                <td class="align-middle">{{$d->type}}</td>
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