@extends('Packing-List.layout.main')


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
          <h5 class="card-title">22665</h5>
            <p>No GM : {{$gm}}</p>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Open-Packing.admin.packing.add.gm',$gm) : route('Open-Packing.pegawai.packing.add') }}" 
                   class="badge badge-gradient-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan Product</a>
                <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="badge badge-gradient-success" style="text-decoration: none; font-size: 15px">Export Excel</a>
            </div>
        
            {{-- <form action="{{ route('Form-Check.admin.crane') }}" method="GET" class="ml-2" style="display: inline;">
                <input type="text" name="search" placeholder="Search By Responden" class="form-control d-inline" style="width: auto; display: inline;" value="{{ $searchTerm }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="direction" value="{{ $direction }}">
                <button style="border: none; padding: 0; cursor: pointer;" type="submit"> 
                    <label class="badge badge-gradient-danger" style="text-decoration: none;">Search</label>
                </button>
            </form> --}}
        </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Atribute / Batch </th>
                  <th> Berat Label </th>
                  <th> Berat Aktual </th>
                  <th> Selisih </th>
                  <th> Persentase </th>
                  <th> Stiker </th>
                  <th> Keterangan </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->attribute}} </td>
                    <td> {{$d->b_label}} </td>
                    <td> {{$d->b_aktual}} </td>
                    <td> {{$d->selisih}} </td>
                    <td> {{$d->persentase}} </td>
                    <td> {{$d->stiker}} </td>
                    <td> {{$d->keterangan}} </td>
                    <td><a href="{{route('Open-Packing.admin.packing.edit',$d->id)}}">
                      <label class="badge badge-gradient-primary">
                        <i class="fas fa-edit"></i> 
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.delete',$d->id)}}">
                      <label class="badge badge-gradient-danger">
                        <i class="fas fa-trash"></i>
                      </label></a>
                      
                    </td>
                    
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