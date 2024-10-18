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
          <h4 class="card-title">Hasil Akhir</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Packing-List.admin.hasil.add') : route('Packing-List.pegawai.hasil.add') }}" 
                   class="badge badge-gradient-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan Packing </a>
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
                      <th> Kode </th>
                      <th> Nama Produk </th>
                      <th> QTY </th>
                      <th> UOM </th>
                      <th> No Coil </th>
                      <th> Storage Bin </th>
                      <th> Tanggal </th>
                      <th> Action </th>
                      <th> Pengirim </th>
                      <th> Panjang </th>
                      <th> Time </th>
                      <th> Kondisi </th>
                      <th> Tujuan </th>
                      <th> Keterangan </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($data as $d)
                      <tr>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$loop->iteration}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->kode}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->nama_produk}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->qty}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->uom}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->attribute}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->storage_bin}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">{{$d->date}}</td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">
                              <a href="{{route('Packing-List.admin.list.edit', $d->id)}}">
                                  <label class="badge badge-gradient-primary">
                                      <i class="fas fa-edit"></i> Edit
                                  </label>
                              </a>
                              <a href="">
                                  <label class="badge badge-gradient-success">
                                      <i class="fas fa-eye"></i> Show
                                  </label>
                              </a>
                              <a href="">
                                  <label class="badge badge-gradient-warning">
                                      <i class="fas fa-print"></i> Print
                                  </label>
                              </a>
                          </td>
                          <td rowspan="{{ \App\Models\ScanM::where('attribute',$d->attribute)->count() ?: 1 }}">
                              @php
                                  $name = \App\Models\User::where('id',$d->user_id)->value('name');
                              @endphp
                              {{$name}}
                          </td>
                          
                          @php
                              $scan = \App\Models\ScanM::where('attribute',$d->attribute)->select('panjang', 'created_at', 'kondisi', 'tujuan', 'keterangan')->distinct()->get();
                          @endphp
                          @if($scan->isNotEmpty())
                              @foreach ($scan as $index => $s)
                                  @if($index > 0)
                                      <tr>
                                  @endif
                                      <td>{{$s->panjang}}</td>
                                      <td>{{$s->created_at}}</td>
                                      <td>{{$s->kondisi}}</td>
                                      <td>{{$s->tujuan}}</td>
                                      <td>{{$s->keterangan}}</td>
                                  </tr>
                              @endforeach
                          @else
                              <td colspan="5">No Scan Data Available</td>
                          @endif
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