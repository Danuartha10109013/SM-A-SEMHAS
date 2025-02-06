@extends('layout.pegawai.main')
@section('title')
Shippment || Pegawai 
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Shippment A</h1>

        <div class="card shadow p-4">
            @if (Auth::user()->id == 0)
            <form action="{{ route('Ship-Mark.admin.shipment-a-store') }}" method="POST">
            @else
            <form action="{{ route('Ship-Mark.pegawai.shipment-a-store') }}" method="POST">
            @endif
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="atribute" class="form-label">Atribute</label>
                    <input type="text" name="atribute" id="atribute" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="unicode" class="form-label">Unicode</label>
                    <input type="text" name="unicode" id="unicode" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" name="size" id="size" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight</label>
                    <input type="text" name="weight" id="weight" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="satuan_berat" class="form-label">Satuan Berat</label>
                    <select class="form-control" name="satuan_berat" id="">
                        <option value="kgs">kgs</option>
                        <option value="lbs">lbs</option>
                        <option value="mt">mt</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">No SO</label>
                    <input type="text" name="type" id="type" class="form-control" >
                </div>

                <button type="submit" class="btn btn-primary w-100">Save New Shiping Mark</button>
            </form>
        </div>
    </div>
@endsection
