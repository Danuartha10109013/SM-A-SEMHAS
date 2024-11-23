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
                <h4 class="card-title">Hasil Akhir Keterangan {{$ket}}</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        
                    </div>
        
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('Packing-List.admin.hasil.export', [$ket, 'search' => request('search')]) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <form action="{{ route('Packing-List.admin.hasil.shows', $ket) }}" method="GET" class="ml-2">
                            <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-danger">Search</button>
                        </form>
                    
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>No Coil</th>
                                <th>Storage Bin</th>
                                <th>Tanggal</th>
                                <th>Pengirim</th>
                                <th>Panjang</th>
                                <th>Time</th>
                                <th>Kondisi</th>
                                <th>Tujuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                @php
                                    $scan = \App\Models\DatabM::where('attribute', $d->attribute)->select('kode', 'nama_produk', 'qty', 'uom', 'attribute', 'storage_bin','panjang', 'date')->distinct()->get();
                                    $scanCount = $scan->count();
                                    // dd($scanCount);

                                @endphp

                                @if($scanCount > 0)
                                    @foreach ($scan as $index => $db)
                                        <tr>
                                            @if($index === 0)
                                                <td rowspan="{{ $scanCount }}">{{ $db->kode }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->nama_produk }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->qty }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->uom }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->attribute }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->storage_bin }}</td>
                                                <td rowspan="{{ $scanCount }}">{{ $db->date }}</td>
                                                
                                                <td rowspan="{{ $scanCount }}">
                                                    @php
                                                        $name = \App\Models\User::where('id', $d->user_id)->value('name');
                                                    @endphp
                                                    {{ $name }}
                                                </td>
                                            @endif
                                            @if ($d->panjang == null)
                                            <td rowspan="{{ $scanCount }}">{{ $db->panjang }}</td>
                                            @else
                                            <td>{{ $d->panjang }}</td>
                                            @endif
                                            <td>{{ $d->created_at }}</td>
                                            <td>{{ $d->kondisi }}</td>
                                            <td>{{ $d->tujuan }}</td>
                                            <td>{{ $d->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>{{ $d->kode }}</td>
                                        <td>{{ $d->nama_produk }}</td>
                                        <td>{{ $d->qty }}</td>
                                        <td>{{ $d->uom }}</td>
                                        <td>{{ $d->attribute }}</td>
                                        <td>{{ $d->storage_bin }}</td>
                                        <td>{{ $d->date }}</td>
                                        <td colspan="7">No Valid Data</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
