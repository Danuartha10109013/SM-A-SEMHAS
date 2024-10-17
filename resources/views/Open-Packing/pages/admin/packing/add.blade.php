@extends('Open-Packing.layout.main')
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
    <h3 class="text-center mb-4">Make a New GM</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Open-Packing.admin.packing.store') }}" method="POST">
        @else
        <form action="{{ route('Open-Packing.pegawai.packing.store') }}" method="POST">
        @endif
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="atribute" class="form-label">No. GM</label>
                <input type="text" name="gm" id="atribute" class="form-control" required>
            </div>

            

            <button type="submit" class="btn btn-primary w-100">Save New GM</button>
        </form>
    </div>
</div>
@endsection