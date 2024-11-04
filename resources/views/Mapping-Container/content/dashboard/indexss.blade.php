@extends('Mapping-Container.layout.main')
@section('title')
    Shipment
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container-xxl">
    <h3 class="title text-center">DATA SHIPMENT</h3>
    <div ><a href="{{route('Mapping.admin.input-excel')}}" class="btn btn-primary text-end mb-3">Buat Shipment</a></div>
<div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th style="color: black" class="text-truncate">No</th>
              <th style="color: black" class="text-truncate">No GS</th>
              <th style="color: black" class="text-truncate">Tanggal GS</th>
              <th style="color: black" class="text-truncate">No PO</th>
              <th style="color: black" class="text-truncate">No Seal</th>
              <th style="color: black" class="text-truncate">No Mobil</th>
              <th style="color: black" class="text-truncate">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $c)
  
            <tr>
              <td style="color: black">{{$loop->iteration}}</td>
              <td style="color: black">{{$c->no_gs}}</td>
              <td style="color: black" class="text-truncate">{{$c->tgl_gs}}</td>
              <td style="color: black" class="text-truncate">{{$c->no_po}}</td>
              <td style="color: black" class="text-truncate">{{$c->no_seal}}</td>
              <td style="color: black" class="text-truncate">{{$c->no_mobil}}</td>
              <td>
                 <a href="{{route('Mapping.admin.coiling',$c->no_gs)}}" class="btn btn-success">Koil</a>
                 <a href="{{route('Mapping.admin.show-shipment',$c->id)}}" class="btn btn-primary"><i class="ri-eye-line"></i></a>
                 <a href="{{route('Mapping.admin.delete-shipment',$c->no_gs)}}" class="btn btn-danger"><i class="ri-delete-bin-2-line"></i></a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

@endsection