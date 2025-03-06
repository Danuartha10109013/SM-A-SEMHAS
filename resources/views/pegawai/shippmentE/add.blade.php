@extends('layout.pegawai.main')
@section('title')
Shippment || Pegawai 
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Shippment E</h1>

        <div class="card shadow p-4">
            @if (Auth::user()->role == 0)
            <form action="{{ route('Ship-Mark.admin.shipment-e-store') }}" method="POST">
            @else
            <form action="{{ route('Ship-Mark.pegawai.shipment-e-store') }}" method="POST">
            @endif
                @csrf
                <div class="mb-3">
                    <label for="manufactur" class="form-label">Attribute</label>
                    <input type="text" name="attribute" id="manufactur" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="atribute" class="form-label">No SO</label>
                    <input type="text" name="no_so" id="atribute" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="size" class="form-label">Name</label>
                    <input type="text" name="name" id="size" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Product</label>
                    <input type="text" name="product" id="size" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="destination" class="form-label">POD</label>
                    <input type="text" name="pod" id="destination" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Weight</label>
                    <input type="text" name="weight" id="type" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="satuan_berat" class="form-label">Satuan Berat</label>
                    <select class="form-control" name="satuan_berat" id="satuan_berat" required>
                        <option disabled selected value="" >--Pilih Satuan Berat--</option>
                        <option value="KGS" >KGS</option>
                        <option value="LBS" >LBS</option>
                        <option value="MT">MT</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save New Shiping Mark</button>
            </form>
        </div>
    </div>
@endsection
