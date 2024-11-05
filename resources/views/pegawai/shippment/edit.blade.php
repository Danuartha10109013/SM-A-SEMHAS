@extends('layout.pegawai.main')
@section('title')
@if (Auth::user()->role == 0)
Edit Shippment A || Admin 
@else
Edit Shippment A || Pegawai 
@endif
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Shippment A</h1>

        <div class="card shadow p-4">
            @if (Auth::user()->role == 0)
            <form action="{{ route('Ship-Mark.admin.shipment-a-update', $shippmentA->id) }}" method="POST">
            @else
            <form action="{{ route('Ship-Mark.pegawai.shipment-a-update', $shippmentA->id) }}" method="POST">
            @endif
               @csrf
                @method('PUT') <!-- This is used to specify that this request should be treated as PUT -->
                
                <div class="mb-3">
                    <label for="atribute" class="form-label">Atribute</label>
                    <input type="text" name="atribute" id="atribute" class="form-control" value="{{ $shippmentA->atribute }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="unicode" class="form-label">Unicode</label>
                    <input type="text" name="unicode" id="unicode" class="form-control" value="{{ $shippmentA->unicode }}" required>
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" name="size" id="size" class="form-control" value="{{ $shippmentA->size }}" required>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight</label>
                    <input type="number" name="weight" id="weight" class="form-control" value="{{ $shippmentA->weight }}" required>
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
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" value="{{ $shippmentA->destination }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ $shippmentA->type }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Shippment</button>
            </form>
        </div>
    </div>
@endsection
