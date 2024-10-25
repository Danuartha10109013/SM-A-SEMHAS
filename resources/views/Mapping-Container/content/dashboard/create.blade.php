@extends('Mapping-Container.layout.main')

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
<div class="container">
    <h1>Tambah Pengecekan</h1>

    <form action="{{ route('store-shipment') }}" method="POST">
        @csrf

        <!-- Contoh Input -->
        <div class="mb-3">
            <label for="no_gs" class="form-label"><b>No GS</b></label>
            <input type="text" placeholder="Input No GS" class="form-control" id="no_gs" name="no_gs" value="{{ old('no_gs') }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_gs" class="form-label"><b>Tanggal GS</b></label>
            <input type="date" class="form-control" placeholder="Input Tanggal" id="tgl_gs" name="tgl_gs" value="{{ old('tgl_gs') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_so" class="form-label"><b>No SO </b></label>
            <input type="text" class="form-control" id="no_so" placeholder="Input No SO" name="no_so" value="{{ old('no_so') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_po" class="form-label"><b>No PO </b></label>
            <input type="text" class="form-control" id="no_po" placeholder="Input No PO" name="no_po" value="{{ old('no_po') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="no_do" class="form-label"><b>No DO</b></label>
            <input type="text" class="form-control" id="no_do" placeholder="Input No DO" name="no_do" value="{{ old('no_do') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_container" class="form-label"><b>No Container</b></label>
            <input type="text" class="form-control" id="no_container" placeholder="Input No Container" name="no_container" value="{{ old('no_container') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_seal" class="form-label"><b>No Seal</b></label>
            <input type="text" class="form-control" id="no_seal" placeholder="Input No Seal" name="no_seal" value="{{ old('no_seal') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_mobil" class="form-label"><b>No Mobil</b></label>
            <input type="text" class="form-control" id="no_mobil" placeholder="Input No Mobil" name="no_mobil" value="{{ old('no_mobil') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="forwarding" class="form-label"><b>Forwarding</b></label>
            <input type="text" class="form-control" id="forwarding" placeholder="Input Forwarding" name="forwarding" value="{{ old('forwarding') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="Kepada" class="form-label"><b>Kepada</b></label>
            <input type="text" class="form-control" id="Kepada" placeholder="Input Kepada" name="Kepada" value="{{ old('Kepada') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat_pengirim" class="form-label"><b>Alamat Pengirim</b></label>
            <input type="text" class="form-control" id="alamat_pengirim" placeholder="Input Alamat Pengirim" name="alamat_pengirim" value="{{ old('alamat_pengirim') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat_tujuan" class="form-label"><b>Alamat Tujuan</b></label>
            <input type="text" class="form-control" id="alamat_tujuan" placeholder="Input Alamat Tujuan" name="alamat_tujuan" value="{{ old('alamat_tujuan') }}" required>
        </div>
        <!-- Tambahkan input sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

