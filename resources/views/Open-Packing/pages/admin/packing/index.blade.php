@extends('Open-Packing.layout.main')
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
          <h4 class="card-title">Perintah Open Packing</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Open-Packing.admin.packing.add') : route('Open-Packing.pegawai.packing.add') }}" 
                   class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan GM</a>
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
            </div>
        
            {{-- <form action="{{ route('Form-Check.admin.crane') }}" method="GET" class="ml-2" style="display: inline;">
                <input type="text" name="search" placeholder="Search By Responden" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="direction" value="{{ $direction }}">
                <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                    <label class="btn btn-danger" style="text-decoration: none;">Search</label>
                </button>
            </form> --}}
        </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> No </th>
                  <th> No GM </th>
                  <th> Action </th>
                  <th> Total </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->gm}} </td>
                    <td><a href="{{route('Open-Packing.admin.packing.add.gm',$d->gm)}}">
                      <label class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.show',$d->gm)}}">
                      <label class="btn btn-success">
                        <i class="fas fa-eye"></i> Show
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.print',$d->gm)}}">
                      <label class="btn btn-warning">
                        <i class="fas fa-print"></i> Print
                      </label></a>
                    </td>
                    <td>
                      @php
                        $total = \App\Models\PackingM::where('gm',$d->gm)->count();
                      @endphp
                      
                      {{$total}} </td>

                    
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection