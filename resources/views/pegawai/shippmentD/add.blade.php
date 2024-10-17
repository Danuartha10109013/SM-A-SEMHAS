@extends('layout.pegawai.main')
@section('title')
Shippment || Pegawai 
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Shippment D</h1>

        <div class="card shadow p-4">
            @if (Auth::user()->role == 0)
            <form action="{{ route('Ship-Mark.admin.shipment-d-store') }}" method="POST">
            @else
            <form action="{{ route('Ship-Mark.pegawai.shipment-d-store') }}" method="POST">
            @endif
                @csrf
                <div class="mb-3">
                    <label for="manufactur" class="form-label">Unicode</label>
                    <input type="text" name="unicode" id="manufactur" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="atribute" class="form-label">Atribute</label>
                    <input type="text" name="atribute" id="atribute" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" name="size" id="size" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">No SO</label>
                    <input type="text" name="type" id="type" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save New Shiping Mark</button>
            </form>
        </div>
    </div>
@endsection
