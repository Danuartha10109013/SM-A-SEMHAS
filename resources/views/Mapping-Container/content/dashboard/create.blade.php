@extends('Mapping-Container.layout.main')

@section('title')
    Form Shipment
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container">
    <h1>Tambah Pengecekan</h1>

    <form action="{{ route('Mapping.admin.store-shipment') }}" method="POST">
        @csrf

        <!-- Contoh Input -->
        <div class="mb-3">
            <label for="no_gs" class="form-label"><b>No GS</b></label>
            <input type="text" placeholder="Input No GS" class="form-control" id="no_gs" name="no_gs" value="{{ $gs }}" readonly    >
        </div>

        <div class="mb-3">
            <label for="tgl_gs" class="form-label"><b>Tanggal GS</b></label>
            <input type="date" class="form-control" placeholder="Input Tanggal" id="tgl_gs" name="tgl_gs" value="{{ old('tgl_gs') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_container" class="form-label"><b>No Container</b></label>
            <input type="text" class="form-control" id="no_container" placeholder="Input No Container" name="no_container" value="{{ old('no_container') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_mobil" class="form-label"><b>No Mobil</b></label>
            <input type="text" class="form-control" id="no_mobil" placeholder="Input No Mobil" name="no_mobil" value="{{ old('no_mobil') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_mobil" class="form-label"><b>Tare</b></label>
            <input type="text" class="form-control" id="tare" placeholder="Input No Mobil" name="tare" value="{{ old('no_mobil') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="Kepada" class="form-label"><b>Customer</b></label>
            <input type="text" class="form-control" id="Kepada" placeholder="Input Kepada" name="kepada" value="{{ old('kepada') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

