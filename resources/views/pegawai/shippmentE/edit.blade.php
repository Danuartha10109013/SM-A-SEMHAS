@extends('layout.pegawai.main')
@section('title')
@if (Auth::user()->role == 0)
Edit Shippment E || Admin 
@else
Edit Shippment E || Pegawai 
@endif
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Shippment E</h1>

        <div class="card shadow p-4">
            @if (Auth::user()->role == 0)
            <form action="{{ route('Ship-Mark.admin.shipment-e-update', $shippmentA->id) }}" method="POST">
            @else
            <form action="{{ route('Ship-Mark.pegawai.shipment-e-update', $shippmentA->id) }}" method="POST">
            @endif
                @csrf
                @method('PUT') <!-- This is used to specify that this request should be treated as PUT -->

                <div class="mb-3">
                    <label for="atribute" class="form-label">Atribute</label>
                    <input type="text" name="attribute" id="attribute" class="form-control" value="{{ $shippmentA->attribute }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="product" class="form-label">Name</label>
                    <input type="text" name="name" id="product" class="form-control" value="{{ $shippmentA->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label">POD</label>
                    <input type="text" name="pod" id="size" class="form-control" value="{{ $shippmentA->pod }}" required>
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Net/Weight</label>
                    <input type="text" name="weight" id="destination" class="form-control" value="{{ $shippmentA->weight }}" required>
                </div>
                <div class="mb-3">
                    <label for="satuan_berat" class="form-label">Satuan Berat</label>
                    <select class="form-control" name="satuan_berat" id="satuan_berat" required>
                        <option value="KG" {{ $shippmentA->satuan_berat == 'KGS' ? 'selected' : '' }}>KGS</option>
                        <option value="LBS" {{ $shippmentA->satuan_berat == 'LBS' ? 'selected' : '' }}>LBS</option>
                        <option value="MT" {{ $shippmentA->satuan_berat == 'MT' ? 'selected' : '' }}>MT</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">No SO</label>
                    <input type="text" name="no_so" id="type" class="form-control" value="{{ $shippmentA->no_so }}" >
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Shippment</button>
            </form>
        </div>
    </div>
@endsection
