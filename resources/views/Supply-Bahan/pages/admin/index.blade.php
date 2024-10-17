@extends('Supply-Bahan.layout.main')
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
<div class="row">
    <div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total GM <i class="mdi mdi-chart-line mdi-24px float-end"></i>
              </h4>
              <h2 class="mb-5">{{$gm}}</h2>
              <h6 class="card-text">......</h6>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Product <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
              </h4>
              <h2 class="mb-5">{{$form}}</h2>
              <h6 class="card-text">......</h6>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Start Date <i class="mdi mdi-diamond mdi-24px float-end"></i>
              </h4>
              
              <h2 class="mb-5">{{$response}}</h2>
              <h6 class="card-text">TML</h6>
            </div>
          </div>
        </div>
      </div>

      
    </div>
    


    </div>
</div>
@endsection