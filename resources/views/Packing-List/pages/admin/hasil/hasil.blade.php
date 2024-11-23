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
                        <a href="{{ route('Packing-List.admin.hasil.exports') }}" 
                           class="btn btn-success" style="text-decoration: none; font-size: 15px">Export All </a>
                    </div>
        
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->keterangan}}</td>
                                <td>
                                    <a href="{{route('Packing-List.admin.hasil.shows',$d->keterangan)}}">
                                        <label class="btn btn-success">
                                            <i class="fas fa-eye"></i> Show
                                        </label>
                                    </a>
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