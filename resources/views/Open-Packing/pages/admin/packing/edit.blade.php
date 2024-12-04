@extends('Open-Packing.layout.main')
@section('title')
    Edit Product ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Edit A Product</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Open-Packing.admin.packing.update') }}" method="PUT">
        @else
        <form action="{{ route('Open-Packing.pegawai.packing.store') }}" method="PUT">
        @endif
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="text" name="id" id="atribute" class="form-control" value="{{$data->id}}" hidden>
                <input type="text" name="scanner" id="scanner" class="form-control" value="{{Auth::user()->id}}" hidden>
            </div>
            <div class="mb-3">
                <label for="atribute" class="form-label">No. GM</label>
                <input type="text" name="gm" id="atribute" class="form-control" value="{{$data->gm}}" readonly>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Atribute</label>
                  <input type="text" name="attribute" id="atribute" class="form-control" value="{{$data->attribute}}" >
                </div>
                <div class="mb-3">
                  <label for="atribute" class="form-label">Berat Label</label>
                  <input type="number" name="b_label" id="aktual" class="form-control" value="{{$data->b_label}}"  >
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Keterangan</label>
                  <input type="text" name="keterangan" id="aktual" class="form-control" value="{{$data->keterangan}}" >
                </div>
                <div class="mb-3">
                  <label for="atribute" class="form-label">Berat Aktual</label>
                  <input type="number" name="b_aktual" id="atribute" class="form-control" value="{{$data->b_aktual}}"  >
                </div>
              </div>
            </div>
            
            
            

            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>
@endsection