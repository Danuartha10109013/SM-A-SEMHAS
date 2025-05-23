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
                        <a href="{{ route('Packing-List.admin.hasil.export', [$ket]) }}?search={{ request('search') }}&sort={{ request('sort', 'attribute') }}&direction={{ request('direction', 'asc') }}" 
                        class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>

                        <form action="{{ route('Packing-List.admin.hasil.shows', $ket) }}" method="GET" class="ml-2">
                            <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
                            <input type="hidden" name="sort" value="{{ request('sort', 'attribute') }}">
                            <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
                            <button type="submit" class="btn btn-danger">Search</button>
                        </form>
                        
                    
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                @php
                                    $currentSort = request('sort', 'kode'); // Default sort by 'kode'
                                    $currentDirection = request('direction', 'asc'); // Default direction 'asc'
                                @endphp
                        
                                <th>
                                    <a href="?sort=kode&direction={{ $currentSort === 'kode' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Kode {!! $currentSort === 'kode' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=nama_produk&direction={{ $currentSort === 'nama_produk' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Nama Produk {!! $currentSort === 'nama_produk' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=qty&direction={{ $currentSort === 'qty' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        QTY {!! $currentSort === 'qty' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=uom&direction={{ $currentSort === 'uom' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        UOM {!! $currentSort === 'uom' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=attribute&direction={{ $currentSort === 'attribute' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        No Coil {!! $currentSort === 'attribute' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=storage_bin&direction={{ $currentSort === 'storage_bin' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Storage Bin {!! $currentSort === 'storage_bin' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=date&direction={{ $currentSort === 'date' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Tanggal {!! $currentSort === 'date' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>Pengirim</th>
                                <th>
                                    <a href="?sort=panjang&direction={{ $currentSort === 'panjang' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Panjang {!! $currentSort === 'panjang' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=created_at&direction={{ $currentSort === 'created_at' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Time {!! $currentSort === 'created_at' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=kondisi&direction={{ $currentSort === 'kondisi' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Kondisi {!! $currentSort === 'kondisi' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=tujuan&direction={{ $currentSort === 'tujuan' && $currentDirection === 'asc' ? 'desc' : 'asc' }}">
                                        Tujuan {!! $currentSort === 'tujuan' ? ($currentDirection === 'asc' ? '&#9650;' : '&#9660;') : '' !!}
                                    </a>
                                </th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($data as $d)
                                @php
                                    $scan = \App\Models\DatabM::where('attribute', $d->attribute)->select('kode', 'nama_produk', 'qty', 'uom', 'attribute', 'storage_bin','panjang', 'date')->distinct()->get();
                                    $scanCount = $scan->count();
                                    // dd($scan);

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
