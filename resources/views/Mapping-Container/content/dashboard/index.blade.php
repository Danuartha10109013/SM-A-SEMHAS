@extends('Mapping-Container.layout.main')

@section('title')
    Shippment ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl">
    <div class="kop">
      <div class="row">
        <div class="col-md-2">
          <span class="text-center"  style="color: var(--bs-primary)">
            <svg version="1.1" viewBox="0 0 2048 1401" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                <path transform="translate(995,162)" d="m0 0h82l39 2 44 4 44 6 40 7 40 9 44 12 42 13 32 11 26 11 40 18 41 18 20 8 27 14 23 14 17 11 15 10 16 11 17 12 18 13 19 14 21 16 17 13 13 11 28 24 16 11v3l-7 6-49 17-49 18-32 13-25 12-24 13-23 14-41 26-20 12-7 4-5 5-10 8-17 12-17 13-11 9-13 12-8 8-8 7-12 13-9 9-7 8-9 10-9 11-11 13-13 17-15 20-16 23-16 25-12 20-12 21-17 32-13 27-13 30-14 36-12 36-10 35-7 29-8 54-5 21-5 12-1 84-12 2-54 2-78 1h-57l-55-1-16-1-2-1-2-11v-60l-3-21-7-38-7-37-10-42-11-37-12-36-11-28-12-28-17-36-12-22-11-20-14-23-20-30-10-14-14-19-13-16-9-11-13-15-12-13-11-12-25-25-8-7-13-12-11-9-14-12-10-8-22-18-8-6-13-8-17-12-19-12-19-11-24-13-36-18-36-16-30-12-67-20-8-4-1-4 6-8 11-9 10-9 11-9 11-10 11-9 16-13 19-14 18-13 17-12 23-16 20-13 22-14 27-16 27-14 14-6 16-4 10-7 19-10 36-15 37-14 34-12 36-11 38-10 42-9 40-7 46-6 42-4 33-2zm-3 274-44 3-44 5-41 7-29 7-9 3 3 5 16 17 11 12 28 28 7 8 13 15 10 13 14 18 12 15 27 36 16 23 11 17 13 21 13 23 7 12 5-1 8-16 13-23 14-24 9-14 12-17 14-19 16-21 9-12 11-14 11-13 9-11 9-10 9-11 21-21 8-7 25-25-1-3-12-5-24-6-37-6-45-5-38-3-18-1z" fill="#B4B261"/>
                <path transform="translate(996)" d="m0 0h55l59 2 46 3 50 5 45 6 47 8 47 10 48 12 41 12 40 13 49 18 46 19 29 13 28 13 25 12 23 13 19 11 25 16 22 15 32 22 14 10 12 9 14 11 15 13 12 12 8 7 14 12 16 15 12 13 9 11 14 17 12 15 15 20 13 18 13 20 12 20 13 24 12 25 11 27 14 41 10 38 6 29 3 23 2 27v35l-3 37-5 33-7 31-8 29-11 32-12 29-14 30-13 24-12 20-18 27-13 18-13 16-8 10-12 14-12 13-14 15-14 14-8 7-7 7-8 7-14 12-13 11-30 23-18 13-33 22-19 12-24 14-25 14-29 15-24 12-36 16-36 15-29 11-37 13-34 11-46 13-44 11-47 10-45 8-50 7-47 5-44 3-50 2h-76l-49-2-54-4-54-6-47-7-45-8-50-11-47-12-44-13-53-18-39-15-35-15-26-12-25-12-35-18-39-22-21-13-18-12-17-12-21-16-14-11-22-18-13-11-11-9-29-29-7-8-12-12-7-6-7-8-11-12-11-14-10-13-14-20-11-17-15-25-10-18-10-19-13-29-10-26-10-30-8-31-6-31-4-30-2-30v-33l2-30 4-30 7-36 10-36 9-26 11-27 14-30 14-26 14-23 13-19 14-19 13-16 9-11 11-13 9-11 13-15 19-19 8-7 30-27 12-9 16-13 25-20 41-27 21-13 29-17 29-16 35-18 36-17 30-13 35-14 41-15 46-15 39-11 52-13 55-11 45-7 50-6 51-4 45-2zm-22 65-40 2-48 4-50 6-45 7-42 8-43 10-42 11-42 13-35 12-36 14-35 15-34 16-29 15-23 13-25 15-33 22-20 14-16 12-13 10-16 13-13 11-14 12-16 15-32 32-7 8-13 15-13 16-14 19-18 27-9 15-10 18-13 26-13 32-11 34-7 29-6 35-3 32v58l3 32 5 30 7 30 9 29 11 29 13 28 12 23 14 23 12 18 13 18 11 14 9 11 13 15 14 15 32 32 8 7 15 13 17 14 13 10 19 14 20 14 20 13 21 13 26 15 28 15 32 16 36 16 37 15 30 11 38 13 48 14 56 14 55 11 43 7 57 7 49 4 40 2h91l55-3 52-5 44-6 47-8 43-9 52-13 47-14 44-15 41-16 30-13 26-12 29-14 28-15 23-13 28-17 33-22 18-13 14-11 16-13 14-12 12-11 10-9 31-31 7-8 9-10 9-11 12-15 14-19 18-27 13-22 14-26 13-29 9-24 9-28 6-24 5-26 4-32 1-14v-50l-3-33-6-36-9-36-11-33-11-26-12-25-12-22-13-21-13-19-12-16-11-14-11-13-18-20-7-7-7-8-8-8-8-7-8-8-8-7-15-13-17-14-17-13-16-12-20-14-18-12-22-14-27-16-18-10-28-15-29-14-44-19-37-14-47-16-49-14-40-10-48-10-48-8-45-6-53-5-31-2-23-1z" fill="#455A75"/>
                <path transform="translate(1026,729)" d="m0 0 5 5 10 17 13 26 13 29 15 36 15 38 14 38 10 31 9 35 9 41 8 45 10 68 4 25 3 6v84l-12 2-54 2-78 1h-57l-55-1-16-1-2-1v-64l2-26 13-88 10-52 10-42 14-49 12-37 14-38 14-34 12-27 16-34 12-24z" fill="#455A75"/>
                <path transform="translate(1504,274)" d="m0 0h8l21 9 23 12 23 14 17 11 15 10 16 11 17 12 18 13 19 14 21 16 17 13 13 11 28 24 16 11v3l-7 6-49 17-49 18-32 13-25 12-24 13-23 14-41 26-20 12-4 2h-3l-6-9-14-9-15-9-25-14-24-14-22-12-14-8-30-13-36-14-41-15-22-9-14-2 2-5 11-9 8-11 10-10 8-7 14-12 14-11 18-14 16-12 18-13 20-14 17-11 22-14 28-17 22-12 16-8 14-6z" fill="#455A75"/>
                <path transform="translate(551,271)" d="m0 0h7l12 9 20 12 26 14 20 12 22 14 28 19 18 13 21 16 17 13 28 22 16 13 14 12 10 10 6 9-3 3-16 6-28 9-33 11-34 14-28 13-20 10-23 13-26 15-20 12-16 10-6 5h-2l-2 4-8 5-5-1-11-7-17-12-19-12-19-11-24-13-36-18-36-16-30-12-67-20-8-4-1-4 6-8 11-9 10-9 11-9 11-10 11-9 16-13 19-14 18-13 17-12 23-16 20-13 22-14 27-16 27-14 14-6z" fill="#455A75"/>
                <path transform="translate(1056,1253)" d="m0 0h105v1l-9 1-54 2-78 1h-57l-55-1-16-1v-1l6-1z" fill="#B4B261"/>
                </svg>
          </span>
        </div>
        <div  class="col-md-4 text-start">
          <h2>PT. TATA METAL LESTARI</h2>
          <p style="margin-top: -15px">Jl. Arjuna Utara No. 89, RT.008/01, Duri Kepa
            Kebon Jeruk, Jakarta Barat 11510, Tlp : 021-5688284</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-3">
      <div class="col-md-7"></div>
      <style>
        .button-container {
            display: flex;
            flex-direction: row; /* Menyusun tombol dalam kolom */
            gap: 10px; /* Jarak antara tombol */
        }
    
        .button-container a {
            display: block; /* Memastikan tombol menggunakan seluruh lebar kolom */
        }
    </style>
    
    <div class="col-md-5">
      <div class="button-container">
          @foreach ($data as $d)
              @if ($pengecekan == "container")
                  <a class="btn btn-primary" href="{{route('Mapping.admin.maping-shipment',$d->id)}}">Mapping Container</a>
              @elseif ($pengecekan == "trailer")
                  <a class="btn btn-success" href="{{route('Mapping.admin.maping-shipment-truk',$d->id)}}">Mapping Truk/Trailer</a>
              @else
                  <a class="btn btn-primary" href="{{route('Mapping.admin.maping-shipment',$d->id)}}">Mapping Container</a>
                  <a class="btn btn-success" href="{{route('Mapping.admin.maping-shipment-truk',$d->id)}}}">Mapping Truk/Trailer</a>
              @endif
      </div>
  </div>
    </div>
    <div class="row gy-4">
      <h1 class="app-brand-text demo menu-text fw-bold ms-1 text-end">Data Goods Shippment</h1>

  

      <div class="container">
        <div class="row">
          <!-- Kolom 1: "Kepada :" -->
          <div class="col-md-1">
            <div class="text-start">Kepada :</div>
          </div>
          
          <!-- Kolom 2: "Speddpanell Systemm" -->
          <div class="col-md-2">
            <div class="text-justify">{{$d->Kepada}}</div>
          </div>
          <div class="col-md-3"></div>
          
          <!-- Kolom 3: Tabel dengan 2 baris -->
          <div class="col-md-6">
            <table class="table">
              <tbody>
                <tr>
                  <th>No. GS</th>
                  <td class="text-end">{{$d->no_gs}}</td>
                </tr>
                <tr>
                  <th>Tgl GS</th>
                  <td class="text-end">{{$d->tgl_gs}}</td>
                </tr>
                <tr>
                  <th>No. SO</th>
                  <td class="text-end">{{$d->no_so}}</td>
                </tr>
                <tr>
                  <th>No. PO</th>
                  <td class="text-end">{{$d->no_po}}</td>
                </tr>
                <tr>
                  <th>DO Number</th>
                  <td class="text-end">{{$d->no_do}}</td>
                </tr>
                <tr>
                  <th>Container No</th>
                  <td class="text-end">{{$d->no_container}}</td>
                </tr>
                <tr>
                  <th>Seal No</th>
                  <td class="text-end">{{$d->no_seal}}</td>
                </tr>
                <tr>
                  <th>No Mobil</th>
                  <td class="text-end">{{$d->no_mobil}}</td>
                </tr>
                <tr>
                  <th>Forwarding</th>
                  <td class="text-end">{{$d->forwarding}}</td>
                </tr>
              </tbody>
            </table>            
          </div>
        </div>
      </div>
      @endforeach
      
<div class="col-12">
  <div class="card">
    <div class="table-responsive">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th class="text-truncate">No</th>
            <th class="text-truncate">Kode Produk</th>
            <th class="text-truncate">Produk</th>
            <th class="text-truncate">Quantity</th>
            <th class="text-truncate">Deskripsi</th>
            <th class="text-truncate">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($coil as $c)

          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$c->kode_produk}}</td>
            <td class="text-truncate">{{$c->nama_produk}}</td>
            <td class="text-truncate">{{$c->berat_produk}} Kg</td>
            <td>{{$c->keterangan}}</td>
            @php
                $statusClass = $c->status == 0 ? 'danger' : ($c->status == 1 ? 'success' : 'secondary');
                $statusText = $c->status == 0 ? 'Belum Dikirim' : ($c->status == 1 ? 'Sudah Dikirim' : 'Unknown');
            @endphp
            <td>
                <span class="btn btn-{{ $statusClass }}">{{ $statusText }}</span>
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
  <!-- / Content -->


  <div class="content-backdrop fade"></div>
</div>
@endsection