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
<div class="container-xxl">
    <h3 class="title text-center">Tambah Data Koil</h3>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Mapping.admin.koil.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="no_gs" class="col-sm-2 col-form-label">No_GS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_gs" name="no_gs" value="{{$same}} " readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_produk" name="kode_produk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="berat_produk" class="col-sm-2 col-form-label">Berat Produk (mm)</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="berat_produk" name="berat_produk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="diameter_produk" class="col-sm-2 col-form-label">Diameter Produk (mm)</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="diameter_produk" name="diameter_produk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lebar_produk" class="col-sm-2 col-form-label">Lebar Produk (mm)</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="lebar_produk" name="lebar_produk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="keterangan" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
