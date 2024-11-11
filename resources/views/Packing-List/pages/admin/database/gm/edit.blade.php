@extends('Packing-List.layout.main')


@section('title')
    Edit Database GM ||
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
    <h2>Edit Product: {{ $data->nama_produk }}</h2>

    <form action="{{ route('Packing-List.admin.gm.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode">Kode:</label>
            <input type="text" class="form-control" id="kode" name="kode" value="{{ $data->kode }}" required>
        </div>

        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $data->nama_produk }}" required>
        </div>

        <div class="form-group">
            <label for="qty">QTY:</label>
            <input type="text" class="form-control" id="qty" name="qty" value="{{ $data->qty }}" required>
        </div>

        <div class="form-group">
            <label for="uom">UOM:</label>
            <input type="text" class="form-control" id="uom" name="uom" value="{{ $data->uom }}" required>
        </div>

        <div class="form-group">
            <label for="attribute">No Coil:</label>
            <input type="text" class="form-control" id="attribute" name="attribute" value="{{ $data->attribute }}" required>
        </div>
        <div class="form-group">
            <label for="panjang">Panjang:</label>
            <input type="text" class="form-control" id="panjang" name="panjang" value="{{ $data->panjang }}" required>
        </div>

        <div class="form-group">
            <label for="storage_bin">Storage Bin:</label>
            <input type="text" class="form-control" id="storage_bin" name="storage_bin" value="{{ $data->storage_bin }}" required>
        </div>

        <div class="form-group">
            <label for="date">Tanggal:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $data->date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('Packing-List.admin.database') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
