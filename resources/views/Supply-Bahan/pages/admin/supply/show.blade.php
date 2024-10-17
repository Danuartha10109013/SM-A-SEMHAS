@extends('Supply-Bahan.layout.main')

@section('title')
    Open Packing ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Supply Bahan Pendukung</h4>
          <h5 class="card-title">
            @php
            $date = \Carbon\Carbon::parse($data->created_at)->format('d/m/Y');
            @endphp
            {{$date}}
          </h5>
              <p>Shift Leader Yang Bertugas : {{$data->shift_leader}}</p>
              <p>Supply : {{$data->shift}}</p>
              <p>Supply : {{$data->supply}}</p>
              <div class="d-flex justify-content-between align-items-center mb-3">
                @php
                    $images = json_decode($data->foto); // Decode the JSON array into a PHP array
                @endphp
                
                @if ($images)
                    @foreach ($images as $image)
                        <img src="{{ asset('storage/supply/' . $image) }}" alt="Image" class="img-thumbnail" width="20%">
                    @endforeach
                @else
                    <p>No images available.</p>
                @endif
              </div>
            
         
          
        </div>
      </div>
    </div>
  </div>
@endsection