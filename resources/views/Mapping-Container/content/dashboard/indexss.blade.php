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
    <div class="mb-3 d-flex justify-content-between align-items-center">
      <!-- Left: Form -->
      <a href="{{ route('Mapping.admin.input-excel') }}" class="btn btn-primary">Buat Shipment</a>
      <form action="{{ route('Mapping.admin.shipment') }}" method="GET" class="d-flex align-items-center">
          <input type="date" name="start" value="{{ request('start') }}" placeholder="Start Date" class="form-control me-2">
          <input type="date" name="end" value="{{ request('end') }}" placeholder="End Date" class="form-control me-2">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by No GS" class="form-control me-2">
          <button type="submit" class="btn btn-primary">Search</button>
      </form>
  
      <!-- Right: Button -->
  </div>
  
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
                @if ($c->tare == null || $c->no_container == null || $c->tgl_gs == null || $c->no_mobil == null || $c->kepada == null)
                <a href="{{route('Mapping.admin.create-shipment',$c->no_gs)}}" class="btn btn-secondary">Lengkapi Data</a>
                @endif
                <a href="{{route('Mapping.admin.coiling',$c->no_gs)}}" class="btn btn-success">Koil</a>
                <a href="{{route('Mapping.admin.show-shipment',$c->id)}}" class="btn btn-primary"><i class="ri-eye-line"></i> Mapping</a>
                <!-- Tombol Delete -->
                <button class="btn btn-danger btn-delete" data-url="{{ route('Mapping.admin.delete-shipment', $c->no_gs) }}">
                  <i class="ri-delete-bin-2-line"></i>
                </button>
                <script>
                  document.addEventListener('DOMContentLoaded', function () {
                      document.querySelectorAll('.btn-delete').forEach(function (button) {
                          button.addEventListener('click', function () {
                              const url = this.getAttribute('data-url');
                  
                              Swal.fire({
                                  title: 'Yakin ingin menghapus?',
                                  text: "Data yang dihapus tidak dapat dikembalikan!",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#d33',
                                  cancelButtonColor: '#3085d6',
                                  confirmButtonText: 'Ya, hapus!',
                                  cancelButtonText: 'Batal'
                              }).then((result) => {
                                  if (result.isConfirmed) {
                                      window.location.href = url;
                                  }
                              });
                          });
                      });
                  });
                  </script>
                       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       
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