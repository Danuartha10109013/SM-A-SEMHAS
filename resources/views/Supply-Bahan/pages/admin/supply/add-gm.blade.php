@extends('Supply-Bahan.layout.main')

@section('title')
    Tambahkan GM ||
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
    <h3 class="text-center mb-4">Create A Product</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Open-Packing.admin.packing.store.gm') }}" method="POST">
        @else
        <form action="{{ route('Open-Packing.pegawai.packing.store') }}" method="POST">
        @endif
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="atribute" class="form-label">No. GM</label>
                <input type="text" name="gm" id="atribute" class="form-control" value="{{$gm}}" readonly>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Atribute</label>
                  <input type="text" name="attribute" id="atribute" class="form-control"  >
                </div>
                <div class="mb-3">
                  <label for="atribute" class="form-label">Berat Label</label>
                  <input type="number" name="b_label" id="aktual" class="form-control"  >
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Stiker</label>
                  <input type="text" name="stiker" id="aktual" class="form-control"  >
                </div>
                <div class="mb-3">
                  <label for="atribute" class="form-label">Berat Aktual</label>
                  <input type="number" name="b_aktual" id="atribute" class="form-control"  >
                </div>
              </div>
            </div>
            
            <div class="mb-3">
              <label for="atribute" class="form-label">Keterangan</label>
              <input type="text" name="keterangan" id="aktual" class="form-control"  >
            </div>
            

            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>
@endsection