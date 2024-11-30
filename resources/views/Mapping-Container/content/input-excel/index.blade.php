@extends('Mapping-Container.layout.main')

@section('title')
    Input excel ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container-xxl mt-4">
    <h3  class="title text-center mb-4">Upload Data Shipment</h3>

    <div style="box-shadow: 15px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 style="color: white" class="mb-0">Upload File Excel</h5>
                </div>
                <p>Template untuk Data Shipment. <a href="{{route('download.file','SHIP_Template.xlsx')}}">Klik disini untuk download</a></p>
                <div class="card-body">
                    <form id="uploadForm" action="{{ route('Mapping.admin.upload-excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="excel" class="form-label">Input File</label>
                            <input type="file" accept=".xlsx, .csv, .xls" name="excel" id="excel" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-xxl mt-4">
    <h3  class="title text-center mb-4">Upload Data Koil</h3>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 style="color: white" class="mb-0">Upload File Excel</h5>
                </div>
                <p>Template untuk Data COIL. <a href="{{route('download.file','COIL.xlsx')}}">Klik disini untuk download</a></p>

                <div class="card-body">
                    <form id="uploadForm" action="{{ route('Mapping.admin.upload-koil-excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="excel" class="form-label">Input File</label>
                            <input type="file" accept=".xlsx, .csv, .xls" name="pegawaiexcel" id="excel" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
